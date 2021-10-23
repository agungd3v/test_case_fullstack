<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Kategori;
use App\Produk;

class ProductController extends Controller
{
  public function index() {
    $kategoris = Kategori::orderBy('nama_kategori', 'asc')->get();
    $produks = Produk::orderBy('nama_produk')->paginate(8);
    return view('admin.product.index', compact('kategoris', 'produks'));
  }

  public function store(Request $request) {
    $request->validate([
      'nama_produk' => 'required|unique:produks,nama_produk',
      'deskripsi_produk' => 'required',
      'harga_produk' => 'required',
      'kategori' => 'required',
      'gambar' => 'required|file|mimes:jpeg,jpg,png|max:1024'
    ]);
    try {
      $produk = new Produk();

      $path = $request->file('gambar')->store('public/produk');
      $sendPath = explode('/', $path);
      
      $produk->nama_produk = $request->nama_produk;
      $produk->deskripsi_produk = $request->deskripsi_produk;
      $produk->harga_produk = $request->harga_produk;
      $produk->gambar = 'storage/'. $sendPath[1] .'/'. $sendPath[2];
      $produk->save();
      $produk->kategori()->attach($request->kategori);

      return redirect()->route('admin.product')->with('berhasil', 'Berhasil menambahkan produk baru');
    } catch (\Exception $e) {
      return redirect()->route('admin.product')->with('gagal', $e);
    }
  }
}
