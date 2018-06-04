<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that 
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        
        try{
        $user = Socialite::driver('facebook')->user();
    } 
    catch(Ecxeption $e){
        return redirect('auth/facebook');
    }
    

        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser, true);
        return redirect()->route('home');
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($facebookUser)
    {
        $authUser = User::where('facebook_id', $facebookUser->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $facebookUser->name,
            'email'    => $facebookUser->email,
            'avatar' => $facebookUser->avatar,
            'facebook_id' => $facebookUser->id
        ]);
    }

    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that 
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleGoogleProviderCallback()
    {
        
        try{
        $user = Socialite::driver('google')->user();
    } 
    catch(Ecxeption $e){
        return redirect('auth/google');
    }
    
    
        $authUser = $this->findOrCreateGoogleUser($user);
        Auth::login($authUser, true);
        return redirect()->route('home');
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateGoogleUser($googleUser)
    {
        $authUser = User::where('google_id', $googleUser->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $googleUser->name,
            'email'    => $googleUser->email,
            'avatar' => $googleUser->avatar,
            'google_id' => $googleUser->id
        ]);
    }

}
