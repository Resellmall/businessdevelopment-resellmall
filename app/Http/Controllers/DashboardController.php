<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSupplier = DB::table('users')->where('role_id', 2)->count();
        $totalSupplierLW = DB::table('users')->where('role_id', 2)->where('created_at', '>', Carbon::now()->startOfWeek())->count();
        $activeSupplier = DB::table('users')->where('role_id', 2)->where('user_status', 1)->count();
        $activeSupplierLW = DB::table('users')->where('role_id', 2)->where('user_status', 1)->where('created_at', '>', Carbon::now()->startOfWeek())->count();
        $inactiveSupplier = DB::table('users')->where('role_id', 2)->where('user_status', 2)->count();
        $inactiveSupplierLW = DB::table('users')->where('role_id', 2)->where('user_status', 2)->where('updated_at', '>', Carbon::now()->startOfWeek())->count();
        return view(
            'dashboard.dashboard',
            [
                'totalSupplier' => $totalSupplier,
                'totalSupplierLW' => $totalSupplierLW,
                'activeSupplier' => $activeSupplier,
                'activeSupplierLW' => $activeSupplierLW,
                'inactiveSupplier' => $inactiveSupplier,
                'inactiveSupplierLW' => $inactiveSupplierLW
            ]
        );
    }
}
