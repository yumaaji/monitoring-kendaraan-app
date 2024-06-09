@extends('layouts.main')

@section('main-content')
<section class="section">
  <div class="section-header">
    <h1>Data Perusahaan</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item"><a href="dashboard/admin">Dashboard</a></div>
      <div class="breadcrumb-item"><a href="/company">Data Perusahaan</a></div>
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
            <button class="btn btn-primary" data-toggle="modal" data-target="#newDataModal">Tambah Perusahaan</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Nama Perusahaan</th>
                    <th>Jenis Perusahaan</th>
                    <th>Alamat Perusahan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($companies as $company)    
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $company->name }}</td>
                      <td>{{ $company->role_company }}</td>
                      <td>{{ $company->address }}</td>
                      <td>
                        <button class="btn btn-primary details-btn" data-toggle="modal" data-target="#showDataModal" data-id="{{ $company->id }}" >Detail</button>
                        <button class="btn btn-warning edit-btn" data-toggle="modal" data-target="#editDataModal" data-id="{{ $company->id }}">Edit</button>
                        <form action="{{ route('company.destroy', $company->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data Perusahaan Ini')">Hapus</button>
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
        <h5 class="modal-title">Data Perusahaan Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('company.store') }}" method="POST">
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
            <label>Jenis</label>
            <select class="form-control" name="role_company" required>
                <option selected disabled value="">Pilih Jenis Perusahaan</option>
                <option value="Perusahaan Pusat">Perusahaan Pusat</option>
                <option value="Perusahaan Cabang">Perusahaan Cabang</option>
                <option value="Perusahaan Kontributor">Perusahaan Kontributor</option>
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
        <h5 class="modal-title">Detail Data Perusahaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" id="modalCompanyName" readonly> 
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" class="form-control" id="modalCompanyAddress" readonly>
        </div>
        <div class="form-group">
          <label>Jenis Perusahaan</label>
          <input type="text" class="form-control" id="modalCompanyRole" readonly>
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
        <h5 class="modal-title">Edit Data Perusahaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editCompanyForm" action="#" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="name" id="editCompanyName" required>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <input type="text" class="form-control" name="address" id="editCompanyAddress" required>
          </div>
          <div class="form-group">
            <label>Jenis</label>
            <select class="form-control" name="role_company" id="editCompanyRole" required>
                <option selected disabled value="">Pilih Jenis Perusahaan</option>
                <option value="Perusahaan Pusat">Perusahaan Pusat</option>
                <option value="Perusahaan Cabang">Perusahaan Cabang</option>
                <option value="Perusahaan Kontributor">Perusahaan Kontributor</option>
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
        var companyId = $(this).data('id');
        
        // Menentukan perusahaan yang ditampilkankan
        $.ajax({
            url: '/company/' + companyId,
            method: 'GET',
            success: function(data) {
                // Populate the modal with the company data
                $('#modalCompanyName').val(data.name);
                $('#modalCompanyRole').val(data.role_company);
                $('#modalCompanyAddress').val(data.address);
            },
            error: function() {
                alert('Failed to fetch company details.');
            }
        });
    });
  });
  
  $(document).ready(function() {
    $('.edit-btn').on('click', function() {
        var companyId = $(this).data('id');

        $('#editCompanyForm').attr('action', '/company/' + companyId);

        $.ajax({
            url: '/company/' + companyId,
            method: 'GET',
            success: function(data) {
                $('#editCompanyName').val(data.name);
                $('#editCompanyAddress').val(data.address);
                $('#editCompanyRole').val(data.role_company);
            },
            error: function() {
                alert('Failed to fetch company details.');
            }
        });
    });
  });
</script>

@endsection