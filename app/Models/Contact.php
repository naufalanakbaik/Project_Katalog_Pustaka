<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Contact extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'pesan',
        'is_read',
        'reply',
        'replied_at',
        'replied_by',
        'status',
    ];

    /**
     * Casting kolom tanggal ke Carbon
     */
    protected $casts = [
        'replied_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * User pengirim pesan
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Admin pembalas pesan
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'replied_by');
    }
}
