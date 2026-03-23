<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Journal extends Model
{
    use HasFactory;

    /**
     * Field yang BOLEH diisi mass assignment
     * (wajib sesuai migration)
     */
    protected $fillable = [
        'judul',
        'pengarang',
        'abstrak',
        'tahun_terbit',
        'file_path',
        'user_id',
        'status',
        'downloads',
        'approved_by',
        'approved_at',
        'rejection_note',
    ];
    

    /* =========================
        RELATIONS
    ========================= */
    /**
     * Publisher (yang upload jurnal)
     */
    public function publisher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    /**
     * Admin yang menyetujui jurnal
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /* =========================
        HELPER (OPSIONAL tapi BERGUNA)
    ========================= */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }
}
