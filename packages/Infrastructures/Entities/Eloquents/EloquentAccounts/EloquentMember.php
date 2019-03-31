<?php

namespace Packages\Infrastructures\Entities\Eloquents\EloquentAccounts;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Packages\Domain\Models\Account\Member\Member;

class EloquentMember extends Model
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

        static::addGlobalScope('users', function(Builder $builder) {
            // ログインしてるユーザーのみ
           $builder->where('role_id', Member::ACCOUNT_TYPE);
        });
    }

    /**
     * アカウントインターフェイスを継承したドメインモデルを返却する
     * @return Account Stylist, Member
     */
    public function toDomain(): Member
    {   
        return new Member(
            $this->id,
            $this->name,
            $this->email
        );
    }
}