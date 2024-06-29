<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\AclResource;
use Illuminate\Http\Request;

class OrderController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        ensure_user_can_access(AclResource::ORDER_MANAGEMENT);
    }

    public function index(Request $request)
    {
        $filter = [
            'status' => (int)$request->get('status', -1),
            'search' => $request->get('search', ''),
        ];

        $q = Order::with(['customer', 'officer']);

        if ($filter['status'] != -1) {
            $q->where('status', '=', $filter['status']);
        }

        if (!empty($filter['search'])) {
            $q->whereHas('customer', function ($q) use ($filter) {
                $q->where('name', 'like', '%' . $filter['search'] . '%');
            })->orWhere('description', 'like', '%' . $filter['search'] . '%')
                ->orWhere('notes', 'like', '%' . $filter['search'] . '%');
        }

        $items = $q->orderBy('id', 'desc')->paginate(10);

        return view('admin.order.index', compact('items', 'filter'));
    }

    public function detail($id)
    {
        $item = Order::with(['customer', 'officer', 'service', 'partner'])->findOrFail($id);
        return view('admin.order.detail', compact('item'));
    }
}
