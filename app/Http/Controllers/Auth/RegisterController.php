<?php

namespace App\Http\Controllers\Auth;

use DB;
use Exception;
use App\Model\User;
use App\Model\Customer;
use App\Model\Seller;
use App\Model\VerifyUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user); // trigered auto login

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath())->with('status', 'Silahkan cek email Anda untuk memverifikasi sebelum login.');
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerSeller(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->createSeller($request->all()) ));

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath())->with('status', 'Silahkan cek email Anda untuk memverifikasi sebelum login.');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'role' => 'customer',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $customer = Customer::create([
            'user_id' => $user->id,
            'name' => $data['name'],
            'gender' => $data['gender'],
            'active' => false
        ]);

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        $user->sendVerificationEmail($user, $verifyUser->token);
    }
    
    /**
     * Create a new user seller instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createSeller(array $data)
    {
        $user = User::create([
            'role' => 'seller',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Seller::create([
            'user_id' => $user->id,
            'name' => $data['name'],
            'slug' => $this->slugify($data['name']),
            'description' => $data['description'],
            'active' => false
        ]);

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        $user->sendVerificationEmail($user, $verifyUser->token);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }

    public function slugify ($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
