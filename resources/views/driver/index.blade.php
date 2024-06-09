@extends('layouts.main')

@section('main-content')
<section class="section">
  <div class="section-header">
    <h1>Data Driver</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item"><a href="dashboard/admin">Dashboard</a></div>
      <div class="breadcrumb-item"><a href="/driver">Data Driver</a></div>
    </div>
  </div>
  <div class="section-body">
    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible show fade mt-3 ">
        <div class="alert-body">
          <button class="close" data-dismiss="alert">
            <span>&times;</span>
          </button>
          {{ session('success') }}
        </div>
      </div>
    @endif
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <button class="btn btn-primary" data-toggle="modal" data-target="#newDataModal">Tambah Driver</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Nama Driver</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($drivers as $driver)    
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $driver->name }}</td>
                      <td>{{ $driver->gender }}</td>
                      <td>{{ $driver->address }}</td>
                      <td>
                        <button class="btn btn-primary details-btn" data-toggle="modal" data-target="#showDataModal" data-id="{{ $driver->id }}" >Detail</button>
                        <button class="btn btn-warning edit-btn" data-toggle="modal" data-target="#editDataModal" data-id="{{ $driver->id }}">Edit</button>
                        <form action="{{ route('driver.destroy', $driver->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data Driver Ini')">Hapus</button>
                      </form>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Modal create new data --}}
<div class="modal fade" tabindex="-1" role="dialog" id="newDataModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Data Driver Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('driver.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="name" required>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <input type="text" class="form-control" name="address" required>
          </div>
          <div class="form-group">
            <label>Jenis Kelamin</label>
            <select class="form-control" name="gender" required>
                <option selected disabled value="">Pilih Salah Satu</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Modal show data --}}
<div class="modal fade" tabindex="-1" role="dialog" id="showDataModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Data Driver</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" id="modalDriverName" readonly> 
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" class="form-control" id="modalDriverAddress" readonly>
        </div>
        <div class="form-group">
          <label>Jenis Kelamin</label>
          <input type="text" class="form-control" id="modalDriverGender" readonly>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Modal edit data --}}
<div class="modal fade" tabindex="-1" role="dialog" id="editDataModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Driver</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editDriverForm" action="#" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="name" id="editDriverName" required>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <input type="text" class="form-control" name="address" id="editDriverAddress" required>
          </div>
          <div class="form-group">
            <label>Jenis Kelamin</label>
            <select class="form-control" name="gender" id="editDriveGender" required>
                <option selected disabled value="">Pilih Salah Satu</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



  {{-- JQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.details-btn').on('click', function() {
        var driverId = $(this).data('id');
        
        // Menentukan driver yang ditampilkan
        $.ajax({
            url: '/driver/' + driverId,
            method: 'GET',
            success: function(data) {
                $('#modalDriverName').val(data.name);
                $('#modalDriverAddress').val(data.address);
                $('#modalDriverGender').val(data.gender);
            },
            error: function() {
                alert('Failed to fetch company details.');
            }
        });
    });
  });
  
  $(document).ready(function() {
    $('.edit-btn').on('click', function() {
        var driverId = $(this).data('id');
  
        $('#editDriverForm').attr('action', '/driver/' + driverId);
  
        $.ajax({
            url: '/driver/' + driverId,
            method: 'GET',
            success: function(data) {
                // Populate the modal with the company data
                $('#editDriverName').val(data.name);
                $('#editDriverAddress').val(data.address);
                $('#editDriveGender').val(data.gender);
            },
            error: function() {
                alert('Failed to fetch company details.');
            }
        });
    });
  });
</script>

@endsection