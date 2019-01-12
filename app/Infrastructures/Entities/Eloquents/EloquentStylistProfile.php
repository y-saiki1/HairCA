<?php

namespace App\Infrastructures\Entities\Eloquents;

use Illuminate\Database\Eloquent\Model;

use App\Domains\Models\Account\Stylist\StylistProfile;

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

    public function toDomain()
    {
        $homeAddress = $this->hair_salon_prefecture . $this->hair_salon_municipality . $this->hair_salon_street_number;
        if ($this->hair_salon_building_name) $homeAddress .= $this->hair_salon_building_name;

        return new StylistProfile(
            $this->introduction,
            $this->recommendation,
            $this->age,
            $this->sex,
            $this->hair_salon_name,
            $this->hair_salon_postal_code,
            $homeAddress
        );
    }
}
