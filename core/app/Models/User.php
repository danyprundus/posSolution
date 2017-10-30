<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends BaseModel implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    /**
     * Main table primary key
     * @var string
     */
    protected $primaryKey = 'uuid';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['username','name','email','password','phone','photo','role_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function hasRole($role){
		if(is_string($role) && $this->role->name == $role){
			return true;
		}
		return false;
	}

	public function role()
	{
		return $this->belongsTo(Role::class, 'role_id', 'uuid');
	}

	public function can($perm = null)
	{
		if(is_null($perm)) return false;
		if($this->role->permissions->contains('name', $perm))
			return true;
		else
			return false;
	}
}
