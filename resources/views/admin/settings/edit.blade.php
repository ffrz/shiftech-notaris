@php
  use App\Models\Setting;
@endphp

@extends('admin._layouts.default', [
    'title' => 'Pengaturan',
    'menu_active' => 'system',
    'nav_active' => 'settings',
    'form_action' => url('admin/settings/save'),
])

@section('right-menu')
  <li class="nav-item">
    <button class="btn btn-primary mr-1" type="submit"><i class="fas fa-save mr-1"></i> Simpan</button>
  </li>
@endSection

@section('content')
  <div class="row">
    <div class="col-lg-6">
      <div class="card card-light">
        <div class="card-header" style="padding:0;border-bottom:0;">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="false">Profil Notaris</a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="true">Informasi Kantor</a>
            </li> --}}
          </ul>
        </div>
        <div class="tab-content card-body" id="myTabContent">
          <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
            <div class="form-horizontal">
              <div class="form-group">
                <label for="notary_name">Nama Notaris <span class="required">*</span></label>
                <input class="form-control @error('notary_name') is-invalid @enderror" id="notary_name" name="notary_name" type="text"
                  value="{{ old('notary_name', Setting::value('company.notary_name')) }}" placeholder="Contoh: Adi Suryadi SH, M.Kn.">
                @error('notary_name')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="notary_name2">Notaris Tersebut <span class="required">*</span></label>
                <input class="form-control @error('notary_name2') is-invalid @enderror" id="notary_name2" name="notary_name2" type="text"
                  value="{{ old('notary_name2', Setting::value('company.notary_name2')) }}" placeholder="Contoh: Adi Suryadi Sarjana Hukum Magister Kenotariatan">
                @error('notary_name2')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="notary_type">Pejabat <span class="required">*</span></label>
                <input class="form-control @error('notary_type') is-invalid @enderror" id="notary_type" name="notary_type" type="text"
                  value="{{ old('notary_type', Setting::value('company.notary_type')) }}">
                @error('notary_type')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="company_address">Alamat <span class="required">*</span></label>
                <textarea class="form-control @error('company_address') is-invalid @enderror" id="company_address" name="company_address">{{ old('company_address', Setting::value('company.company_address')) }}</textarea>
                @error('company_address')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="company_province">Provinsi <span class="required">*</span></label>
                <input class="form-control @error('company_province') is-invalid @enderror" id="company_province" name="company_province"
                  value="{{ old('company_province', Setting::value('company.company_province')) }}">
                @error('company_province')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="company_city">Kota / Kabupaten <span class="required">*</span></label>
                <input class="form-control @error('company_city') is-invalid @enderror" id="company_city" name="company_city"
                  value="{{ old('company_city', Setting::value('company.company_city')) }}">
                @error('company_city')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="company_phone">No Telepon <span class="required">*</span></label>
                <input class="form-control @error('company_phone') is-invalid @enderror" id="company_phone" name="company_phone" type="text"
                  value="{{ old('company_phone', Setting::value('company.company_phone')) }}">
                @error('company_phone')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="company_fax">No Fax</label>
                <input class="form-control @error('company_fax') is-invalid @enderror" id="company_fax" name="company_fax" type="text"
                  value="{{ old('company_fax', Setting::value('company.company_fax')) }}">
                @error('company_fax')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="company_email">Email <span class="required">*</span></label>
                <input class="form-control @error('company_email') is-invalid @enderror" id="company_email" name="company_email" type="text"
                  value="{{ old('company_email', Setting::value('company.company_email')) }}">
                @error('company_email')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="notary_location">Lokasi Notaris</label>
                <input class="form-control @error('notary_location') is-invalid @enderror" id="notary_location" name="notary_location" type="text"
                  value="{{ old('notary_location', Setting::value('company.notary_location')) }}">
                @error('notary_location')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="notary_sk">SK Notaris</label>
                <input class="form-control @error('notary_sk') is-invalid @enderror" id="notary_sk" name="notary_sk" type="text"
                  value="{{ old('notary_sk', Setting::value('company.notary_sk')) }}">
                @error('notary_sk')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="notary_sk_date">Tanggal SK Notaris</label>
                <input class="form-control @error('notary_sk_date') is-invalid @enderror" id="notary_sk_date" name="notary_sk_date" type="text"
                  value="{{ old('notary_sk_date', Setting::value('company.notary_sk_date')) }}">
                @error('notary_sk_date')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="ppat_location">Lokasi PPAT</label>
                <input class="form-control @error('ppat_location') is-invalid @enderror" id="ppat_location" name="ppat_location" type="text"
                  value="{{ old('ppat_location', Setting::value('company.ppat_location')) }}">
                @error('ppat_location')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="ppat_sk">SK PPAT</label>
                <input class="form-control @error('ppat_sk') is-invalid @enderror" id="ppat_sk" name="ppat_sk" type="text"
                  value="{{ old('ppat_sk', Setting::value('company.ppat_sk')) }}">
                @error('ppat_sk')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="ppat_sk_date">Tanggal SK PPAT</label>
                <input class="form-control @error('ppat_sk_date') is-invalid @enderror" id="ppat_sk_date" name="ppat_sk_date" type="text"
                  value="{{ old('ppat_sk_date', Setting::value('company.ppat_sk_date')) }}">
                @error('ppat_sk_date')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="director_name">Nama Direksi <span class="required">*</span></label>
                <input class="form-control @error('director_name') is-invalid @enderror" id="director_name" name="director_name" type="text"
                  value="{{ old('director_name', Setting::value('company.director_name')) }}">
                @error('director_name')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="cashier_name">Nama Kasir <span class="required">*</span></label>
                <input class="form-control @error('cashier_name') is-invalid @enderror" id="cashier_name" name="cashier_name" type="text"
                  value="{{ old('cashier_name', Setting::value('company.cashier_name')) }}">
                @error('cashier_name')
                  <span class="text-danger">
                    {{ $message }}
                  </span>
                @enderror
              </div>
            </div>
          </div>
          {{-- <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
            <div class="form-group">
              <label for="company_owner">Nama Pemilik</label>
              <input class="form-control @error('company_owner') is-invalid @enderror" id="company_owner" name="company_owner" type="text"
                value="{{ Setting::value('company.owner') }}" placeholder="Nama Pemilik">
              @error('company_owner')
                <span class="text-danger">
                  {{ $message }}
                </span>
              @enderror
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </div>
@endSection


@section('footscript')
  <script>
    $('.select2').select2();
  </script>
@endSection
