<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoviesUrl extends Model
{
    use HasFactory;

    protected $table='moviesurl';
    protected $fillable=[
        'url','filesize','moive_id'];

        public function movies(){
            return $this->belongsTo(Movies::class,'movie_id');
        }
}
