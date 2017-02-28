<?php

namespace App;

use App\Councilor;
use App\File;
use App\Publication;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;

class User extends Model implements AuthenticatableContract
{

    use Authenticatable;

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['councilor_id', 'email', 'password', 'role', 'remember_token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    public static function validate($input)
    {

            $rules = array(
                'name' => 'required|numeric',
              );
            return Validator::make($input, $rules);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function councilor()
    {
        return $this->hasOne(Councilor::class);
    }
}
