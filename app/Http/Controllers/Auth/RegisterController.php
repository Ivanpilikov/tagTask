<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\AuthRequests;
use Illuminate\Auth\Events\Registered;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use \GuzzleHttp\Client;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user';
    protected $mailer;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    
    public function register(AuthRequests $request)
    {
        
        event(new Registered($user = $this->create($request->inputs())));
        
        //$this->guard()->login($user);
        
        return redirect('/login')->with('status', 'We sent you an activation code. Check your email.');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        
        $avatarName = '';
        if(isset($data['avatar'])){
            $avatarName = $this->avatarUpload($data['avatar']);
         }
         
        $user =  User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'age' => $data['age'],
            'avatar' => $avatarName,
            'email' => $data['email'],
            'auth_token' => $data['auth_token'],
            'password' => bcrypt($data['password']),
        ]);
        if(isset($user)){
            $link = route('user.activate', $data['auth_token']);
            $message = url($link);

            $this->mailer->raw($message, function (Message $m) use ($user) {
                $m->to($user->email)->subject('Activation mail');
            });
            
        }
        
    }
    private function avatarUpload($data)
    {
    	//dd($data->getClientOriginalExtension());
        $imageName = time().'.'.$data->getClientOriginalExtension();
        $data->move(public_path('avatar'), $imageName);
    	return $imageName;
    }
    public function activateUser($token)
    {
       $user = User::where('auth_token', $token)->first();
        if ($user === null) {
            return null;
        }
    

        $user->confirmed = true;

        $user->save();

        
        $this->guard()->login($user);
        
        return redirect('/user')->with('status', 'We sent you an activation code. Check your email.');

    }
    
}
