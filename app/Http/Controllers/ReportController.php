<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function summary(Request $request)
    {
        $from = $request->query('from');
        $to = $request->query('to');

        $sales = Sale::whereBetween('created_at', [$from, $to])->get();

        $totalSales = $sales->sum('total');
        $totalExpenses = $sales->sum(fn($sale) => $sale->saleItems->sum(fn($item) => $item->quantity * $item->product->purchase_price));
        $profit = $totalSales - $totalExpenses;

        return response()->json([
            'total_sales' => $totalSales,
            'total_expenses' => $totalExpenses,
            'profit' => $profit,
        ]);
    }
}
