<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AclResource;
use App\Models\Officer;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfficerController extends Controller
{
    public function __construct()
    {
        ensure_user_can_access(AclResource::OFFICER_MANAGEMENT);
    }

    public function index(Request $request)
    {
        $filter = [
            'active' => (int)$request->get('active', -1),
            'search' => $request->get('search', ''),
        ];

        $q = Officer::query();

        if ($filter['active'] != -1) {
            $q->where('active', '=', $filter['active']);
        }

        if (!empty($filter['search'])) {
            $q->where('name', 'like', '%' . $filter['search'] . '%');
            $q->orWhere('description', 'like', '%' . $filter['search'] . '%');
            $q->orWhere('notes', 'like', '%' . $filter['notes'] . '%');
        }

        $items = $q->orderBy('name', 'asc')->paginate(10);
        return view('admin.officer.index', compact('items', 'filter'));
    }

    public function edit(Request $request, $id = 0)
    {
        if (!$id) {
            $item = new Officer();
            $item->active = true;
        } else {
            $item = Officer::find($id);
            if (!$item) {
                return redirect('admin/officer')->with('warning', 'Officer tidak ditemukan.');
            }
        }

        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
            ], [
                'name.required' => 'Nama Officer harus diisi.',
                'name.max' => 'Nama Officer terlalu panjang, maksimal 100 karakter.',
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
                UserActivity::OFFICER_MANAGEMENT,
                ($id == 0 ? 'Tambah' : 'Perbarui') . ' Pelanggan',
                'Pelanggan ' . e($item->name) . ' telah ' . ($id == 0 ? 'dibuat' : 'diperbarui'),
                $data
            );

            return redirect('admin/officer')->with('info', 'Officer telah disimpan.');
        }

        return view('admin.officer.edit', compact('item'));
    }

    public function delete($id)
    {
        $item = Officer::findOrFail($id);
        $item->delete();

        $message = 'Officer ' . e($item->name) . ' telah dihapus.';
        UserActivity::log(
            UserActivity::OFFICER_MANAGEMENT,
            'Hapus Officer',
            $message,
            $item->toArray()
        );

        return redirect('admin/officer')->with('info', $message);
    }

}
