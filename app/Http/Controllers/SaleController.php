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
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'discount' => 'nullable|numeric',
            'paid_amount' => 'required|numeric',
        ]);

        DB::transaction(function () use ($request) {
            $discount = $request->discount ?? 0;
            $items = $request->items;
            $paid = $request->paid_amount;

            $total = 0;

            foreach ($items as $item) {
                $product = Product::find($item['product_id']);
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Not enough stock for {$product->name}");
                }

                $lineTotal = $product->sell_price * $item['quantity'];
                $total += $lineTotal;

                $product->stock -= $item['quantity'];
                $product->save();
            }

            $totalAfterDiscount = $total - $discount;
            $vat = $totalAfterDiscount * 0.05;
            $grandTotal = $totalAfterDiscount + $vat;
            $due = $grandTotal - $paid;

            $sale = Sale::create([
                'discount' => $discount,
                'vat' => $vat,
                'paid_amount' => $paid,
                'total' => $grandTotal,
                'due' => $due,
            ]);

            foreach ($items as $item) {
                $product = Product::find($item['product_id']);
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->sell_price,
                ]);
            }

            JournalEntry::insert([
                ['type' => 'Sales', 'amount' => $total, 'sale_id' => $sale->id, 'created_at' => now()],
                ['type' => 'Discount', 'amount' => $discount, 'sale_id' => $sale->id, 'created_at' => now()],
                ['type' => 'VAT', 'amount' => $vat, 'sale_id' => $sale->id, 'created_at' => now()],
                ['type' => 'Payment', 'amount' => $paid, 'sale_id' => $sale->id, 'created_at' => now()],
            ]);
        });

        return response()->json(['message' => 'Sale completed successfully']);
    }
}
