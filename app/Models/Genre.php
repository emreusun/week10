<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    /**
     * The table our model uses from the database
     * 
     * @var string
     */
    protected $table = 'genres';

    /**
     * Indicates whether or not our model is using the
     * created_at
     * and
     * updated_at
     * columns in the database.
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * The properties / columns on the model that are "mass assignable" -
     * meaning they can be passed in as keys on an array to either create() or update()
     * Acts as a whitelist of acceptable inputs
     * 
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /* ======================== RELATIONSHIPS ==================== */

    /**
     * A Genre has many songs
     * 
     * @return BelongsToMany
     */
    public function songs()
    {
        return $this->belongsToMany(Song::class);
    }
}