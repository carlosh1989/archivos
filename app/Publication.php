<?php

namespace App;

use App\File;
use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'publications';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'file_id', 'councilor_id', 'clasificacion','visto'];

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

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
