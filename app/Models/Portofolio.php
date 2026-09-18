<?php

namespace App\Models;

use App\Models\PortofolioImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Portofolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'client',
        'img',
        'desc',
        'status',
        'publish_date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function images()
{
    return $this->hasMany(PortofolioImage::class);
}

}
