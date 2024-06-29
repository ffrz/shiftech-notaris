@php
  $title = 'Rincian Pesanan';
@endphp

@extends('admin._layouts.default', [
    'title' => $title,
    'menu_active' => 'order',
    'nav_active' => 'customer',
])

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-file-lines mr-1"></i>
            Informasi Pesanan
          </h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <h5>Info Pesanan</h5>
              <table class="table table-sm table-striped table-bordered">
                <tr>
                  <td style="width:10%">No Pesanan</td>
                  <td>#{{ $item->id }}</td>
                </tr>
                <tr>
                  <td>Tanggal</td>
                  <td>{{ format_date($item->date) }}</td>
                </tr>
                <tr>
                  <td class="text-nowrap">Tanggal Selesai</td>
                  <td>{{ $item->closed_date ? format_date($item->closed_date) : '-' }}</td>
                </tr>
                <tr>
                  <td class="text-nowrap">Status Pesanan</td>
                  <td>{{ $item->statusFormatted() }}</td>
                </tr>
                <tr>
                  <td>Layanan</td>
                  <td>{{ $item->service->name }}</td>
                </tr>
                <tr>
                  <td>Deskripsi</td>
                  <td>{{ $item->description }}</td>
                </tr>
                @if ($item->partner)
                  <tr>
                    <td>Notaris Rekanan</td>
                    <td>{{ $item->partner->name }}</td>
                  </tr>
                @endif
                <tr>
                  <td>Biaya</td>
                  <td>Rp. {{ format_number($item->total) }}</td>
                </tr>
                <tr>
                  <td>Dibayar</td>
                  <td>Rp. {{ format_number($item->total_paid) }}</td>
                </tr>
                <tr>
                  <td>Piutang</td>
                  <td>Rp. {{ format_number($item->total - $item->total_paid) }}</td>
                </tr>
                <tr>
                  <td>Officer</td>
                  <td>{{ $item->officer->name }}</td>
                </tr>
                <tr>
                  <td>Catatan</td>
                  <td>{{ $item->notes }}</td>
                </tr>
              </table>
              <h5>Info Klien</h5>
              <table class="table table-sm table-striped table-bordered">
                <tr>
                  <td class="text-nowrap" style="width:10%">Nama Klien</td>
                  <td>{{ $item->customer->name }}</td>
                </tr>
                <tr>
                  <td>No. Telepon</td>
                  <td>{{ $item->customer->phone }}</td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>{{ $item->customer->email }}</td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td>{{ $item->customer->address }}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-file-lines mr-1"></i>
            Informasi Proses
          </h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <table class="table table-sm table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Proses</th>
                    <th>Biaya</th>
                    <th>Selesai</th>
                    <th>Diambil</th>
                    <th>Tgl Diambil</th>
                    <th>Biaya</th>
                    <th>Catatan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center" colspan="8">Belum tersedia</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-file-lines mr-1"></i>
            Informasi Tagihan
          </h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <table class="table table-sm table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Uraian</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center" colspan="5">Belum tersedia</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endSection
