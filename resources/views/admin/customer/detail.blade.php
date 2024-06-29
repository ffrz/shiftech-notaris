@php
  $title = 'Rincian Pelanggan';
  use App\Models\StockUpdate;
  use App\Models\ServiceOrder;
@endphp

@extends('admin._layouts.default', [
    'title' => $title,
    'menu_active' => 'sales',
    'nav_active' => 'customer',
])

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header" style="padding:0;border-bottom:0;">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1"
                role="tab"aria-controls="tab1">Info Pelanggan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab"
                aria-controls="tab2">Riwayat Pesanan</a>
            </li>
          </ul>
        </div>
        <div class="tab-content card-body" id="myTabContent">
          <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
            <div class="row">
              <div class="col-lg-4">
                <table class="table info table-striped">
                  <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $item->name }}</td>
                  </tr>
                  <tr>
                    <td>Telepon</td>
                    <td>:</td>
                    <td>{{ $item->phone }}</td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $item->address }}</td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>{{ $item->active ? 'Aktif' : 'Non Aktif' }}</td>
                  </tr>
                  <tr>
                    <td class="text-nowrap">Jumlah Order</td>
                    <td>:</td>
                    <td>{{ format_number($item->sales_count) }} kali</td>
                  </tr>
                  <tr>
                    <td class="text-nowrap">Total Transaksi</td>
                    <td>:</td>
                    <td>Rp. {{ format_number($item->total_sales) }}</td>
                  </tr>
                  <tr>
                    <td class="text-nowrap">Total Keuntungan</td>
                    <td>:</td>
                    <td>Rp. {{ format_number($item->total_profit) }}</td>
                  </tr>
                  <tr>
                    <td class="text-nowrap">Total Piutang</td>
                    <td>:</td>
                    <td>Rp. {{ format_number($item->total_receivable) }}</td>
                  </tr>
                  <tr>
                    <td class="text-nowrap">Jumlah Order</td>
                    <td>:</td>
                    <td>{{ format_number($item->order_count) }} kali</td>
                  </tr>
                  <tr>
                    <td>Catatan</td>
                    <td>:</td>
                    <td>{!! nl2br(e($item->notes)) !!}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th style="width:12%;">#</th>
                        <th style="width:12%;">Tanggal</th>
                        <th style="width:1%;">Status</th>
                        <th>Total</th>
                        <th>Piutang</th>
                        <th style="width:1%;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      {{-- @forelse ($item->orders as $subitem)
                        <tr
                          class="{{ $subitem->status == StockUpdate::STATUS_CANCELED ? 'table-danger' : ($subitem->status == StockUpdate::STATUS_OPEN ? 'table-warning' : '') }}">
                          <td>{{ $subitem->idFormatted() }}</td>
                          <td>{{ format_datetime($subitem->datetime) }}</td>
                          <td>{{ $subitem->statusFormatted() }}</td>
                          <td class="text-right">{{ format_number(abs($subitem->total)) }}</td>
                          <td class="text-right">{{ format_number($subitem->total_receivable) }}</td>
                          <td class="text-center">
                            <div class="btn-group">
                              @if ($subitem->status != StockUpdate::STATUS_OPEN)
                                <a href="{{ url("/admin/sales-order/detail/$subitem->id") }}"
                                  class="btn btn-default btn-sm"><i class="fa fa-eye" title="View"></i></a>
                              @endif
                            </div>
                          </td>
                        </tr>
                      @empty
                        <tr class="empty">
                          <td colspan="7">Tidak ada rekaman untuk ditampilkan.
                          </td>
                        </tr>
                      @endforelse --}}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endSection
