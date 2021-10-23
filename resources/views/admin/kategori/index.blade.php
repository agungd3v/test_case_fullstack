@extends('layouts.dashboard')
@section('title', 'Kategori')
@section('kategori_link', 'active')
@section('collapse', 'show')

@section('content')
<div class="row">
  <div class="col-md-8 col-sm-12">
    <div class="card">
      <div class="card-body">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new_kategori">Kategori baru</button>
        <div class="table-responsive mt-3">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama kategori</th>
                <th scope="col">Keterangan</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($kategoris as $kategori)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $kategori->nama_kategori }}</td>
                  <td>{{ $kategori->keterangan ? $kategori->keterangan : '-' }}</td>
                  <td>
                    <button class="btn btn-sm btn-success" onclick="editKategori({{$kategori}})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteKategori({{$kategori}})">Delete</button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4">
                    <p class="text-center mb-0">Data kosong</p>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="new_kategori" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control">
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control" id="keterangan" cols="30" rows="4"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="edit_kategori" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.kategori.update') }}" method="POST">
        @csrf
        <input type="hidden" name="edit_id" id="edit_id">
        <div class="modal-body">
          <div class="form-group">
            <label for="edit_nama_kategori">Nama Kategori</label>
            <input type="text" name="edit_nama_kategori" id="edit_nama_kategori" class="form-control">
          </div>
          <div class="form-group">
            <label for="edit_keterangan">Keterangan</label>
            <textarea name="edit_keterangan" class="form-control" id="edit_keterangan" cols="30" rows="4"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="delete_kategori" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetAction()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.kategori.delete') }}" data-origin="{{ route('admin.kategori.delete') }}" method="POST" id="form_delete">
        @csrf
        <div class="modal-body">
          Yakin ingin menghapus kategori <span id="name_delete_kategori"></span>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('js')
<script>
  function editKategori(data) {
    $('#edit_id').val(data.id)
    $('#edit_nama_kategori').val(data.nama_kategori)
    $('#edit_keterangan').val(data.keterangan)
    $('#edit_kategori').modal('show')
  }
  function deleteKategori(data) {
    const formDelete = $('form#form_delete').attr('action')
    $('form#form_delete').attr('action', formDelete + '/' + data.id)
    $('#delete_kategori').modal('show')
  }
  function resetAction() {
    const origin = $('form#form_delete').data('origin')
    $('form#form_delete').attr('action', origin)
  }
</script>
@endpush