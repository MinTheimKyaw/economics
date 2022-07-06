<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Order;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $productcount = Product::count();
        $ordercount = Order::count();
        return Inertia::render('Dashboard/Index',[
            'productcount' => $productcount,
            'ordercount' => $ordercount
        ]);
    }
}
