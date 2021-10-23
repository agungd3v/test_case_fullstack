<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
  protected $table = 'produks';

  public function kategori() {
    return $this->belongsToMany(Kategori::class, 'produk_kategori', 'produk_id', 'kategori_id')->withTimestamps();
  }
}
