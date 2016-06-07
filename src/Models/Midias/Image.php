<?php

namespace BW\Models\Midias;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table = 'midias_imagens';
    protected $fillable = ['name', 'status'];

}
