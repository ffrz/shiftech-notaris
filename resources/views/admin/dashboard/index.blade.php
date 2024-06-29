@extends('admin._layouts.default', [
    'title' => 'Dashboard',
    'nav_active' => 'dashboard',
])

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4>{{ 36 }}</h4>
              <p>Order Aktif</p>
            </div>
            <div class="icon">
              <i class="fas fa-screwdriver-wrench"></i>
            </div>
            <a class="small-box-footer" href="/admin/service-order?order_status=0&service_status=-1&payment_status=-1"><i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4><sup style="font-size: 20px">Rp. </sup>{{ format_number(46325000) }}</h4>
              <p>Omset Bulan Ini</p>
            </div>
            <div class="icon">
              <i class="fa fa-money-bills"></i>
            </div>
            <a class="small-box-footer" href="#"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4>{{ 46 }}</h4>
              <p>Jumlah Order Bulan Ini</p>
            </div>
            <div class="icon">
              <i class="fa fa-receipt"></i>
            </div>
            <a class="small-box-footer" href="#"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h4>{{ 46 }}</h4>
              <p>Jumlah Order Bulan Ini</p>
            </div>
            <div class="icon">
              <i class="fa fa-receipt"></i>
            </div>
            <a class="small-box-footer" href="#"><i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Order Juni 2024</h3>
              <div class="card-tools">
                <a class="btn btn-tool">
                  <i class="fas fa-chevron-left"></i>
                </a>
                <a class="btn btn-tool">
                  <i class="fas fa-chevron-right"></i>
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <div class="chartjs-size-monitor">
                      <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                      </div>
                      <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                      </div>
                    </div>
                    <canvas class="chartjs-render-monitor" id="pieChart" style="display: block; width: 221px; height: 110px;" height="110" width="221"></canvas>
                  </div>

                </div>

                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="far fa-circle text-danger"></i> Pendirian PT</li>
                    <li><i class="far fa-circle text-success"></i> Pendirian CV</li>
                    <li><i class="far fa-circle text-warning"></i> Pendirian Yayasan</li>
                  </ul>
                </div>

              </div>

            </div>

            <div class="card-footer p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    Lokasi 1
                    <span class="float-right text-danger">
                      <i class="fas fa-arrow-down text-sm"></i>
                      12%</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    Lokasi 2
                    <span class="float-right text-success">
                      <i class="fas fa-arrow-up text-sm"></i> 4%
                    </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    Lokasi 3
                    <span class="float-right text-warning">
                      <i class="fas fa-arrow-left text-sm"></i> 0%
                    </span>
                  </a>
                </li>
              </ul>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
