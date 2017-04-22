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
		return $this->note->all();
	}

	public function getById($id){
		return $this->note->findOrFail($id);
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