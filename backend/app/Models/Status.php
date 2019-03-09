<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use Traits\VoteTrait;
    
    protected $guarded = [];

    const UPDATED_AT = null;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id')->select('id','name','title_id');
    }
    /**
    * Get all of the owning attachable models.
    */
    public function attachable()
    {
        return $this->morphTo();
    }

}
