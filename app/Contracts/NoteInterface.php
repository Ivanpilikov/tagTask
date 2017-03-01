<?php

namespace App\Contracts;

interface NoteInterface
{
    public function getAllNotes( );

    public function getCategory();
    
    public function postNoteEdit($id,$data);
    
    public function addNotePost($data);
    
    public function getMyNotes();
    
    public function getNote($id);
    
    public function postGetNote($id);
    
    public function postNoteDelete($id);
}