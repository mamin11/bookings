<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $userInDB = User::where('google_id',$user->getId())->first();
            $emailInBD = User::where('email', $user->getEmail())->first();

            //if the user already exists, login else create
            if($userInDB) {
                //automatically login the user
                Auth::login($userInDB, true);
                return redirect()->route('dashboard');
            }
            else if($emailInBD) {
                //set their google id
                $emailInBD->google_id = $user->getId();
                $emailInBD->save();

                //log them in
                Auth::login($emailInBD, true);
                return redirect()->route('dashboard');
            }
            else {
                $googleUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'role_id' => 3,
                    'google_id' => $user->getId(),
                    'email_verified_at' => time()
                ]);

                //automatically login the user
                Auth::login($googleUser, true);                
                return redirect()->route('dashboard');
            }    
            
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
}
