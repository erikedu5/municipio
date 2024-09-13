<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesPublication extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'main_image',
        'publication_id'
    ];

    protected function getCreatedAtAttribute() {
        return $this->attributes['created_at'];
    }

    protected function getUpdatedAtAttribute() {
        return $this->attributes['updated_at'];
    }

    public function publication()
    {
        return $this->hasOne(Publication::class, 'publication_id');
    }
}
