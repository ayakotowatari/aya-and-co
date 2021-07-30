<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    public function showResetForm(Request $request, $token = null)
    {
        // DD($request->email);
        
        // return view('auth.passwords.reset_vue')->with(
        //     ['token' => $token, 'email' => $request->email]
        // );

        return view('auth.passwords.reset_vue')->with(
            ['token' => $token, 'email' => $request->email]
        );

        // return response()->json(['token' => $token, 'email' => $request->email], 200);   
    }

     /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        // $request->validate($this->rules(), $this->validationErrorMessages());

        $validator = Validator::make($request->all(), [

            'token' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max255'],
            'password' => ['required', 'confirmed', 'min:8']

        ]);
      
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password) 
    { 
        $this->setUserPassword($user, $password); 
        //Here Larvel tries to set the "Remember me" cookie 
        $user->setRememberToken(Str::random(60)); 

        $user->save(); 
        event(new PasswordReset($user)); 
        //By default, Laravel will attempt to automatically log in the user 
        $this->guard()->login($user); 
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        // return redirect($this->redirectPath())
        //                     ->with('status', trans($response));

        return response()->json(['success' => ["message" => trans($response)] ], 200);
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        // return redirect()->back()
        //             ->withInput($request->only('email'))
        //             ->withErrors(['email' => trans($response)]);

        return response()->json(['error' => ["message" => trans($response)] ], 422);
    }



    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
}
