<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\Repositories\Note\NoteRepository;
use App\Http\Requests\NoteRequest;

class NotesController extends Controller
{

    private $note;

    function __construct(NoteRepository $note)
    {
        $this->note = $note;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->note->getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
    {
        $attributes['user_id']     = $request->user()->id;
        $attributes['note']        = $request->note;
        $attributes['title']       = $request->title;
        $attributes['status']      = 0;
        $attributes['category_id'] = $request->category_id;

        $this->note->create($attributes);

        return response()->json(['msg'=>'Nota creada exitosamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->note->getById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attributes['user_id']     = $request->user()->id;
        $attributes['note']        = $request->note;
        $attributes['title']       = $request->title;
        $attributes['category_id'] = $request->category_id;
        $attributes['status']      = $request->status;

        $this->category->update($id, $attributes);

        return response()->json(['msg'=>'Nota actualizada exitosamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->note->delete($id);
        
        return response()->json(['msg'=>'Nota eliminada exitosamente']);
    }
}
