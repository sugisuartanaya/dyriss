@extends('dashboard.layouts.main')


@section('container')

<div class="container-fluid p-0">
  
  <h1 class="h3 mb-3"><strong>Kelola</strong> Kategori</h1>
  
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
          <h5 class="card-title mb-0">Daftar Kategori</h5>
          <form action="/kategori/store" method="post">
            @csrf
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPegawai">
              <i class="align-middle" data-feather="tag"></i> Tambah Kategori
            </button>
            <div class="modal fade" id="tambahPegawai">
              <div class="modal-dialog">
                <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
      
                  <!-- Modal Body -->
                  <div class="modal-body">
                    <label class="form-label">Tipe Bisnis</label>
                    <select name="business_id" class="form-select mb-3">
                      <option selected>Pilih Tipe Bisnis</option>
                      <option value="1">Dyris</option>
                      <option value="2">Dyah Kitchen</option>
                    </select>
                    <label class="form-label">Nama Kategori</label>
                    <input type="name" name="category_name" class="form-control form-control-lg" placeholder="Masukkan nama kategori" required>
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
                <th style="text-align: left;">Tipe Bisnis</th>
                <th style="text-align: left;">Nama Kategori</th>
                <th style="text-align: left;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $index => $category)
                <tr>
                  <td style="text-align: left;">{{ $index + 1 }}</td>
                  <td style="text-align: left;">
                    @if ($category->business->type == 'dk')
                      Dyah Kitchen
                    @else
                      Dyris
                    @endif
                  </td>
                  <td style="text-align: left;">{{ $category->category_name }}</td>
                  <td class="d-flex">
                    <form action="/kategori/{{ $category->id }}" method="post" >
                      @csrf
                      @method('PUT')
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editkategori{{ $category->id }}">
                        <i class="align-middle" data-feather="edit-2"></i> Ubah</button>
                        <div class="modal fade" id="editkategori{{ $category->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h5 class="modal-title">Edit kategori</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                  
                              <!-- Modal Body -->
                              <div class="modal-body">
                                <label class="form-label">Tipe Bisnis</label>
                                <select name="business_id" class="form-select mb-3">
                                  @foreach ($businesses as $business)
                                    <option value="{{ $business->id }}" {{ $business->id == $category->business_id ? 'selected' : '' }}>
                                      @if ($business->type == 'dk')
                                        Dyah Kitchen
                                      @elseif ($business->type == 'dyris')
                                        Dyris
                                      @endif
                                    </option>
                                  @endforeach
                                </select>
                                <label class="form-label">Nama Kategori</label>
                                <input type="name" name="category_name" class="form-control form-control-lg" value="{{ $category->category_name }}" required>
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
                    <form action="/kategori/{{ $category->id }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletekategori{{ $category->id }}">
                        <i class="align-middle" data-feather="trash-2"></i> Hapus</button>
                        <div class="modal fade" id="deletekategori{{ $category->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h5 class="modal-title">Delete kategori</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                  
                              <!-- Modal Body -->
                              <div class="modal-body">
                                Apakah anda yakin ingin menghapus {{ $category->category_name }}?
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