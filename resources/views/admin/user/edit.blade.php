@php
  $title = (!$user->id ? 'Tambah' : 'Edit') . ' Pengguna';
@endphp

@extends('admin._layouts.default', [
    'title' => $title,
    'menu_active' => 'system',
    'nav_active' => 'user',
    'form_action' => url('/admin/user/edit/' . (int) $user->id),
])

@section('right-menu')
  <li class="nav-item">
    <button class="btn btn-primary mr-1" type="submit"><i class="fas fa-save mr-1"></i> Simpan</button>
    <a class="btn btn-default" href="{{ url('/admin/user/') }}" onclick="return confirm('Batalkan perubahan?')"><i
        class="fas fa-cancel mr-1"></i>Batal</a>
  </li>
@endSection

@section('content')
  <div class="row">
    <div class="col-lg-5">
      <div class="card card-primary">
        <input name="id" type="hidden" value="{{ (int) $user->id }}">
        <div class="card-body">
          <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control @error('username') is-invalid @enderror" id="username" name="username" type="text" value="{{ old('username', $user->username) }}" autofocus
              placeholder="Username" {{ $user->id ? 'readonly' : '' }}>
            @if (!$user->id)
              <p class="text-muted">Setelah disimpan username tidak bisa diganti.</p>
              @error('username')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            @endif
          </div>
          <div class="form-group">
            <label for="fullname">Nama Lengkap</label>
            <input class="form-control @error('fullname') is-invalid @enderror" id="fullname" name="fullname" type="text" value="{{ old('fullname', $user->fullname) }}"
              placeholder="Nama Lengkap">
            @error('fullname')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="password">Kata Sandi</label>
            <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="text" value="{{ old('password') }}" placeholder="Kata Sandi">
            <div class="text-muted">
              @if ($user->id)
                Isi apabila ingin mengatur ulang kata sandi.
              @else
                Buat kata sandi baru.
              @endif
            </div>
            @error('password')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="officer_id">Officer</label>
            <select class="custom-select select2 @error('officer_id') is-invalid @enderror" id="officer_id" name="officer_id">
              <option value="" {{ !$user->officer_id ? 'selected' : '' }}>-- Pilih Officer --</option>
              @foreach ($officers as $officer)
                <option value="{{ $officer->id }}" {{ old('officer_id', $user->officer_id) == $officer->id ? 'selected' : '' }}>
                  {{ $officer->name }}
                </option>
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
              <input class="custom-control-input " id="active" name="is_active" type="checkbox" value="1"
                {{ old('is_active', $user->is_active) ? 'checked="checked"' : '' }}>
              <label class="custom-control-label" for="active" title="Akun aktif dapat login">Aktif</label>
            </div>
            <div class="text-muted">Akun aktif dapat login.</div>
          </div>
          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input " id="is_admin" name="is_admin" type="checkbox" value="1" {{ old('is_admin', $user->is_admin) ? 'checked="checked"' : '' }}>
              <label class="custom-control-label" for="is_admin" title="Akun pengguna pengelola">Administrator</label>
            </div>
            <p class="text-muted">Akun administrator memiliki hak akses penuh pada sistem.</p>
          </div>
          <div class="form-group" id="acl-editor">
            <div class="form-row col-md-12 mt-4">
              <h5>Hak Akses Pengguna</h5>
            </div>
            @foreach ($resources as $key => $resource)
              <div class="p-2 mt-2 mb-2" style="border: 1px solid #ddd;border-radius:5px;">
                <h5 class="mb-0">{{ $key }}</h5>
                @foreach ($resource as $name => $label)
                  @if (is_array($label))
                    <h6 class="mt-3 mb-0">{{ $name }}</h6>
                    <div class="d-flex flex-row flex-wrap">
                      @foreach ($label as $subname => $sublabel)
                        <div class="mr-3 custom-control custom-checkbox">
                          <input class="custom-control-input" id="{{ $subname }}" name="acl[{{ $subname }}]" type="checkbox" value="1"
                            @if (isset($user->acl()[$subname]) && $user->acl()[$subname] == true) {{ 'checked="checked"' }} @endif>
                          <label class="custom-control-label" for="{{ $subname }}" style="font-weight:normal; white-space: nowrap;">{{ $sublabel }}</label>
                        </div>
                      @endforeach
                    </div>
                  @else
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" id="{{ $name }}" name="acl[{{ $name }}]" type="checkbox" value="1"
                        @if (isset($user->acl()[$name]) && $user->acl()[$name] == true) {{ 'checked="checked"' }} @endif>
                      <label class="custom-control-label" for="{{ $name }}" style="font-weight:normal; white-space: nowrap;">{{ $label }}</label>
                    </div>
                  @endif
                @endforeach
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endSection
@section('footscript')
  <script>
    $(document).ready(function() {
        $('.select2').select2();
      const on_is_admin_change = function() {
        if ($('#is_admin')[0].checked) {
          $('#acl-editor').hide();
        } else {
          $('#acl-editor').show();
        }
      }

      $('.is-invalid').focus();
      $('#is_admin').change(function() {
        on_is_admin_change();
      });

      on_is_admin_change();
    });
  </script>
@endsection

