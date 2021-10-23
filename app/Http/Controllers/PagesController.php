<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;

class PagesController extends Controller
{
  public function home() {
    $products = Produk::orderBy('nama_produk', 'asc')->get();
    return view('pages.home', compact('products'));
  }
}
