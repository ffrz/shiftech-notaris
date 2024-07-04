@php
  $title = 'Tutup Pesanan';
@endphp

@extends('admin._layouts.default', [
    'title' => $title,
    'menu_active' => 'order',
    'nav_active' => 'order',
    'form_action' => url('admin/order/close/' . $item->id),
])

@section('right-menu')
  <li class="nav-item">
    <button class="btn btn-primary mr-1" type="submit"><i class="fas fa-check mr-1"></i> Selesai</button>
    <a class="btn btn-default" href="{{ url('/admin/order/detail/' . $item->id) }}" onclick="return confirm('Batalkan perubahan?')">
      <i class="fas fa-chevron-left mr-1"></i> Kembali
    </a>
  </li>
@endSection

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-body">
          <div class="form-group">
            <label for="id">No Pesanan</label>
            <input class="form-control" id="id" type="text" value="#{{ $item->id }}" readonly>
          </div>
          <div class="form-group">
            <label for="date">Tanggal</label>
            <input class="form-control" id="date" type="text" value="{{ format_date($item->date) }}" readonly>
          </div>
          <div class="form-group">
            <label for="service_id">Layanan</label>
            <input class="form-control" id="service_id" type="text" value="{{ $item->service->name }}" readonly>
          </div>
          <div class="form-group">
            <label for="customer_id">Klien</label>
            <input class="form-control" id="customer_id" type="text" value="{{ $item->customer->name }}" readonly>
          </div>
          <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea class="form-control" id="description" readonly>{{ $item->description }}</textarea>
          </div>
          <div class="form-group">
            <label for="deed_number">No Akta</label>
            <input class="form-control" id="deed_number" type="text" value="{{ $item->deed_number }}" readonly>
          </div>
          <div class="form-group">
            <label for="officer_id">Officer</label>
            <input class="form-control" id="officer_id" type="text" value="{{ $item->officer->name }}" readonly>
          </div>
          @if ($item->partner)
            <div class="form-group">
              <label for="partner_id">Notaris Rekanan</label>
              <input class="form-control" id="partner_id" type="text" value="{{ $item->partner->name }}" readonly>
            </div>
          @endif
          <div class="form-group">
            <label for="status">Status Pesanan</label>
            <select class="form-control custom-select @error('status') is-invalid @enderror" id="status" name="status">
              <option value="" {{ empty(old('status', $item->status)) ? 'selected' : '' }}>Pilih Status</option>
              <option value="1" {{ old('status', $item->status) == 1 ? 'selected' : '' }}>Selesai</option>
              <option value="2" {{ old('status', $item->status) == 2 ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            @error('status')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="total">Biaya</label>
            <input class="form-control @error('total') is-invalid @enderror" id="total" name="total" type="total"
                value="{{ format_number(number_from_input(old('total', format_number($item->total)))) }}">
            @error('total')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="notes">Catatan</label>
            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" cols="30" rows="4">{{ old('notes', $item->notes) }}</textarea>
            @error('notes')
              <span class="text-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
        </div>
      </div>
    </div>
  </div>
@endSection

@section('footscript')
  <script>
    $(document).ready(function() {
      Inputmask("decimal", Object.assign({
        allowMinus: false
      }, INPUTMASK_OPTIONS)).mask("#total");
      const onPartnerStatusChanged = function() {
        if ($('#partner_status')[0].checked) {
          $('#partner_id').attr('disabled', false);
        } else {
          $('#partner_id').attr('disabled', true);
          $('#partner_id').val('')
        }
      }
      $('.select2').select2();
      $('#partner_status').change(onPartnerStatusChanged);

      onPartnerStatusChanged();
    });
  </script>
@endSection
