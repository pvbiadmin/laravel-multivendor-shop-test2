<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function dashboard()
    {
        $vendorId = Auth::user()->vendor->id;

        $ordersToday = $this->getOrdersCount(Carbon::today(), null);
        $pendingOrdersToday = $this->getOrdersCount(Carbon::today(), 'pending');
        $totalOrders = $this->getOrdersCount(null, null);
        $totalPendingOrders = $this->getOrdersCount(null, 'pending');
        $totalCompletedOrders = $this->getOrdersCount(null, 'delivered');

        $totalProducts = Product::where('vendor_id', $vendorId)->count();

        $earningsToday = $this->getEarnings(Carbon::today());
        $monthlyEarnings = $this->getEarnings(Carbon::now()->month);
        $yearlyEarnings = $this->getEarnings(Carbon::now()->year);
        $totalEarnings = $this->getEarnings();

        $totalReviews = ProductReview::whereHas('product', function ($query) use ($vendorId) {
            $query->where('vendor_id', $vendorId);
        })->count();

        return view('vendor.dashboard.dashboard', compact(
            'ordersToday',
            'pendingOrdersToday',
            'totalOrders',
            'totalPendingOrders',
            'totalCompletedOrders',
            'totalProducts',
            'earningsToday',
            'monthlyEarnings',
            'yearlyEarnings',
            'totalEarnings',
            'totalReviews'
        ));
    }

    private function getOrdersCount($date = null, $status = null)
    {
        $query = Order::whereHas('orderProducts', function ($query) {
            $query->where('vendor_id', Auth::user()->vendor->id);
        });

        if ($date) {
            $query->whereDate('created_at', $date);
        }
        if ($status) {
            $query->where('order_status', $status);
        }

        return $query->count();
    }

    private function getEarnings($date = null)
    {
        $query = Order::where('order_status', 'delivered')
            ->whereHas('orderProducts', function ($query) {
                $query->where('vendor_id', Auth::user()->vendor->id);
            });

        if ($date) {
            $query->whereDate('created_at', $date);
        }

        return $query->where('payment_status', 1)->sum('subtotal');
    }
}
