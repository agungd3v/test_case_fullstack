<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
  protected $table = 'kategoris';

  public function kategori() {
    return $this->belongsToMany(Produk::class, 'produk_kategori', 'kategori_id', 'produk_id')->withTimestamps();
  }
}
