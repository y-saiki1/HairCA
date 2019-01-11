<?php

namespace App\Infrastructures\Entities\Eloquents;

use Illuminate\Database\Eloquent\Model;

class EloquentStylistProfile extends Model
{
    /**
     * @var string
     */
    protected $table = 'stylist_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];
}
