<?php

namespace App\Infrastructures\Entities\Eloquents;

use Illuminate\Database\Eloquent\Model;

class EloquentGuest extends Model
{
    /**
     * @var string
     */
    protected $table = 'guests';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'email', 'token', 'introduction'
    ];

    public function toDomain():Guest
    {
        return new Guest(
            
        );
    }
}
