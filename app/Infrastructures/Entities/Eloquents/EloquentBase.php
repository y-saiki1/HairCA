<?php

namespace App\Infrastructures\Entities\Eloquents;

use Illuminate\Database\Eloquent\Model;

class EloquentBase extends Model
{
    /**
     * @var string
     */
    protected $table = 'bases';
    protected $fillable = ['name'];
}
