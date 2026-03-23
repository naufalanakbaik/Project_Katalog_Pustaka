<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Buku extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh di–mass assignment
     */
    protected $fillable = [
        'judul',
        'pengarang',
        'tahun_terbit',
        'kategori_id',
        'penerbit_id',
        'deskripsi',
        'cover',
    ];

    /**
     * Relasi ke tabel kategori
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Relasi ke tabel penerbit
     */
    public function penerbit(): BelongsTo
    {
        return $this->belongsTo(Penerbit::class);
    }

    /**
     * Relasi many-to-many ke peminjaman
     */
    public function peminjaman(): BelongsToMany
    {
        return $this->belongsToMany(Peminjaman::class, 'peminjaman_bukus');
    }

    public function difavoritkanOleh()
    {
        return $this->belongsToMany(User::class, 'favorites')
                    ->withTimestamps();
    }
}
