<?php

namespace App\Infrastructures\Entities\Eloquents\EloquentAccounts;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use App\Domains\Exceptions\StylistProfileNotExistsException;
use App\Domains\Models\Account\Stylist\Stylist;
use App\Domains\Models\Profile\StylistProfile;

class EloquentStylist extends Model
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

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('my_posts', function(Builder $builder) {
            // ログインしてるユーザーのみ
           $builder->where('role_id', Stylist::ACCOUNT_TYPE);
        });
    }

    /**
     * 1対１ スタイリストのプロフィール取得
     * @return StylistProfile
     * @throws StylistProfileNotExistsException
     */
    public function myStylistProfile(): StylistProfile
    {
        $stylistProfile = $this
            ->hasOne('App\Infrastructures\Entities\Eloquents\EloquentStylistProfile', 'user_id')
            ->first();

        if (! $stylistProfile) {
            throw new StylistProfileNotExistsException(
                'Please create Stylist Profile this Account',
                StylistProfileNotExistsException::ERROR_CODE
            );
        }

        return $stylistProfile->toDomain();
    }
 
    /**
     * アカウントインターフェイスを継承したドメインモデルを返却する
     * @return Account Stylist, Member
     */
    public function toDomain(): Stylist
    {       
        return new Stylist(
            $this->id,
            $this->name,
            $this->email
        );
    }
}