@extends('dashboard.layouts.main')


@section('container')
<div class="container-fluid p-0">
  
  <h1 class="h3 mb-3"><strong>Kelola</strong> Pegawai</h1>
  
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @elseif(session('update'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('update') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  <div class="row">
    <div class="col-md-12 d-flex">
      <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">Daftar Pegawai</h5>
          <form action="/pegawai/store" method="post">
            @csrf
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPegawai">
              <i class="align-middle" data-feather="user-plus"></i> Tambah Pegawai
            </button>
            <div class="modal fade" id="tambahPegawai">
              <div class="modal-dialog">
                <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h5 class="modal-title">Tambah Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
      
                  <!-- Modal Body -->
                  <div class="modal-body">
                    <label class="form-label">Nama Pegawai</label>
                    <input type="name" name="name" class="form-control form-control-lg" placeholder="Masukkan nama pegawai" required>
                    <br>
                    <label class="form-label">Username</label>
                    <input type="username" name="username" class="form-control form-control-lg" placeholder="Masukkan username" required>
                    <br>
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Masukkan password" required>

                    <input type="hidden" name="role" value="0">
                  </div>
      
                  <!-- Modal Footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" name="submit" class="btn btn-success btn-sm">Simpan</button>
                  </div>
                </div>
              </div>
            </div>
          </form>  
        </div>
        <div class="card-body">
          <table id="pegawai" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="text-align: left;">No.</th>
                <th style="text-align: left;">Nama Pegawai</th>
                <th style="text-align: left;">Username</th>
                <th style="text-align: left;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($employee as $index => $pegawai)
                <tr>
                  <td style="text-align: left;">{{ $index + 1 }}</td>
                  <td style="text-align: left;">{{ $pegawai->name }}</td>
                  <td style="text-align: left;">{{ $pegawai->username }}</td>
                  <td class="d-flex">
                    <form action="/pegawai/{{ $pegawai->id }}" method="post" >
                      @csrf
                      @method('PUT')
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editPegawai{{ $pegawai->id }}">
                        <i class="align-middle" data-feather="edit-2"></i> Ubah</button>
                        <div class="modal fade" id="editPegawai{{ $pegawai->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h5 class="modal-title">Edit Pegawai</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                  
                              <!-- Modal Body -->
                              <div class="modal-body">
                                <label class="form-label">Nama Pegawai</label>
                                <input type="name" name="name" class="form-control form-control-lg" value="{{ $pegawai->name }}" required>
                                <br>
                                <label class="form-label">Username</label>
                                <input type="username" name="username" class="form-control form-control-lg" value="{{ $pegawai->username }}" required>
                                <br>
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control form-control-lg" placeholder="Biarkan kosong jika tidak ingin mengubah password">
            
                                <input type="hidden" name="role" value="0">
                              </div>
                  
                              <!-- Modal Footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" name="submit" class="btn btn-success btn-sm">Simpan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </form>

                    &nbsp; 
                    <form action="/pegawai/{{ $pegawai->id }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePegawai{{ $pegawai->id }}">
                        <i class="align-middle" data-feather="trash-2"></i> Hapus</button>
                        <div class="modal fade" id="deletePegawai{{ $pegawai->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h5 class="modal-title">Delete Pegawai</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                  
                              <!-- Modal Body -->
                              <div class="modal-body">
                                Apakah anda yakin ingin menghapus {{ $pegawai->name }}?
                              </div>
                  
                              <!-- Modal Footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" name="submit" class="btn btn-danger btn-sm">Hapus</button>
                              </div>
                            </div>
                          </div>
                        </div>

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
@endsection