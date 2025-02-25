@extends('admin._layouts.default', [
    'title' => 'Akun Kas / Rekening',
    'menu_active' => 'finance',
    'nav_active' => 'cash-account',
])

@section('right-menu')
  <li class="nav-item">
    <a href="{{ url('/admin/cash-account/edit/0') }}" class="btn  btn-primary mr-2" title="Baru"><i
        class="fa fa-plus"></i></a>
  </li>
@endSection

@section('content')
  <div class="card card-light">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th style="width:30%">Kode</th>
                  <th style="width:30%">Nama Akun</th>
                  <th>Jenis</th>
                  <th>Bank</th>
                  <th>No Rek</th>
                  <th>Saldo</th>
                  <th style="width:5%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($items as $item)
                  <tr>
                    <td>{{ $item->idFormatted() }}</td>
                    <td>{{ $item->name }}</td>
                    <td class="text-center">{{ $item->type == 0 ? 'Tunai' : 'Bank' }}</td>
                    <td>{{ $item->bank }}</td>
                    <td>{{ $item->number }}</td>
                    <td class="text-right">{{ format_number($item->balance) }}</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="{{ url("/admin/cash-account/edit/$item->id") }}" class="btn btn-default btn-sm"><i
                            class="fa fa-edit"></i></a>
                        <a onclick="return confirm('Anda yakin akan menghapus rekaman ini?')"
                          href="{{ url("/admin/cash-account/delete/$item->id") }}" class="btn btn-danger btn-sm"><i
                            class="fa fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr class="empty">
                    <td colspan="7">Tidak ada rekaman untuk ditampilkan.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endSection
