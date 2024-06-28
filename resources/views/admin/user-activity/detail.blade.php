@extends('admin._layouts.default', [
    'title' => 'Aktifitas Pengguna',
    'menu_active' => 'system',
    'nav_active' => 'user-activity',
])

@section('right-menu')
  <li class="nav-item">
    <a class="btn btn-default" href="{{ url('/admin/user-activity' ) }}"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
    <a class="btn btn-danger" href="{{ url('/admin/user-activity/delete/' . $item->id ) }}"><i class="fas fa-trash mr-1" onclick="return confirm('Hapus aktifitas?')"></i>Hapus</a>
  </li>
@endSection

@section('content')
  <div class="card card-light">
    <div class="card-body">
      <h5>Rincian Aktifitas Pengguna</h5>
      <table class="table table-sm" style="width='100%;'">
        <tr>
          <td class="text-nowrap" style="width:5%">#ID Aktifitas</td>
          <td style="width:1%">:</td>
          <td>{{ $item->id }}</td>
        </tr>
        <tr>
          <td class="text-nowrap">Waktu & Tanggal</td>
          <td>:</td>
          <td>{{ $item->datetime }}</td>
        </tr>
        <tr>
          <td>Pengguna</td>
          <td>:</td>
          <td>{{ $item->user_id ? $item->user_id . ' - ' : '' }}{{ $item->username }}</td>
        </tr>
        <tr>
          <td class="text-nowrap">Tipe Aktifitas</td>
          <td>:</td>
          <td>{{ $item->typeFormatted() }}</td>
        </tr>
        <tr>
          <td>Aktifitas</td>
          <td>:</td>
          <td>{{ $item->name }}</td>
        </tr>
        <tr>
          <td class="text-nowrap">Deskripsi / Pesan</td>
          <td>:</td>
          <td>{!! e($item->description) !!}</td>
        </tr>
        @if ($item->data)
          <tr>
            <td colspan="3">
              <table>
                <tr>
                  <td>
                    @if (!empty($item->data['Old Data']))
                      <h5 class="mt-3">Data Sebelumnya:</h5>
                      <table class="table-sm table">
                        @foreach ($item->data['Old Data'] as $key => $data)
                          <tr>
                            <td style="width:5%">{{ $key }}</td>
                            <td style="width:1%">:</td>
                            <td>{{ $data }}</td>
                          </tr>
                        @endforeach
                      </table>
                    @endif
                  </td>
                  <td>
                    @if (!empty($item->data['New Data']))
                      <h5 class="mt-3">Data Baru:</h5>
                      <table class="table table-sm">
                        @foreach ($item->data['New Data'] as $key => $data)
                          <tr>
                            <td style="width:5%;visibility:none;">{{ $key }}</td>
                            <td style="width:1%;display:none;">:</td>
                            <td>{{ $data }}</td>
                          </tr>
                        @endforeach
                      </table>
                    @endif
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        @else
          <tr>
            <td style="width:5%">Data Ekstra</td>
            <td style="width:1%">:</td>
            <td>Tidak ada.</td>
          </tr>
        @endif
      </table>
    </div>
  </div>
  </div>
@endsection
