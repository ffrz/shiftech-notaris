<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AclResource;
use App\Models\Service;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{

    public function __construct()
    {
        ensure_user_can_access(AclResource::SERVICE_MANAGEMENT);
    }

    public function index(Request $request)
    {
        $filter = [
            'active' => (int)$request->get('active', -1),
            'search' => $request->get('search', ''),
        ];

        $q = Service::query();

        if ($filter['active'] != -1) {
            $q->where('active', '=', $filter['active']);
        }

        if (!empty($filter['search'])) {
            $q->where('name', 'like', '%' . $filter['search'] . '%');
        }

        $items = $q->orderBy('name', 'asc')->paginate(10);
        return view('admin.service.index', compact('items', 'filter'));
    }

    public function edit(Request $request, $id = 0)
    {
        if (!$id) {
            $item = new Service();
            $item->active = true;
        } else {
            $item = Service::findOrFail($id);
        }

        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
            ], [
                'name.required' => 'Nama layanan harus diisi.',
                'name.max' => 'Nama layanan terlalu panjang, maksimal 100 karakter.',
            ]);

            if ($validator->fails())
                return redirect()->back()->withInput()->withErrors($validator);

            $data = ['Old Data' => $item->toArray()];

            $tmpData = $request->all();
            $tmpData['price'] = number_from_input($tmpData['price']);
            if (empty($tmpData['active']))
                $tmpData['active'] = false;

            $item->fill($tmpData);
            $item->save();
            $data['New Data'] = $item->toArray();

            UserActivity::log(
                UserActivity::SERVICE_MANAGEMENT,
                ($id == 0 ? 'Tambah' : 'Perbarui') . ' Layanan',
                'Layanan ' . e($item->name) . ' telah ' . ($id == 0 ? 'dibuat' : 'diperbarui'),
                $data
            );

            return redirect('admin/service')->with('info', 'Layanan telah disimpan.');
        }

        return view('admin.service.edit', compact('item'));
    }

    public function duplicate($id)
    {
        $item = Service::findOrFail($id);
        $item->id = null;
        return view('admin.service.edit', compact('item'));
    }

    public function delete($id)
    {
        $item = Service::findOrFail($id);
        $item->delete();

        $message = 'Layanan ' . e($item->name) . ' telah dihapus.';
        UserActivity::log(
            UserActivity::SERVICE_MANAGEMENT,
            'Hapus Layanan',
            $message,
            $item->toArray()
        );

        return redirect('admin/service')->with('info', $message);
    }
}
