<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SivrPageElement extends Model
{
    use HasFactory;

    public function sivrPage(){
        return $this->belongsTo(SivrPage::class,'page_id');
    }
}
