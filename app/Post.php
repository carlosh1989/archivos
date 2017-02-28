<?php

namespace App;

use App\File;
use App\Publication;
use App\Councilor;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['publication_id', 'file_id', 'councilor_id', 'visto'];

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

    public function councilor()
    {
        return $this->belongsTo(Councilor::class);
    }

    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
