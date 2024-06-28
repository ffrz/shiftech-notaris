@extends('admin._layouts.default', [
    'title' => 'Partner',
    'menu_active' => 'system',
    'nav_active' => 'partner',
])

@section('right-menu')
  <li class="nav-item">
    <a class="btn  btn-primary mr-2" href="{{ url('/admin/partner/edit/0') }}" title="Baru"><i
        class="fa fa-plus"></i></a>
  </li>
@endSection

@section('content')
  <div class="card card-light">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form action="?">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group form-inline">
                  <label class="mr-2" for="active">Status:</label>
                  <select class="form-control custom-select mr-4" id="active" name="active" onchange="this.form.submit();">
                    <option value="-1">Semua</option>
                    <option value="1" {{ $filter['active'] == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $filter['active'] == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6 d-flex justify-content-end">
                <div class="form-group form-inline">
                  <label class="mr-2" for="search">Cari:</label>
                  <input class="form-control" id="search" name="search" type="text" value="{{ $filter['search'] }}" placeholder="Cari saksi">
                </div>
              </div>
            </div>
          </form>
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th style="width:30%">Nama Partner</th>
                  <th>Area Kerja</th>
                  <th>Alamat</th>
                  <th>Status</th>
                  <th style="width:5%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($items as $item)
                  <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->area }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->active ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-default btn-sm" href="{{ url("/admin/partner/edit/$item->id") }}"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-default btn-sm" href="{{ url("/admin/partner/duplicate/$item->id") }}"><i class="fa fa-copy"></i></a>
                        <a class="btn btn-danger btn-sm" href="{{ url("/admin/partner/delete/$item->id") }}" onclick="return confirm('Anda yakin akan menghapus rekaman ini?')"><i
                            class="fa fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr class="empty">
                    <td colspan="3">Tidak ada rekaman untuk ditampilkan.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          @include('admin._components.paginator', ['items' => $items])
        </div>
      </div>
    </div>
  </div>
@endSection
