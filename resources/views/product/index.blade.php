@extends('dashboard.layouts.main')


@section('container')

<div class="container-fluid p-0">
  
  <h1 class="h3 mb-3"><strong>Kelola</strong> Produk</h1>
  
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
          <h5 class="card-title mb-0">Daftar Produk</h5>
          <form action="/produk/store" method="post">
            @csrf
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahProduk">
              <i class="align-middle" data-feather="plus"></i> Tambah Produk
            </button>
            <div class="modal fade" id="tambahProduk">
              <div class="modal-dialog">
                <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h5 class="modal-title">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
      
                  <!-- Modal Body -->
                  <div class="modal-body">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-select mb-3">
                      <option selected>Pilih Kategori</option>
                      @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                          {{ $category->category_name }}
                        </option>
                      @endforeach
                    </select>
                    <div class="mb-3">
                      <label class="form-label">Nama Produk</label>
                      <input type="name" name="product_name" class="form-control form-control-lg" placeholder="Masukkan nama produk" required>
                    </div>
                    <div class="mb-3">
                      <label for="basic-url" class="form-label">Harga</label>
                      <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Rp</span>
                        <input id="harga" type="text" name="price" class="form-control form-control-lg" placeholder="Masukkan harga produk" required>
                      </div>
                    </div>
                    <label class="form-label">Stok</label>
                    <input type="number" name="qty" class="form-control form-control-lg" placeholder="Masukkan jumlah stok produk" required>
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
          <table id="dataTable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="text-align: left;">No.</th>
                <th style="text-align: left;">Kategori</th>
                <th style="text-align: left;">Nama Produk</th> 
                <th style="text-align: left;">Harga</th> 
                <th style="text-align: left;">Stok</th>
                <th style="text-align: left;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $index => $product)
                <tr>
                  <td style="text-align: left;">{{ $index + 1 }}</td>
                  <td style="text-align: left;">{{ $product->category->category_name }}</td>
                  <td style="text-align: left;">{{ $product->product_name }}</td>
                  <td style="text-align: left;">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                  <td style="text-align: left;">{{ $product->qty }}</td>
                  <td class="d-flex">
                    <form action="/produk/{{ $product->id }}" method="post" >
                      @csrf
                      @method('PUT')
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editProduk{{ $product->id }}">
                        <i class="align-middle" data-feather="edit-2"></i> Ubah</button>
                        <div class="modal fade" id="editProduk{{ $product->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h5 class="modal-title">Edit Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                  
                              <!-- Modal Body -->
                              <div class="modal-body">
                                <label class="form-label">Kategori</label>
                                <select name="category_id" class="form-select mb-3">
                                  @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                      {{ $category->category_name }}
                                    </option>
                                  @endforeach
                                </select>
                                <div class="mb-3">
                                  <label class="form-label">Nama Produk</label>
                                  <input type="name" name="product_name" class="form-control form-control-lg" value="{{ $product->product_name }}" required>
                                </div>
                                <div class="mb-3">
                                  <label for="basic-url" class="form-label">Harga</label>
                                  <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                    <input id="harga" type="text" name="price" class="form-control form-control-lg" value="{{ number_format($product->price, 0, ',', '.') }}" required>
                                  </div>
                                </div>
                                <label class="form-label">Stok</label>
                                <input type="number" name="qty" class="form-control form-control-lg" value="{{ $product->qty }}" required>
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
                    <form action="/produk/{{ $product->id }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteproduk{{ $product->id }}">
                        <i class="align-middle" data-feather="trash-2"></i> Hapus</button>
                        <div class="modal fade" id="deleteproduk{{ $product->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h5 class="modal-title">Delete produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                  
                              <!-- Modal Body -->
                              <div class="modal-body">
                                Apakah anda yakin ingin menghapus {{ $product->product_name }}?
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