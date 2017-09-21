<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
use Socialite;
class SocialController extends Controller
{
    protected $redirectTo = '/home';


    public function redirectToProvider($provider)
    {
      return Socialite::driver($provider)->redirect();
    }


    public function handleProviderCallback($provider)
    {
      $user = Socialite::driver($provider)->stateless()->user();            
      $authUser = $this->findOrCreateUser($user, $provider);
      Auth::login($authUser, true);
      return redirect($this->redirectTo);
      // return $user->name;

      // try{
      //       $user = Socialite::driver($provider)->stateless()->user();
      //   } catch (\GuzzleHttp\Exception\ClientException $e) {
      //       abort(403, 'Unauthorized action.');
      //       return redirect()->to('/');
      //   }
      //   $attributes = [
      //       'provider' => $provider,
      //       'provider_id' => $user->getId(),
      //       'name' => $user->getName(),
      //       'email' => $user->getEmail(),
      //       'password' => isset($attributes['password']) ? $attributes['password'] : bcrypt(str_random(16))
      //
      //   ];
      //
      //   $user = User::where('provider_id', $user->getId() )->first();
      //   if (!$user){
      //       try{
      //           $user=  User::create($attributes);
      //       }catch (ValidationException $e){
      //         return redirect()->to('/auth/login');
      //       }
      //   }
      //
      //   // $this->guard()->login($user);
      //  return redirect()->to($this->redirectTo);

    }



    public function findOrCreateUser($user, $provider)
    {
      $authUser = User::where('provider_id', $user->id)->first();
      if ($authUser)
      {
        return $authUser;
      }
      return User::create([
        'provider' => $provider,
        'provider_id' => $user->getId(),
        'name' => $user->getName(),
        'email' => $user->getEmail(),
        'password' => isset($attributes['password']) ? $attributes['password'] : bcrypt(str_random(16))

      ]);
    }
    // use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
}
