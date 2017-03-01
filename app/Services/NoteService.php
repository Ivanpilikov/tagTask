<?php

namespace App\Services;

use App\User;
use App\Category;
use App\Note;
use App\Contracts\NoteInterface;
use Cache;
use Redirect;
use Validator;
use Request;
use File;
class NoteService implements NoteInterface
{
	public function __construct(Note $note , Category $category)
	{
            $this->note = $note;
            $this->category = $category;
	}

	
        /**
	 * Get all notes
	 *
	 * @param  empty
	 * @return Responce
	 */
	public function getAllNotes()
	{
            return $this->note->where('published',1)->orderBy('created_date', 'desc')->paginate(20);
	}/**
	 *
	 * 
	 * @param 
	 * @return Create Note
	 */
	

	public function getMyNotes()
	{
            $note = $this->note->where('user_id', \Auth::user()->id)->orderBy('created_date', 'desc')->paginate(20); 
            return $note;
	}

	public function getCategory()
	{
            return $this->category->get();
	}

	public function addNotePost($request)
	{
            $input = $data = $request->except('_token','image_name');
            if ((Request::file('image_name')) && Request::file('image_name')->isValid()) {
                $imageName = $this->avatarUpload($request->image_name);
                if(isset($imageName)){
                    $input['image_name'] = $imageName;
                }

            }
            $input['user_id'] = \Auth::user()->id;
            $ins = Note::create($input);
         
        }
        public function getNote($id){
            $category = $this->getCategory();
            $note = $this->note->where('id', $id)->where('user_id',\Auth::user()->id)->first(); 
            if($note){
                return ['note'=>$note,'category'=>$category];
            }    
                  

        }
        public function postNoteEdit($id,$request){
            $input = $request->except('_token','image_name','edit');
            if(!isset($input['published'])){
               $input['published'] = 0; 
            }
            if ((Request::file('image_name')) && Request::file('image_name')->isValid()) {
                $oldimg = $this->note->where('id', $id)->pluck('image_name');
                $imageName = $this->avatarUpload($request->image_name,$oldimg[0]);
                if(isset($imageName)){
                    $input['image_name'] = $imageName;
                }

            }
            $input['user_id'] = \Auth::user()->id;
            $this->note->where('id', $id)->where('user_id' , \Auth::user()->id)->update($input);
            
        }
        public function postNoteDelete($id){
            if($this->note->where('id', $id)->where('user_id' , \Auth::user()->id)->delete()){
                return response()->json('success');
            }
            return response()->json('error');
            
        }
        public function postGetNote($id){
           
            $note = $this->note->where('id', $id)->with('category')->first(); 
            if($note){
                return ['note'=>$note,'status'=>'succsess'];
            }
            
            
        }

        private function avatarUpload($data,$oldimg=null){
            $imageName = time().'.'.$data->getClientOriginalExtension();
            $data->move(public_path('img'), $imageName);
            $file_path = public_path() . '/img/' . $oldimg;
            if (file_exists($file_path)) {
                File::delete($file_path);
            }
            
            return $imageName;
        }

}