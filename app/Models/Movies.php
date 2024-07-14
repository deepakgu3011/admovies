<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;

    protected $table='movies/series';
    protected $fillable = [
        'name', 'dirname', 'rdate', 'pic', 'desc','url','user_id','category','status'
    ];

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function movieurl(){
        return $this->hasMany(MoviesUrl::class);
    }
}
