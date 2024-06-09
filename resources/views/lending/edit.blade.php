@extends('layouts.main')

@section('main-content')
<section class="section">
  <div class="section-header">
    <h1>Edit Pengajuan Kendaraan</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item"><a href="dashboard/admin">Dashboard</a></div>
      <div class="breadcrumb-item"><a href="/pengajuan">Data Pengajuan</a></div>
    </div>
  </div>
  
  <div class="card">
    <div class="card-body">
      <form action="{{ route('pengajuan.update', $lending->id) }}" method="POST">
        @method('PUT')
        @csrf
        <input type="hidden" name="status" value="1">
        <div class="form-group mb-3">
          <label>Nama Kendaraan</label>
          <select class="form-control" name="transport_id" required>
              <option selected disabled value="">Pilih Salah Satu</option>
              @foreach ($transports as $transport)
                  <option value="{{ $transport->id }}" @if($transport->id == $lending->transport_id) selected @endif>{{ $transport->name }}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group mb-3">
          <label>Nama Driver</label>
          <select class="form-control" name="driver_id" required>
              <option selected disabled value="">Pilih Salah Satu</option>
              @foreach ($drivers as $driver)
                  <option value="{{ $driver->id }}" @if ($driver->id == $lending->driver_id) selected @endif>{{ $driver->name }}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Tujuan Kendaraan</label>
          <textarea class="form-control" name="purpose" required>{{ $lending->purpose }}</textarea>
        </div>
        <div class="form-group">
          <label>Tanggal Mulai</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i class="fas fa-calendar"></i>
              </div>
            </div>
            <input type="text" class="form-control datepicker" name="start_date" value="{{ $lending->start_date }}">
          </div>
        </div>
        <div class="form-group">
          <label>Tanggal Selesai</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i class="fas fa-calendar"></i>
              </div>
            </div>
            <input type="text" class="form-control datepicker" name="end_date" value="{{ $lending->end_date }}">
          </div>
        </div>
        <div class="form-group mb-3">
          <label>Nama Penanggung Jawab</label>
          <select class="form-control" name="supervisor_id" required>
              <option selected disabled value="">Pilih Salah Satu</option>
              @foreach ($supervisors as $supervisor)
                  <option value="{{ $supervisor->id }}" @if ($supervisor->id == $lending->supervisor_id) selected  
                  @endif>{{ $supervisor->name }}</option>
              @endforeach
          </select>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <a href="{{ route('pengajuan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection