<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AclResource;
use App\Models\Setting;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function __construct()
    {
        ensure_user_can_access(AclResource::SETTINGS);
    }

    public function edit(Request $request)
    {
        return view('admin.settings.edit');
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notary_name' => 'required',
            'notary_name2' => 'required',
            'notary_type' => 'required',
            'company_address' => 'required',
            'company_province' => 'required',
            'company_city' => 'required',
            'company_phone' => 'required',
            'company_email' => 'required',
            'director_name' => 'required',
            'cashier_name' => 'required',
        ], [
            'notary_name.required' => 'Nama Notaris harus diisi.',
            'notary_name2.required' => 'Notaris tersebut harus diisi.',
            'notary_type.required' => 'Pejabat harus diisi.',
            'company_address.required' => 'Alamat harus diisi.',
            'company_province.required' => 'Provinsi harus diisi.',
            'company_city.required' => 'Kota / Kabupaten harus diisi.',
            'company_phone.required' => 'No Telepon harus diisi.',
            'company_email.required' => 'Email harus diisi.',
            'director_name.required' => 'Nama Direktur harus diisi.',
            'cashier_name.required' => 'Nama Kasir harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $oldValues = Setting::values();

        DB::beginTransaction();
        Setting::setValue('company.notary_name', $request->post('notary_name', ''));
        Setting::setValue('company.notary_name2', $request->post('notary_name2', ''));
        Setting::setValue('company.notary_type', $request->post('notary_type', ''));
        Setting::setValue('company.company_address', $request->post('company_address', ''));
        Setting::setValue('company.company_province', $request->post('company_province', ''));
        Setting::setValue('company.company_city', $request->post('company_city', ''));
        Setting::setValue('company.company_phone', $request->post('company_phone', ''));
        Setting::setValue('company.company_fax', $request->post('company_fax', ''));
        Setting::setValue('company.company_email', $request->post('company_email', ''));
        Setting::setValue('company.notary_location', $request->post('notary_location', ''));
        Setting::setValue('company.notary_sk', $request->post('notary_sk', ''));
        Setting::setValue('company.notary_sk_date', $request->post('notary_sk_date', ''));
        Setting::setValue('company.ppat_location', $request->post('ppat_location', ''));
        Setting::setValue('company.ppat_sk', $request->post('ppat_sk', ''));
        Setting::setValue('company.ppat_sk_date', $request->post('ppat_sk_date', ''));
        Setting::setValue('company.director_name', $request->post('director_name', ''));
        Setting::setValue('company.cashier_name', $request->post('cashier_name', ''));
        DB::commit();

        $data = [
            'Old Value' => $oldValues,
            'New Value' => Setting::values(),
        ];

        UserActivity::log(UserActivity::SETTINGS, 'Change Settings', 'Pengaturan telah diperbarui.', $data);

        return redirect('admin/settings')->with('info', 'Pengaturan telah disimpan.');
    }
}
