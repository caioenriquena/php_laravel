<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;


    protected $table = 'uploads';


    protected $fillable = [
        'file_name',
        'user_id',
        'uploaded_at',
    ];


    public $timestamps = true;


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
