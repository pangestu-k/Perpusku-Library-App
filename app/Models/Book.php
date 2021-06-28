<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'pengarang', 'tahun_terbit', 'jenis_buku', 'stok', 'deskripsi', 'photo',
    ];

    public function borrow(){
        return $this->hasOne(Borrow::class);
    }

    Const JENIS = [
        'fiksi' => 'fiksi',
        'non-fiksi' => 'non-fiksi',
        'pembelajaran' => 'pembelajaran',
        'self-improvement' => 'self-improvement',
    ];
}
