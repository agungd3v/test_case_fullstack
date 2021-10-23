<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
  public function index() {
    $kategoris = Kategori::orderBy('nama_kategori')->get();
    return view('admin.kategori.index', compact('kategoris'));
  }

  public function store(Request $request) {
    try {
      $request->validate([
        'nama_kategori' => 'required'
      ]);
      $kategori = new Kategori();
      if ($request->keterangan) $kategori->keterangan = $request->keterangan;
      $kategori->nama_kategori = $request->nama_kategori;
      $kategori->save();

      return redirect()->route('admin.kategori')->with('berhasil', 'Berhasil menambah kategori');
    } catch (\Exception $e) {
      return redirect()->route('admin.kategori')->with('gagal', $e);
    }
  }

  public function update(Request $request) {
    try {
      $request->validate([
        'edit_id' => 'required|numeric',
        'edit_nama_kategori' => 'required'
      ]);
      $kategori = Kategori::find($request->edit_id);
      if (!$kategori) return redirect()->route('admin.kategori')->with('gagal', 'Kategori tidak ditemukan');
      if ($request->edit_keterangan) $kategori->keterangan = $request->edit_keterangan;
      $kategori->nama_kategori = $request->edit_nama_kategori;
      $kategori->save();

      return redirect()->route('admin.kategori')->with('berhasil', 'Berhasil mengubah kategori');
    } catch (\Exception $e) {
      return redirect()->route('admin.kategori')->with('error', $e);
    }
  }

  public function delete($id) {
    try {
      $kategori = Kategori::find($id);
      if (!$kategori) return redirect()->route('admin.kategori')->with('gagal', 'Kategori tidak ditemukan');
      $kategori->delete();

      return redirect()->route('admin.kategori')->with('berhasil', 'Berhasil menghapus kategori');
    } catch (\Exception $e) {
      return redirect()->route('admin.kategori')->with('error', $e);
    }
  }
}
