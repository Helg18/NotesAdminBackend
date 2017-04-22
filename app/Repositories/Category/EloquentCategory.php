<?php 

namespace App\Repositories\Category;

use App\Repositories\Category\CategoryRepository;

use App\Category;


class EloquentCategory implements CategoryRepository
{
	private $category;

	public function __construct(Category $category)
	{
		$this->category = $category;
	}

	public function getAll(){
		return $this->category->all();
	}

	public function getById($id){
		return $this->category->findOrFail($id);
	}

	public function create( array $attributes ){
		return $this->category->create($attributes);
	}

	public function update($id, array $attributes){
		$cat = $this->category->findOrFail($id);
		$cat->update($attributes);
		$cat->save();
		return $cat;
	}

	public function delete($id){
		$this->category->findOrFail($id)->delete();
		return true;
	}
	
}