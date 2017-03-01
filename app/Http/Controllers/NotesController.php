<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Http\Requests\NoteRequests;
use App\Contracts\NoteInterface;
use File;

class NotesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NoteInterface $noteService)
    {
      $notes = $noteService->getAllNotes(); 
        return view('notes.notes')->with('notes',$notes);
    }

    public function getCategory(NoteInterface $noteService){
        $category = $noteService->getCategory();
        return view('notes.add_notes')->with('category',$category);
    }

    public function addNotePost(NoteInterface $noteService,NoteRequests $request)
    {
       $notes = $noteService->addNotePost($request); 
       return redirect('/add_notes')
               ->with('message', 'Note Added Successfully');
    }
    public function postNoteEdit(NoteInterface $noteService,$id,NoteRequests $request){
        $noteService->postNoteEdit($id,$request);
        return redirect()->back();
        
    }

    public function getMyNotes(NoteInterface $noteService)
    {
       $notes = $noteService->getMyNotes();
       return view('notes.my_notes')->with('notes', $notes);
    }
    public function postGetNote(NoteInterface $noteService,$id,Request $request){
        
        $data = $noteService->postGetNote($id);
        return json_encode($data);
    }

    public function getNote(NoteInterface $noteService, $id)
    {
    
       $note = $noteService->getNote($id);
       if(!isset($note))
            return redirect()->back();
           
       return view('notes.edit_note')->with($note);
    }
    public function postNoteDelete(NoteInterface $noteService,Request $request)
    {
        return $noteService->postNoteDelete($request->id);
    }



}
