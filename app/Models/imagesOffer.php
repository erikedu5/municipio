<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesOffer extends Model
{
    use HasFactory;
    protected $fillable = [
        'path',
        'main_image',
        'offer_id'
    ];

    protected function getCreatedAtAttribute() {
        return $this->attributes['created_at'];
    }

    protected function getUpdatedAtAttribute() {
        return $this->attributes['updated_at'];
    }

    public function offer()
    {
        return $this->hasOne(Offer::class, 'offer_id');
    }
}
