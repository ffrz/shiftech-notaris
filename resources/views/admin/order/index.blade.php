@extends('admin._layouts.default', [
    'title' => 'Klien',
    'menu_active' => 'order',
    'nav_active' => 'order',
])

@section('right-menu')
  <li class="nav-item">
    <a class="btn  btn-primary mr-2" href="{{ url('/admin/order/edit/0') }}" title="Baru"><i
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
                  <label class="mr-2" for="status">Status:</label>
                  <select class="form-control custom-select mr-4" id="status" name="status" onchange="this.form.submit();">
                    <option value="-1">Semua</option>
                    <option value="0" {{ $filter['status'] == 0 ? 'selected' : '' }}>Aktif</option>
                    <option value="1" {{ $filter['status'] == 1 ? 'selected' : '' }}>Selesai</option>
                    <option value="2" {{ $filter['status'] == 2 ? 'selected' : '' }}>Dibatalkan</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6 d-flex justify-content-end">
                <div class="form-group form-inline">
                  <label class="mr-2" for="search">Cari:</label>
                  <input class="form-control" id="search" name="search" type="text" value="{{ $filter['search'] }}" placeholder="Cari order">
                </div>
              </div>
            </div>
          </form>
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tanggal</th>
                  <th>Layanan</th>
                  <th>Klien</th>
                  <th>Officer</th>
                  <th>Biaya</th>
                  <th>Sisa</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($items as $i => $item)
                  <tr class="{{ $item->status == 1 ? 'table-success' : ($item->status == 2 ? 'table-danger' : '') }}">
                    <td>{{ $item->id }}</td>
                    <td>{{ format_date($item->date) }}</td>
                    <td>{{ $item->service->name }}</td>
                    <td><a href="{{ url('/admin/customer/detail/' . $item->customer->id ) }}">{{ $item->customer->name }}</a></td>
                    <td><a href="{{ url('/admin/officer/detail/' . $item->officer->id ) }}">{{ $item->officer->name }}</a></td>
                    <td class="text-right">{{ format_number($item->total) }}</td>
                    <td class="text-right">{{ format_number($item->total - $item->total_paid) }}</td>
                    <td class="text-center">{{ $item->statusFormatted() }}</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a class="btn btn-default btn-sm" href="{{ url("/admin/order/detail/$item->id") }}"><i
                            class="fa fa-eye"></i></a>
                        <a class="btn btn-default btn-sm" href="{{ url("/admin/order/edit/$item->id") }}"><i
                            class="fa fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" href="{{ url("/admin/order/delete/$item->id") }}" onclick="return confirm('Anda yakin akan menghapus rekaman ini?')"><i
                            class="fa fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr class="empty">
                    <td colspan="4">Tidak ada rekaman untuk ditampilkan.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
      @include('admin._components.paginator', ['items' => $items])
    </div>
  </div>
@endSection
