<?php

namespace App\Infrastructures\Entities\Eloquents;

use Illuminate\Database\Eloquent\Model;

use App\Domains\Models\Account\Stylist\Stylist;
use App\Domains\Models\Account\Stylist\Guest;
use App\Domains\Models\Account\Stylist\Recommender;

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

    public function recommender(): Recommender
    {
        $stylist = $this->belongsTo('App\Infrastructures\Entities\Eloquents\EloquentUser', 'user_id')->first();
        return new Recommender(
            $stylist->id(),
            $stylist->name()
        );
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
