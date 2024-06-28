@php
  $title = ($item->id ? 'Edit' : 'Tambah') . ' Saksi';
@endphp

@extends('admin._layouts.default', [
    'title' => $title,
    'menu_active' => 'system',
    'nav_active' => 'witness',
    'form_action' => url('admin/witness/edit/' . (int) $item->id),
])

@section('right-menu')
  <li class="nav-item">
    <button class="btn btn-primary mr-1" type="submit"><i class="fas fa-save mr-1"></i> Simpan</button>
    <a class="btn btn-default" href="{{ url('/admin/witness/') }}" onclick="return confirm('Batalkan perubahan?')"><i class="fas fa-cancel mr-1"></i>Batal</a>
  </li>
@endSection

@section('content')
  <div class="row">
    <div class="col-md-4">
      <div class="card card-primary">
        <div class="card-body">
          <div class="form-group">
            <label for="name">Nama Saksi <span class="required">*</span></label>
            <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" value="{{ old('name', $item->name) }}" autofocus>
            @error('name')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="description">Keterangan <span class="required">*</span></label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $item->description) }}</textarea>
          </div>
          <div class="form-group">
            <label for="notes">Catatan</label>
            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes">{{ old('notes', $item->notes) }}</textarea>
          </div>
          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input " id="active" name="active" type="checkbox" value="1" {{ old('active', $item->active) ? 'checked="checked"' : '' }}>
              <label class="custom-control-label" for="active" title="Saksi aktif dapat digunakan.">Aktif</label>
            </div>
            <div class="text-muted">Saksi tidak aktif akan disembunyikan.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endSection
