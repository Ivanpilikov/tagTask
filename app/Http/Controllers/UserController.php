<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequests;
use App\Contracts\UserInterface;



class UserController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.home');
    }
    public function userEdit(){
        return view('user.edit');
    }

    public function edit($id,UserRequests $request,UserInterface $userService){
        $userService->edit($id, $request);
        return redirect()->back();
        
        
    }
   
}
