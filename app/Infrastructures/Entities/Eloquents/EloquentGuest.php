<?php

namespace App\Infrastructures\Entities\Eloquents;

use Illuminate\Database\Eloquent\Model;

use App\Domains\Models\Account\Stylist\Stylist;
use App\Domains\Models\Account\Stylist\Guest;

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
        'user_id', 'email', 'token', 'recommendation'
    ];

    public function recommender(): Stylist
    {
        $stylist = $this->belongsTo('App\Infrastructures\Entities\Eloquents\EloquentUser', 'user_id')->first();
        return $stylist->toDomain();
    }

    public function toDomain(): Guest
    {
        return new Guest(
            $this->recommender(),
            $this->email,
            $this->recommendation
        );
    }
}
