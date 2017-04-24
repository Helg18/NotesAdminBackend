<?php 

namespace App\Repositories\Note;

use App\Repositories\Note\NoteRepository;

use App\Note;


class EloquentNote implements NoteRepository
{
	private $note;

	public function __construct(Note $note)
	{
		$this->note = $note;
	}

	public function getAll(){

		$alldata = $this->note->all();
		$data = [];
		foreach($alldata as $c){
			$item = $c->toArray();
			$item["category_name"] = $c->category->categoria;
			$item["user_name"]     = $c->user->name;
			$item["user_email"]    = $c->user->email;
			
			$data[] = $item;
		}
		return $data;
	}


	public function getById($id){
		$c = $this->note->findOrFail($id);
		$data = [];
		
		$item = $c->toArray();
		$item["category_name"] = $c->category->categoria;
		$item["user_name"]     = $c->user->name;
		$item["user_email"]    = $c->user->email;
		
		$data[] = $item;

		return $data;
	}

	public function create( array $attributes ){
		return $this->note->create($attributes);
	}

	public function update($id, array $attributes){
		$cat = $this->note->findOrFail($id);
		$cat->update($attributes);
		$cat->save();
		return $cat;
	}

	public function delete($id){
		$this->note->findOrFail($id)->delete();
		return true;
	}
	
}