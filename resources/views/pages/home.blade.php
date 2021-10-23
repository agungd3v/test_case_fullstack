@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    @foreach ($products as $product)
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card border-0">
          <img src="{{ asset($product->gambar) }}" class="card-img-top img-custom">
          <div class="card-body">
            <h5 class="card-title title-custom">{{ $product->nama_produk }}</h5>
            <p class="card-text desc-custom">{{ strip_tags($product->deskripsi_produk) }}</p>
            <div class="text-center">
              <a href="#" class="btn btn-primary">Buy</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection