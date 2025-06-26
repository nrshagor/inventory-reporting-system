<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function index()
    {
        return view('report.index');
    }


    public function summary(Request $request)
    {
        $from = $request->query('from');
        $to = $request->query('to');

        $sales = Sale::with('saleItems.product')
            ->whereBetween('created_at', [$from, $to])
            ->get();

        $totalSales = $sales->sum('total');
        $totalExpenses = 0;

        foreach ($sales as $sale) {
            foreach ($sale->saleItems as $item) {
                $totalExpenses += $item->quantity * $item->product->purchase_price;
            }
        }

        $profit = $totalSales - $totalExpenses;

        return response()->json([
            'total_sales' => round($totalSales, 2),
            'total_expenses' => round($totalExpenses, 2),
            'profit' => round($profit, 2),
        ]);
    }
}
