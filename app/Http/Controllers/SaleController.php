<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller

{

    public function index()
    {
        $products = Product::all();
        return view('sale.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $items = $request->items;
            $discount = $request->discount ?? 0;
            $paid = $request->paid_amount;

            $total = 0;

            // 1. Validate stock + calculate total
            foreach ($items as $item) {
                $product = Product::find($item['product_id']);
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Not enough stock for product: " . $product->name);
                }
                $lineTotal = $product->sell_price * $item['quantity'];
                $total += $lineTotal;
            }

            // 2. Calculate VAT, Grand Total, Due
            $totalAfterDiscount = $total - $discount;
            $vat = $totalAfterDiscount * 0.05;
            $grandTotal = $totalAfterDiscount + $vat;
            $due = $grandTotal - $paid;

            // 3. Create Sale
            $sale = Sale::create([
                'discount' => $discount,
                'vat' => $vat,
                'paid_amount' => $paid,
                'total' => $grandTotal,
                'due' => $due,
            ]);

            // 4. Insert Sale Items + Reduce Stock
            foreach ($items as $item) {
                $product = Product::find($item['product_id']);

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->sell_price,
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            // 5. Journal Entries
            JournalEntry::insert([
                ['type' => 'Sales', 'amount' => $total, 'sale_id' => $sale->id, 'created_at' => now(), 'updated_at' => now()],
                ['type' => 'Discount', 'amount' => $discount, 'sale_id' => $sale->id, 'created_at' => now(), 'updated_at' => now()],
                ['type' => 'VAT', 'amount' => $vat, 'sale_id' => $sale->id, 'created_at' => now(), 'updated_at' => now()],
                ['type' => 'Payment', 'amount' => $paid, 'sale_id' => $sale->id, 'created_at' => now(), 'updated_at' => now()],
            ]);

            DB::commit();

            return response()->json(['message' => 'Sale successful', 'sale_id' => $sale->id], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
