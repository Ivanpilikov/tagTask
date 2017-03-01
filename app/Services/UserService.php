<?php

namespace App\Services;

use App\User;
use App\Contracts\UserInterface;
use Cache;
use Validator;
use File;
class UserService implements UserInterface
{
    public function __construct(User $user)
    {
            $this->user = $user;
    }
    public function edit($id,$request) {
        $data = $request->except('_token','avatar');
        if(isset($request->avatar)){
            $avatarName = $this->avatarUpload($request->file('avatar'));
            $data['avatar'] = $avatarName;
        }
        $this->user->where('id', $id)->update($data);

    }
    
     private function avatarUpload($data)
        {
            
            $imageName = time().'.'.$data->getClientOriginalExtension();
            $data->move(public_path('avatar'), $imageName);
            $file_path = public_path() . '/avatar/' . \Auth::user()->avatar;
                   if (file_exists($file_path)) {
                       File::delete($file_path);
                   }
            return $imageName;
        }
    

}