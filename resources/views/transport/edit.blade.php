@extends('layouts.main')

@section('main-content')
<section class="section">
  <div class="section-header">
    <h1>Data Kendaran</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item"><a href="dashboard/admin">Dashboard</a></div>
      <div class="breadcrumb-item"><a href="/kendaran">Data Kendaran</a></div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('kendaraan.update', $transport->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $transport->id }}">
        <div class="form-group mb-3">
          <label>Nama Perusahaan</label>
          <select class="form-control" name="company_id" required>
            <option selected disabled value="">Pilih Salah Satu</option>
            @foreach ($companies as $company)
              <option value="{{ $company->id }}" @if($company->id == $transport->company_id) selected @endif>
                {{ $company->name }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="form-group mb-3">
          <label>Nama Kendaraan</label>
          <input type="text" class="form-control" name="name" value="{{ $transport->name }}" required>
        </div>
        <div class="form-group mb-3">
          <label>Tipe Kendaraan</label>
          <input type="text" class="form-control" name="product_type" value="{{ $transport->product_type }}" required>
        </div>
        <div class="form-group mb-3">
          <label>Jenis Kendaraan</label>
          <select class="form-control" name="transportation_type" required>
            <option value="" selected disabled>Jenis Kendaraan</option>
            <option value="Kendaraan Ringan" @if ($transport->transportation_type == 'Kendaraan Ringan') selected @endif>Kendaraan Ringan</option>
            <option value="Kendaraan Sedang" @if ($transport->transportation_type == 'Kendaraan Sedang') selected @endif>Kendaraan Sedang</option>
            <option value="Kendaraan Berat" @if ($transport->transportation_type == 'Kendaraan Berat') selected @endif>Kendaraan Berat</option>
          </select>
        </div>
        <div class="form-group mb-3">
          <label>BBM (Liter)</label>
          <input type="number" class="form-control" name="fuel" value="{{ $transport->fuel }}" required>
        </div>
        <div class="form-group" >
          <div class="control-label"></div>
          <label class="custom-switch mt-2">
            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="rentalSwitch">
            <span class="custom-switch-indicator"></span>
            <span class="custom-switch-description">Termasuk kendaraan sewaan</span>
          </label>
        </div>
        <div id="rentalFields" style="display: none;">
          <div class="form-group mb-3">
            <label>Biaya Sewa</label>
            <input type="number" class="form-control" name="cost" id="cost" value="{{ $transport->cost }}" >
          </div>
          <div class="form-group">
            <label>Mulai Sewa</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-calendar"></i>
                </div>
              </div>
              <input type="text" class="form-control datepicker" name="start_date" id="start_date" value="{{ $transport->start_date }}">
            </div>
          </div>
          <div class="form-group">
            <label>Akhir Sewa</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-calendar"></i>
                </div>
              </div>
              <input type="text" class="form-control datepicker" name="end_date" id="end_date" value="{{ $transport->end_date }}">
            </div>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
      </form>
    </div>
  </div>

</section>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const rentalSwitch = document.getElementById('rentalSwitch');
    const rentalFields = document.getElementById('rentalFields');
    const cost = document.getElementById('cost');
    const start_date = document.getElementById('start_date');
    const end_date = document.getElementById('end_date');

    // Atur tampilan awal
    if (cost.value) {
        rentalSwitch.checked = true;
        rentalFields.style.display = 'block';
        cost.required = true;
        start_date.required = true;
        end_date.required = true;
    } else {
        rentalSwitch.checked = false;
        rentalFields.style.display = 'none';
        cost.required = false;
        start_date.required = false;
        end_date.required = false;
    }

    // Atur toggle switch
    rentalSwitch.addEventListener('change', function() {
      if (this.checked) {
        rentalFields.style.display = 'block';
        cost.required = true;
        start_date.required = true;
        end_date.required = true;
      } else {
        rentalFields.style.display = 'none';
        cost.required = false;
        start_date.required = false;
        end_date.required = false;
      }
    });
  });
</script>
@endsection