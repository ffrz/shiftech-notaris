<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AclResource;
use App\Models\Customer;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function __construct()
    {
        ensure_user_can_access(AclResource::CUSTOMER_MANAGEMENT);
    }

    public function index(Request $request)
    {
        $filter = [
            'active' => (int)$request->get('active', 1),
            'search' => $request->get('search', ''),
        ];

        $q = Customer::query();

        if ($filter['active'] != -1) {
            $q->where('active', '=', $filter['active']);
        }

        if (!empty($filter['search'])) {
            $q->where('name', 'like', '%' . $filter['search'] . '%');
            $q->orWhere('phone', 'like', '%' . $filter['search'] . '%');
            $q->orWhere('address', 'like', '%' . $filter['search'] . '%');
        }

        $items = $q->orderBy('name', 'asc')->paginate(10);
        return view('admin.customer.index', compact('items', 'filter'));
    }

    public function edit(Request $request, $id = 0)
    {
        if (!$id) {
            $item = new Customer();
            $item->active = true;
        } else {
            $item = Customer::findOrFail($id);
        }

        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'phone' => 'required',
                'address' => 'required',
                'email' => 'nullable|email'
            ], [
                'name.required' => 'Nama pelanggan harus diisi.',
                'name.max' => 'Nama pelanggan terlalu panjang, maksimal 100 karakter.',
                'phone.required' => 'Nomor telepon harus diisi',
                'address.required' => 'Alamat harus diisi.',
                'email.email' => 'Email tidak valid',
            ]);

            if ($validator->fails())
                return redirect()->back()->withInput()->withErrors($validator);

            $data = ['Old Data' => $item->toArray()];

            $tmpData = $request->all();
            if (empty($tmpData['active']))
                $tmpData['active'] = false;

            $item->fill($tmpData);
            $item->save();
            $data['New Data'] = $item->toArray();

            UserActivity::log(
                UserActivity::CUSTOMER_MANAGEMENT,
                ($id == 0 ? 'Tambah' : 'Perbarui') . ' Pelanggan',
                'Pelanggan ' . e($item->name) . ' telah ' . ($id == 0 ? 'dibuat' : 'diperbarui'),
                $data
            );

            return redirect('admin/customer')->with('info', 'Pelanggan telah disimpan.');
        }

        return view('admin.customer.edit', compact('item'));
    }

    public function delete($id)
    {
        $item = Customer::findOrFail($id);

        DB::beginTransaction();
        $item->delete();

        $message = 'Pelanggan ' . e($item->name) . ' telah dihapus.';
        UserActivity::log(
            UserActivity::CUSTOMER_MANAGEMENT,
            'Hapus Pelanggan',
            $message,
            $item->toArray()
        );
        DB::commit();

        return redirect('admin/customer')->with('info', $message);
    }

    public function detail($id)
    {
        $item = Customer::findOrFail($id);
        $item->order_count = $item->total_sales = DB::select('select ifnull(count(0), 0) as count from orders where customer_id=:customer_id', [
            'customer_id' => $id,
        ])[0]->count;
        $item->total_order = $item->total_sales = DB::select('select ifnull(sum(total), 0) as sum from orders where customer_id=:customer_id', [
            'customer_id' => $id,
        ])[0]->sum;
        $item->total_receivable = $item->total_sales = DB::select('select ifnull(sum(total-total_paid), 0) as sum from orders where customer_id=:customer_id', [
            'customer_id' => $id,
        ])[0]->sum;
        return view('admin.customer.detail', compact('item'));
    }
}
