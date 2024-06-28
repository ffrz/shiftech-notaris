<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ServiceOrder;
use App\Models\StockUpdate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $start_datetime_this_month = date('Y-m-01 00:00:00');
        $end_datetime_this_month = date('Y-m-t 23:59:59');
        $start_date_this_month = date('Y-m-01');
        $end_date_this_month = date('Y-m-t');

        $expenses_this_month = DB::select('select ifnull(sum(amount), 0) as sum from expenses where (date between :start and :end)', [
            'start' => $start_date_this_month,
            'end' => $end_date_this_month,
        ])[0]->sum;

        $data = [
            'expenses_this_month' => $expenses_this_month,
        ];

        return view('admin.dashboard.index', compact('data'));
    }
}
