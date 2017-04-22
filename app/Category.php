<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'category';
    protected $fillable = [
        'categoria', 'user_id',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    
    public function notes()
    {
    	return $this->belongsTo('App\Note');
    }

}
