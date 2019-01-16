<?php

namespace App\Infrastructures\Entities\Eloquents;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

use App\Domains\Exceptions\StylistProfileNotExistsException;

use App\Domains\Models\Account\Account;
use App\Domains\Models\Account\Stylist\Stylist;
use App\Domains\Models\Account\Stylist\StylistProfile;

class EloquentUser extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return int
     */
    public function getJWTIdentifier(): int
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * 1対１ スタイリストのプロフィール取得
     * @return StylistProfile
     */
    public function myStylistProfile(): ?StylistProfile
    {
        $stylistProfile = $this
            ->hasOne('App\Infrastructures\Entities\Eloquents\EloquentStylistProfile', 'user_id')
            ->first();

        if (! $stylistProfile) throw new StylistProfileNotExistsException('This Account do not have a profile');

        return $stylistProfile->toDomain();
    }

    /**
     * アカウントインターフェイスを継承したドメインモデルを返却する
     * @return Account Stylist, Member
     */
    public function toDomain(): Account
    {
        if ($this->role_id === Stylist::ACCOUNT_TYPE) {
            $account = new Stylist(
                $this->id,
                $this->name,
                $this->email,
                $this->myStylistProfile()
            );
        }
        
        return $account;
    }
}
