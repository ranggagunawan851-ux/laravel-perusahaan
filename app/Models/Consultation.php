<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $table = 'consultations';

    protected $fillable = [
        'service_id',
        'name',
        'email',
        'phone',
        'message',
        'status',
        'consultation_date',
    ];

    // Otomatis ubah consultation_date menjadi datetime/date
    protected $casts = [
        'consultation_date' => 'date',
    ];


    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
