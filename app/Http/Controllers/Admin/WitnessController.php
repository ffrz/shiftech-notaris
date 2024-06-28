<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AclResource;
use App\Models\Witness;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WitnessController extends Controller
{

    public function __construct()
    {
        ensure_user_can_access(AclResource::WITNESS_MANAGEMENT);
    }

    public function index(Request $request)
    {
        $filter = [
            'active' => (int)$request->get('active', -1),
            'search' => $request->get('search', ''),
        ];

        $q = Witness::query();

        if ($filter['active'] != -1) {
            $q->where('active', '=', $filter['active']);
        }

        if (!empty($filter['search'])) {
            $q->where('name', 'like', '%' . $filter['search'] . '%');
            $q->orWhere('description', 'like', '%' . $filter['search'] . '%');
            $q->orWhere('notes', 'like', '%' . $filter['notes'] . '%');
        }

        $items = $q->orderBy('name', 'asc')->paginate(10);
        return view('admin.witness.index', compact('items', 'filter'));
    }

    public function edit(Request $request, $id = 0)
    {
        if (!$id) {
            $item = new Witness();
            $item->active = true;
        } else {
            $item = Witness::findOrFail($id);
        }

        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'description' => 'required',
            ], [
                'name.required' => 'Nama saksi harus diisi.',
                'name.max' => 'Nama saksi terlalu panjang, maksimal 100 karakter.',
                'description' => 'Keterangan harus diisi.',
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
                UserActivity::WITNESS_MANAGEMENT,
                ($id == 0 ? 'Tambah' : 'Perbarui') . ' Saksi',
                'Saksi ' . e($item->name) . ' telah ' . ($id == 0 ? 'dibuat' : 'diperbarui'),
                $data
            );

            return redirect('admin/witness')->with('info', 'Saksi telah disimpan.');
        }

        return view('admin.witness.edit', compact('item'));
    }

    public function duplicate($id)
    {
        $item = Witness::findOrFail($id);
        $item->id = null;
        return view('admin.witness.edit', compact('item'));
    }

    public function delete($id)
    {
        $item = Witness::findOrFail($id);
        $item->delete();

        $message = 'Saksi ' . e($item->name) . ' telah dihapus.';
        UserActivity::log(
            UserActivity::WITNESS_MANAGEMENT,
            'Hapus Saksi',
            $message,
            $item->toArray()
        );

        return redirect('admin/witness')->with('info', $message);
    }
}
