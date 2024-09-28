<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $tabel = "sections";
    protected $guarded = [];

    public function permissions()
    {
        return $this->hasMany(permissions::class, 'section_id');
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }
}
