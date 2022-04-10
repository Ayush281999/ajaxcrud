<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategories extends Model
{
    use HasFactory;
    protected $table = 'subcategories';
    protected $fillable = ['cat_id'];

    public function catname()
    {
        return $this->hasOne(Categories::class,'id','cat_id');
    }
}
