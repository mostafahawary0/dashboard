<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permissions extends Model
{
    use HasFactory;
    protected $tabel = "permissions";
    protected $guarded = [];

    public function Section()
    {
        return $this->belongsTo(Section::class);
    }
}
