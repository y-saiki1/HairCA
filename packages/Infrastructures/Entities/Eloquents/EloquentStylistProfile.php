<?php

namespace Packages\Infrastructures\Entities\Eloquents;

use Illuminate\Database\Eloquent\Model;

use Packages\Domain\Models\Account\Age;
use Packages\Domain\Models\Account\Sex;
use Packages\Domain\Models\Profile\StylistProfile;
use Packages\Domain\Models\Account\Stylist\Recommender;

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
    //     $stylist = $this->belongsTo('Packages\Infrastructures\Entities\Eloquents\EloquentAccounts\EloquentStylist', 'recommender_id')->first();
        
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
