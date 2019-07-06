<?php

namespace App\Model;

use App\Notifications\ResetPassword as ResetPasswordNotification;
use App\Notifications\SendVerificationEmail;
use App\Notifications\SendOrderCreatedEmail;
use App\Notifications\PaidVerifiedEmail;
use App\Notifications\ProductHasBeenDeliveryEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements CanResetPasswordContract
{
    use CanResetPasswordTrait;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role', 'email', 'password', 'email_verified_at'
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
     * One to One relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customer(){
        return $this->hasOne(Customer::class, 'user_id');
    }
    
    /**
     * One to One relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seller(){
        return $this->hasOne(Seller::class, 'user_id');
    }

    public function verifyUser()
    {
        return $this->hasOne(VerifyUser::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendVerificationEmail($user, $token)
    {
        $this->notify(new SendVerificationEmail($user, $token));
    }
    
    
    /**
     * Send the email notification bills.
     *
     * @param  string  $token
     * @return void
     */
    public function SendOrderCreatedEmail($user, $order)
    {
        $this->notify(new SendOrderCreatedEmail($user, $order));
    }
    
    /**
     * Send the email notification paid has been verified.
     *
     * @param  string  $token
     * @return void
     */
    public function paidVerifiedEmail($user, $order)
    {
        $this->notify(new PaidVerifiedEmail($user, $order));
    }
    
    /**
     * Send the email notification paid has been verified.
     *
     * @param  string  $token
     * @return void
     */
    public function productHasBeenDeliveryEmail($user, $order)
    {
        $this->notify(new ProductHasBeenDeliveryEmail($user, $order));
    }
}
