<?php

namespace Packages\Infrastructures\Entities\Eloquents;

use Illuminate\Database\Eloquent\Model;

use Packages\Domain\Models\Account\Stylist\Stylist;
use Packages\Domain\Models\Account\Guest\Guest;
use Packages\Domain\Models\Account\Stylist\Recommender;

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

    public function recommender(string $recommendation): Recommender
    {
        $stylist = $this->belongsTo('Packages\Infrastructures\Entities\Eloquents\EloquentAccounts\EloquentStylist', 'user_id')->first();
        return new Recommender(
            $stylist->id,
            $stylist->name,
            $recommendation
        );
    }

    public function toDomain(): Guest
    {
        return new Guest(
            $this->recommender($this->recommendation),
            $this->email
        );
    }
}
