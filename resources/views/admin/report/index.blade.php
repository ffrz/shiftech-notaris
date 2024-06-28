@extends('admin._layouts.default', [
    'title' => 'Laporan-laporan',
    'menu_active' => 'report',
    'nav_active' => 'report',
])

@section('content')
  <div class="card">
    <div class="card-body">
      <section>
        <h5>Laporan Pengeluaran</h5>
        <ul>
            <li><a href="#">Laporan Rincian Pengeluaran</a></li>
            <li><a href="#">Laporan Rekapitulasi Pengeluaran</a></li>
        </ul>
      </section>
      <section>
        <h5>Laporan Keuangan</h5>
        <ul>
            <li><a href="#">Laporan Rincian Transaksi Keuangan</a></li>
            <li><a href="#">Laporan Rekapitulasi Transaksi Keuangan</a></li>
        </ul>
      </section>
    </div>
  </div>
@endsection
