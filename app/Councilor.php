<?php

namespace App;

use App\Post;
use App\Room;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Councilor extends Model
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'councilors';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'avatar', 'name', 'cedula', 'telefono', 'comision', 'direccion', 'parroquia', 'nacimiento'];

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function room()
    {
        return $this->hasOne(Room::class);
    }
}
