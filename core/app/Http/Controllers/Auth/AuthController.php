<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	protected $loginPath = '/login';

	use AuthenticatesAndRegistersUsers;

	//protected $username = 'username';

	/**
	 * @param Guard $auth
	 * @param Registrar $registrar
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => ['getLogout'],['frontend']]);
	}


	public function postLogin(Request $request)
	{
		// get our login input
		$login = $request->input('login');
		// check login field
		$login_type = filter_var( $login, FILTER_VALIDATE_EMAIL ) ? 'email' : 'username';
		// merge our login field into the request with either email or username as key
		$request->merge([ $login_type => $login ]);
		// let's validate and set our credentials
		if ( $login_type == 'email' ) {
			$this->validate($request, [
				'email'    => 'required|email',
				'password' => 'required',
			]);
			$credentials = $request->only( 'email', 'password' );
		} else {
			$this->validate($request, [
				'username' => 'required',
				'password' => 'required',
			]);
			$credentials = $request->only( 'username', 'password' );
		}
		if ($this->auth->attempt($credentials, $request->has('remember')))
		{
			return redirect()->intended($this->redirectPath());
		}
		return redirect()->back()
			->withInput($request->only('login', 'remember'))
			->withErrors([
				'login' => $this->getFailedLoginMessage(),
			]);
	}

}
