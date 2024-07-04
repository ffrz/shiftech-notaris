<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\AclResource;
use App\Models\Customer;
use App\Models\Officer;
use App\Models\Partner;
use App\Models\Service;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

    public function edit(Request $request, $id = 0)
    {
        if (!$id) {
            $item = new Order();
            $item->date = current_date();
        } else {
            $item = Order::findOrFail($id);
        }

        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'description' => 'required|max:200',
                'customer_id' => 'required',
                'officer_id' => 'required',
                'service_id' => 'required',
            ], [
                'description.required' => 'Deskripsi harus diisi.',
                'customer_id.required' => 'Klien harus diisi.',
                'officer_id.required' => 'Officer harus diisi',
                'service_id.required' => 'Layanan harus diisi',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

            $data = ['Old Data' => $item->toArray()];

            $tmpData = $request->all();
            $tmpData['total'] = number_from_input($tmpData['total']);
            if (empty($tmpData['partner_status'])) {
                $tmpData['partner_id'] = null;
            }

            $item->fill($tmpData);
            $item->save();
            $data['New Data'] = $item->toArray();

            UserActivity::log(
                UserActivity::ORDER_MANAGEMENT,
                ($id == 0 ? 'Tambah' : 'Perbarui') . ' Pesanan',
                'Pesanan ' . e($item->name) . ' telah ' . ($id == 0 ? 'dibuat' : 'diperbarui'),
                $data
            );

            return redirect('admin/order')->with('info', 'Pesanan telah disimpan.');
        }
        $customers = Customer::select(['id', 'name'])->orderBy('name', 'asc')->get();
        $officers = Officer::select(['id', 'name'])->orderBy('name', 'asc')->get();
        $services = Service::select(['id', 'name'])->orderBy('name', 'asc')->get();
        $partners = Partner::select(['id', 'name'])->orderBy('name', 'asc')->get();
        return view('admin.order.edit', compact('item', 'customers', 'officers', 'partners', 'services'));
    }

    public function close(Request $request, $id)
    {
        $item = Order::findOrFail($id);

        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'total' => 'required',
                'status' => 'required|integer|between:1,2',
            ], [
                'total.required' => 'Biaya harus diisi.',
                'status.required' => 'Pilih status.',
                'status.between' => 'Status tidak valid.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->withErrors($validator);
            }

            $data = ['Old Data' => $item->toArray()];
            $tmpData = $request->only('total', 'notes');
            $tmpData['total'] = number_from_input($tmpData['total']);

            $item->fill($tmpData);
            $item->status = Order::STATUS_CLOSED;
            $item->closed_date = current_date();
            $item->save();
            $data['New Data'] = $item->toArray();

            UserActivity::log(UserActivity::ORDER_MANAGEMENT, 'Penutupan Pesanan', 'Pesanan #' . $item->id . ' telah ditutup', $data);

            return redirect('admin/order/detail/' . $item->id)->with('info', 'Pesanan telah disimpan.');
        }

        $customers = Customer::select(['id', 'name'])->orderBy('name', 'asc')->get();
        $officers = Officer::select(['id', 'name'])->orderBy('name', 'asc')->get();
        $services = Service::select(['id', 'name'])->orderBy('name', 'asc')->get();
        $partners = Partner::select(['id', 'name'])->orderBy('name', 'asc')->get();

        return view('admin.order.close', compact('item', 'customers', 'officers', 'partners', 'services'));
    }

    public function delete($id)
    {
        $item = Order::findOrFail($id);

        DB::beginTransaction();
        $data['Old Data'] = $item->toArray();
        $item->delete();

        $message = 'Order #' . e($item->id) . ' telah dihapus.';
        UserActivity::log(
            UserActivity::ORDER_MANAGEMENT,
            'Hapus Order',
            $message,
            $data
        );
        DB::commit();

        return redirect('admin/order')->with('info', $message);
    }

    public function detail($id)
    {
        $item = Order::with(['customer', 'officer', 'service', 'partner'])->findOrFail($id);
        return view('admin.order.detail', compact('item'));
    }
}
