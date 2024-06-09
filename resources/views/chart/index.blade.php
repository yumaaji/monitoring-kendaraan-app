@extends('layouts.main')

@section('main-content')
<section class="section">
  <div class="section-header">
    <h1>Statistik Kendaraan</h1>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Perusahaan</h4>
          </div>
          <div class="card-body">
            {{ $companies->count() }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="far fa-newspaper"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Kendaraan</h4>
          </div>
          <div class="card-body">
            {{ $transports->count() }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Driver</h4>
          </div>
          <div class="card-body">
            {{ $drivers->count() }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="far fa-file"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Pengajuan</h4>
          </div>
          <div class="card-body">
            {{ $lendings->count() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-md-6">
        {!! $chart->container() !!}
      </div>
      <div class="col-md-6">
        {!! $fuel->container() !!}
      </div>
    </div>
  </div>
</section>

<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}

<script src="{{ $fuel->cdn() }}"></script>
{{ $fuel->script() }}
@endsection