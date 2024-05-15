<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Download extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'downloadable_id',
        'downloadable_type',
    ];

    public function downloadable(){
        return $this->morphTO();
    }

    protected static function boot() {
        parent::boot();

        static::creating(function($document){
            $document->user_id = Auth::user()->id;
        });
    }

}
