<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
	protected $table = 'notes';
    protected $fillable = [
					'title',
					'note',
					'status',
					'user_id',
					'category_id',
				];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
}
