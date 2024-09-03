@extends('layouts.app')
@section('title','Kategori')
@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            @if(session('success'))
                  <div class="alert alert-success  bg-success text-light border-0 alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif
            <h5 class="card-title">Data Kategori</h5>
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                    Tambah Kategori
                  </button>
                  <div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Form Tambahkan Kategori</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                       <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="col-12">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" class="form-control" name="name" id="kategori" placeholder="masukan kategori baru" >
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                          </div>
                       </form>
                      </div>
                    </div>
                  </div>
            </div>
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th>
                    <b>N</b>o
                  </th>
                  <th>Nama</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ( $categories  as $item )
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#disablebackdrop{{ $item->id }}"><i class="bi bi-pencil"></i></button>
                        <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                    </td>
                  </tr>
                  {{-- edit modal --}}
                  <div class="modal fade" id="disablebackdrop{{ $item->id }}" tabindex="-1" data-bs-backdrop="false">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Form Update Kategori</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                       <form action="{{ route('kategori.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="col-12">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" class="form-control" name="name" id="kategori" value="{{ $item->name }}" >
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                          </div>
                       </form>
                      </div>
                    </div>
                  </div>
                  {{-- end edit modal --}}
                  @empty
                  <tr>
                    <td class="text-center text-danger" colspan="3">Data Katgeori Kosong</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
