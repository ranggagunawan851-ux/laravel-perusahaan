<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'nama_service',
        'slug',
        'img',
        'desc',
        'price',
        'publish_date',
    ];

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relasi ke Consultation
    public function consultations()
    {
        return $this->hasMany(Consultation::class, 'service_id');
    }
}
