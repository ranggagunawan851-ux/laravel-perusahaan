<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Consultation extends Model
{
    use HasFactory;

    protected $table = 'consultations';

    protected $fillable = [
        'code',
        'service_id',
        'name',
        'email',
        'phone',
        'message',
        'status',
        'image', // Pastikan ini ada
        'note',  // Pastikan ini ada
    ];

    // Otomatis ubah consultation_date menjadi datetime/date
    protected $casts = [
        'consultation_date' => 'date',
    ];

    /**
     * Booted method untuk menangani model events.
     */
    protected static function booted(): void
    {
        static::creating(function ($consultation) {
            // Jika kode belum diisi, generate kode unik acak (Contoh: CNS-8X9A2B1C)
            if (empty($consultation->code)) {
                $consultation->code = 'CNS-' . strtoupper(Str::random(8));
            }
        });
    }


    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
