@extends('layouts.main')

@section('main-content')
<section class="section">
  <div class="section-header">
    <h1>Data Pengajuan Kendaraan</h1>
    <div class="section-header-breadcrumb">
      @if (auth()->user()->role == 'admin')
        <div class="breadcrumb-item"><a href="dashboard/admin">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="/pengajuan">Data Pengajuan Kendaraan</a></div>
      @endif
      @if (auth()->user()->role == 'penjabat')
        <div class="breadcrumb-item"><a href="dashboard/penjabat">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="/pengajuan-kendaraan">Data Pengajuan Kendaraan</a></div> 
      @endif
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
            @if(auth()->user()->role == 'admin') 
              <a href="{{ route('pengajuan.create') }}" class="btn btn-primary">Tambah Pengajuan</a>
            @endif
            <a href="/pengajuan-export" class="btn btn-success ml-2">Export Excel</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table-1">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>Nama Kendaran</th>
                    <th>Tipe Kendaraan</th>
                    <th>Jenis Kendaraan</th>
                    <th>Tujuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($lendings as $lending)    
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $lending->transport->name }}</td>
                      <td>{{ $lending->transport->product_type }}</td>
                      <td>{{ $lending->transport->transportation_type }}</td>
                      <td>{{ $lending->purpose }}</td>
                      <td>
                        @if ($lending->status == 1) 
                          <div class="badge badge-warning">Waiting</div> 
                        @elseif ($lending->status == 2) 
                          <div class="badge badge-success">Disetujui</div>
                        @elseif ($lending->status == 3) 
                          <div class="badge badge-danger">Ditolak</div>
                        @endif
                      </td>
                      <td class="text-center">
                        {{-- Tombol aksi data pada dashboard admin --}}
                        @if (auth()->user()->role == 'admin') 
                          {{-- Jika status = 1 (waiting) --}}
                          @if ($lending->status == 1)    
                            <button class="btn btn-primary details-btn" data-toggle="modal" data-target="#showDataModal" data-id="{{ $lending->id }}" >Detail</button>
                            <a href="{{ route('pengajuan.edit', $lending->id) }}"><button class="btn btn-warning">Edit</button></a>
                            <form action="{{ route('pengajuan.destroy', $lending->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data Pengajuan Ini')">Hapus</button>
                            </form>
                          @elseif ($lending->status == 2)
                            {{-- Jika status = 2 (disetujui) --}}
                            <button class="btn btn-primary details-btn" data-toggle="modal" data-target="#showDataModal" data-id="{{ $lending->id }}" >Detail</button>
                          @elseif ($lending->status == 3)
                            {{-- Jika status = 3 (ditolak) --}}
                            <button class="btn btn-primary details-btn" data-toggle="modal" data-target="#showDataModal" data-id="{{ $lending->id }}" >Detail</button>
                          @endif
                      
                        {{-- Tombol aksi data pada dashboard penjabat --}}
                        @elseif (auth()->user()->role == 'penjabat')
                          {{-- Jika status = 1 (waiting) --}}
                          @if ($lending->status == 1)    
                            <button class="btn btn-primary details-btn" data-toggle="modal" data-target="#showDataModal" data-id="{{ $lending->id }}">Detail</button>
                            <form action="{{ route('pengajuan-approve', $lending->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('PUT')
                              <input type="hidden" name="status" value="2">
                              <button type="submit" class="btn btn-success" onclick="return confirm('Yakin Ingin Menyetujui Pengajuan Ini?')">Setujui</button>
                            </form>
                            <form action="{{ route('pengajuan-unapprove', $lending->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('PUT')
                              <input type="hidden" name="status" value="2">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menolak Pengajuan Ini?')">Tolak</button>
                            </form>  
                          {{-- Jika status = 2 (disetujui) --}}
                          @elseif ($lending->status == 2)
                            <button class="btn btn-primary details-btn" data-toggle="modal" data-target="#showDataModal" data-id="{{ $lending->id }}" >Detail</button>
                            <form action="{{ route('pengajuan-unapprove', $lending->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('PUT')
                              <input type="hidden" name="status" value="2">
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menolak Pengajuan Ini?')">Tolak</button>
                            </form>
                            <form action="{{ route('pengajuan-waiting', $lending->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('PUT')
                              <input type="hidden" name="status" value="2">
                              <button type="submit" class="btn btn-warning" onclick="return confirm('Yakin Ingin Menghapus Persetujuan Ini?')">Batal</button>
                            </form>
                          {{-- Jika status = 3 (ditolak)--}}
                          @elseif ($lending->status == 3)
                            <button class="btn btn-primary details-btn" data-toggle="modal" data-target="#showDataModal" data-id="{{ $lending->id }}" >Detail</button>
                            <form action="{{ route('pengajuan-approve', $lending->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('PUT')
                              <input type="hidden" name="status" value="2">
                              <button type="submit" class="btn btn-success" onclick="return confirm('Yakin Ingin Menyetujui Pengajuan Ini?')">Setujui</button>
                            </form>
                            <form action="{{ route('pengajuan-waiting', $lending->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('PUT')
                              <input type="hidden" name="status" value="2">
                              <button type="submit" class="btn btn-warning" onclick="return confirm('Yakin Ingin Menghapus Penolakan Ini?')">Batal</button>
                            </form>
                          @endif
                        @endif
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

{{-- Modal show data --}}
<div class="modal fade" tabindex="-1" role="dialog" id="showDataModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Pengajuan Kendaraan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group mb-3">
          <label>Nama Kendaraan: </label>
          <label id="modalKendaraanName"></label>
        </div>
        <div class="form-group mb-3">
          <label>Tipe Kendaraan: </label>
          <label id="modalKendaraanType"></label>
        </div>
        <div class="form-group mb-3">
          <label>Jenis Kendaraan: </label>
          <label id="modalKendaraanJenis"></label>
        </div>
        <div class="form-group mb-3">
          <label>Tujuan: </label>
          <label id="modalKendaraanPurpose"></label>
        </div>
        <div class="form-group mb-3">
          <label>Driver: </label>
          <label id="modalKendaraanDriver"></label>
        </div>
        <div class="form-group mb-3">
          <label>Tanggal Dimulai: </label>
          <label id="modalKendaraanStartDate"></label>
        </div>
        <div class="form-group mb-3">
          <label>Tanggal Selesai: </label>
          <label id="modalKendaraanEndDate"></label>
        </div>
        <div class="form-group mb-3">
          <label>Penanggung Jawab: </label>
          <label id="modalKendaraanSupervisor"></label>
        </div>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

{{-- JQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.details-btn').on('click', function() {
        var lendingId = $(this).data('id');
        
        // Menentukan kendaraan yang ditampilkan
        $.ajax({
          url: '/pengajuan/' + lendingId,
          method: 'GET',
          success: function(data) {
                $('#modalKendaraanName').text(data.transport.name);
                $('#modalKendaraanType').text(data.transport.product_type);
                $('#modalKendaraanJenis').text(data.transport.transportation_type);
                $('#modalKendaraanDriver').text(data.driver.name);
                $('#modalKendaraanPurpose').text(data.purpose);
                $('#modalKendaraanStartDate').text(data.start_date);
                $('#modalKendaraanEndDate').text(data.end_date);
                $('#modalKendaraanSupervisor').text(data.supervisor.name);

                console.log(data);
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