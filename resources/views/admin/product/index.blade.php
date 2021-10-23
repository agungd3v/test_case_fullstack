@extends('layouts.dashboard')
@section('title', 'Product')
@section('product_link', 'active')
@section('collapse', 'show')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new_produk">Produk baru</button>
        <div class="table-responsive mt-3">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama produk</th>
                <th scope="col">Deskripsi produk</th>
                <th scope="col">Harga produk</th>
                <th scope="col">Kategori produk</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($produks as $produk)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $produk->nama_produk }}</td>
                  <td class="data-desc">{{ $produk->deskripsi_produk ? strip_tags($produk->deskripsi_produk) : '-' }}</td>
                  <td>Rp. {{ number_format($produk->harga_produk, 2, ',', '.') }}</td>
                  <td>
                    @foreach ($produk->kategori as $kategori)
                      <span class="badge badge-warning">{{ $kategori->nama_kategori }}</span>
                    @endforeach
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6">
                    <p class="text-center mb-0">Data kosong</p>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
          <div class="float-right">
            {{ $produks->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="new_produk" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.produck.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="nama_produk">Nama produk</label>
            <input type="text" name="nama_produk" id="nama_produk" class="form-control">
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi produk</label>
            <textarea id="deskripsi" name="deskripsi_produk"></textarea>
          </div>
          <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga_produk" class="form-control" id="harga">
          </div>
          <div class="form-group">
            <label for="kategori">Kategori produk</label>
            <select name="kategori[]" multiple="multiple" class="form-control" style="width: 100%" id="kategori">
              @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="gambar">Upload image</label>
            <input type="file" name="gambar" class="w-100">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/mycss.css') }}">
<style>
  p {
    margin-bottom: 0 !important;
  }
  .ck-editor__editable_inline {
    min-height: 180px;
  }
</style>
@endpush

@push('js')
<script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>
<script>
  function matchCustom(params, data) {
    if ($.trim(params.term) === '') {
      return data;
    }
    if (typeof data.text === 'undefined') {
      return null;
    }
    if (data.text.indexOf(params.term) > -1) {
      var modifiedData = $.extend({}, data, true);
      modifiedData.text += ' (matched)';
      return modifiedData;
    }
    return null;
  }
  $(document).ready(function() {
    ClassicEditor.create(document.querySelector('#deskripsi'))
    .catch(error => {
      console.error(error)
    })
    $("#kategori").select2({
      matcher: matchCustom,
      placeholder: "Pilih kategori"
    })
  })
</script>
@endpush