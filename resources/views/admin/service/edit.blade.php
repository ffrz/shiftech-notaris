@php
  $title = ($item->id ? 'Edit' : 'Tambah') . ' Layanan';
@endphp

@extends('admin._layouts.default', [
    'title' => $title,
    'menu_active' => 'system',
    'nav_active' => 'service',
    'form_action' => url('admin/service/edit/' . (int) $item->id),
])

@section('right-menu')
  <li class="nav-item">
    <button class="btn btn-primary mr-1" type="submit"><i class="fas fa-save mr-1"></i> Simpan</button>
    <a class="btn btn-default" href="{{ url('/admin/service/') }}" onclick="return confirm('Batalkan perubahan?')"><i class="fas fa-cancel mr-1"></i>Batal</a>
  </li>
@endSection

@section('content')
  <div class="row">
    <div class="col-md-4">
      <div class="card card-primary">
        <div class="card-body">
          <div class="form-group">
            <label for="name">Nama Layanan <span class="required">*</span></label>
            <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" value="{{ old('name', $item->name) }}" autofocus>
            @error('name')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="price">Harga <span class="required">*</span></label>
            <input class="form-control decimal @error('price') is-invalid @enderror" id="price" name="price" type="text" value="{{ format_number(old('price', $item->price)) }}"
              autofocus>
            @error('price')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input " id="active" name="active" type="checkbox" value="1" {{ old('active', $item->active) ? 'checked="checked"' : '' }}>
              <label class="custom-control-label" for="active" title="Layanan aktif dapat digunakan.">Aktif</label>
            </div>
            <div class="text-muted">Layanan tidak aktif akan disembunyikan.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endSection

@section('footscript')
  <script>
    Inputmask("decimal", Object.assign({
      allowMinus: false
    }, INPUTMASK_OPTIONS)).mask("#price");
  </script>
@endsection
