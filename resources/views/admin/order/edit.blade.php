@php
  $title = ($item->id ? 'Edit' : 'Tambah') . ' Pesanan';
@endphp

@extends('admin._layouts.default', [
    'title' => $title,
    'menu_active' => 'order',
    'nav_active' => 'order',
    'form_action' => url('admin/order/edit/' . (int) $item->id),
])

@section('right-menu')
  <li class="nav-item">
    <button class="btn btn-primary mr-1" type="submit"><i class="fas fa-save mr-1"></i> Simpan</button>
    <a class="btn btn-default" href="{{ url('/admin/order/') }}" onclick="return confirm('Batalkan perubahan?')"><i
        class="fas fa-cancel mr-1"></i>Batal</a>
  </li>
@endSection

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-body">
          <div class="form-group">
            <label for="customer_id">Klien <span class="required" title="Harus diisi">*</span></label>
            <select class="select2 form-control" id="customer_id" name="customer_id">
              <option value="">Pilih Klien</option>
              @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" {{ $customer->id == $item->customer_id ? 'selected' : '' }}>{{ "[$customer->id] $customer->name" }}</option>
              @endforeach
            </select>
            @error('customer_id')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="service_id">Layanan <span class="required" title="Harus diisi">*</span></label>
            <select class="select2 form-control" id="service_id" name="service_id">
              <option value="">Pilih Layanan</option>
              @foreach ($services as $service)
                <option value="{{ $service->id }}" {{ $service->id == $item->service_id ? 'selected' : '' }}>{{ "[$service->id] $service->name" }}</option>
              @endforeach
            </select>
            @error('service_id')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="description">Deskripsi <span class="required" title="Harus diisi">*</span></label>
            <input class="form-control @error('description') is-invalid @enderror" id="description" name="description" type="text"
              value="{{ old('description', $item->description) }}">
            @error('description')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="deed_number">No Akta</label>
            <input class="form-control @error('deed_number') is-invalid @enderror" id="deed_number" name="deed_number" type="text"
              value="{{ old('deed_number', $item->deed_number) }}">
            @error('deed_number')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="file_number">No Berkas</label>
            <input class="form-control @error('file_number') is-invalid @enderror" id="file_number" name="file_number" type="text"
              value="{{ old('file_number', $item->file_number) }}">
            @error('file_number')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="deed_properties">Sifat Akta</label>
            <input class="form-control @error('deed_properties') is-invalid @enderror" id="deed_properties" name="deed_properties" type="text"
              value="{{ old('deed_properties', $item->deed_properties) }}">
            @error('deed_properties')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label class="col-form-label" for="date">Tanggal</label>
            <input class="form-control @error('date') is-invalid @enderror" id="date" name="date" type="date" value="{{ old('date', $item->date) }}" autofocus>
            @error('date')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="officer_id">Officer <span class="required" title="Harus diisi">*</span></label>
            <select class="select2 form-control" id="officer_id" name="officer_id">
              <option value="">Pilih Officer</option>
              @foreach ($officers as $officer)
                <option value="{{ $officer->id }}" {{ $officer->id == $item->officer_id ? 'selected' : '' }}>{{ "[$officer->id] $officer->name" }}</option>
              @endforeach
            </select>
            @error('officer_id')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input " id="partner_status" name="partner_status" type="checkbox" value="1"
                {{ old('partner_id', $item->partner_id) ? 'checked="checked"' : '' }}>
              <label class="custom-control-label" for="partner_status" title="Akun aktif dapat digunakan">Diserahkan ke Notaris Rekanan</label>
            </div>
            <select class="select2 form-control" id="partner_id" name="partner_id">
              <option value="">Pilih Notaris</option>
              @foreach ($partners as $partner)
                <option value="{{ $partner->id }}" {{ $partner->id == $item->partner_id ? 'selected' : '' }}>{{ "[$partner->id] $partner->name" }}</option>
              @endforeach
            </select>
            @error('partner')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label class="col-form-label" for="total">Biaya</label>
            <input class="form-control @error('total') is-invalid @enderror" id="total" name="total" type="total"
              value="{{ format_number(old('total', $item->total)) }}" autofocus>
            @error('total')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="notes">Catatan</label>
            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" cols="30" rows="4">{{ old('notes', $item->notes) }}</textarea>
            @error('notes')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
        </div>
      </div>
    </div>
  </div>
@endSection

@section('footscript')
  <script>
    $(document).ready(function() {
      Inputmask("decimal", Object.assign({
        allowMinus: false
      }, INPUTMASK_OPTIONS)).mask("#total");
      const onPartnerStatusChanged = function() {
        if ($('#partner_status')[0].checked) {
            $('#partner_id').attr('disabled', false);
        }
        else {
            $('#partner_id').attr('disabled', true);
            $('#partner_id').val('')
        }
      }
      $('.select2').select2();
      $('#partner_status').change(onPartnerStatusChanged);

      onPartnerStatusChanged();
    });
  </script>
@endSection
