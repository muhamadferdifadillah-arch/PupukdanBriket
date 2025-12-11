<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function sales()
    {
        // Query total penjualan per bulan (ORDER SELESAI)
        $sales = DB::table('orders')
            ->selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
            ->where('status', 'completed')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Siapkan data 12 bulan
        $monthlySales = array_fill(1, 12, 0);

        foreach ($sales as $row) {
            $monthlySales[$row->month] = (int) $row->total;
        }

        return view('admin.reports.sales', [
            'monthlySales' => $monthlySales
        ]);
    }
}
