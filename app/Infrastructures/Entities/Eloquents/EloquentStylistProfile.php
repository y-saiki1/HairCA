<?php

namespace App\Infrastructures\Entities\Eloquents;

use Illuminate\Database\Eloquent\Model;

use App\Domains\Models\Account\Age;
use App\Domains\Models\Account\Sex;
use App\Domains\Models\Account\Stylist\StylistProfile;
use App\Domains\Models\Account\Stylist\Recommender;

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

    // public function recommender(): Recommender
    // {
    //     $stylist = $this->belongsTo('App\Infrastructures\Entities\Eloquents\EloquentAccounts\EloquentStylist', 'recommender_id')->first();
        
    //     return new Recommender(
    //         $stylist->id(),
    //         $stylist->name()
    //     );
    // }

    // public function toDomain()
    // {
    //     return new StylistProfile(
    //         $this->recommender(),
    //         $this->recommendation,
    //         $this->introduction ? $this->introduction : null,
    //         $this->birth_date ? new \DateTime($this->birth_date) : null,
    //         $this->sex ? $this->sex : null
    //     );
    // }
}
