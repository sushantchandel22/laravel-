<?php
namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Otps;
use Illuminate\Support\Str;
use App\Models\EmailVerification;
use App\Http\Requests\SignupRequest;
use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Country;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Laravel\Socialite\Facades\Socialite;
use Validator;
use DB;


// use App\Models\Album;
class UserController extends Controller
{
    public function show()
    {
        $country['country'] = Country::get();
        return view('users/signup', $country);
    }

    public function signup(SignupRequest $request)
    {
        $fullName = $request->firstname . ' ' . $request->lastname;
        $user = new User();
        $user->name = $fullName;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->country_id = $request->country;
        $user->gender = $request->gender;
        $user->hobbies = json_encode($request->hobbies);
        $user->save();
        $request->session()->flash('status', 'Your account has been created. Please verify your email.');
        return redirect('/login');
    }


    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user && $user->is_active) {
            if ($user->role == '1') {
                Auth::login($user);
                return redirect()->route('admin');
            }

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->route('profile');
            }
            return back()->withErrors(['email' => 'Invalid email and password'])->withInput();
        } else {
            return back()->withErrors(['email' => 'Your account is deactivated'])->withInput();
        }
    }


    public function redirectToGoogle()
    {
        session()->forget('type');
        return Socialite::driver('google')->redirect();
    }



    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::Where('google_id', $googleUser->getId())->first();

        if (session()->get('type') == 'login') {
            if (!$user) {
                return redirect('/signup')->with('message', 'First signup your account');
            }
        }
        if (!$user) {
            $user = User::create([
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
            ]);
        }
        Auth::login($user);
        return redirect('profile');
    }

    public function redirectLogin()
    {
        session()->put('type', 'login');
        return Socialite::driver('google')->redirect();
    }

    // here i add logout functionality 
    public function logout(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                // dd();
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/login');
            } else {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/login');
            }
        } else {
            // Redirect to the login page if the user is not logged in
            return redirect('/login');
        }
    }

    // here i add the functionality of profile page
    public function showProfile()
    {
        $user  = auth()->user();
        $userWithCountry = User::join('country', 'users.country_id', '=', 'country.id')
            ->select('country.country')
            ->where('users.id', $user->id)
            ->first();
        return view('pages.profile',[
            'user' => $user,
            'country' => $userWithCountry->country,
        ]);
    }

    // adding a profileimage functionality
    public function Profile(Request $request)
    {
        $user = auth()->user();
        if ($request->hasFile('profileimage')) {
            $filename = time() . "carsafe." . $request->file('profileimage')->getClientOriginalExtension();
            $filePath = $request->file('profileimage')->storeAs('public/profileimages', $filename);
            $user->profileimage = $filename;
            $user->save();
            return redirect()->route('profile')->with('success', 'Profile updated successfully.');
        }

    }
    // compact('user', 'userWithCountry', 'countries', 'hobbies')
    public function editProfile()
    {
        $user = auth()->user();
        $countries = Country::all(); // Fetch all countries
        $userWithCountry = User::join('country', 'users.country_id', '=', 'country.id')
            ->where('users.id', $user->id)
            ->select('users.*', 'country_id')
            ->first();
        $hobbies = json_decode($user->hobbies); // Decode hobbies from JSON to array
        return view('pages/profileedit', [
            'user' => $user,
            'userWithCountry' => $userWithCountry,
            'countries' => $countries,
            'hobbies' => $hobbies
        ] );
    }

    public function updateProfile(ProfileRequest $request)
    {
        $user = auth()->user();
        $user->name = $request->input('firstname') . ' ' . $request->input('lastname');
        $user->gender = $request->input('gender');
        $user->country_id = $request->input('country');
        if ($request->has('hobbies')) {
            $user->hobbies = json_encode($request->input('hobbies'));
        }
        $user->save();
        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
    public function showforgetpassword()
    {
        return view('users/forgetpassword');
    }



    public function searchoption()
    {
        $country ['country'] = Country::all();
        $users ['user'] = User::with('country')->get();
        return view('pages.search',$country , $users);
    }


    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query = User::join('country', 'users.country_id', '=', 'country.id')
                ->select('users.*', 'country.country as country_name');
            if (!empty($request->search)) {
                $query->where('users.name', 'like', '%' . $request->search . '%');
            }
            if (!empty($request->country)) {
                $query->where('users.country_id', $request->country);
            }
            if (!empty($request->gender)) {
                $query->where('users.gender', $request->gender);
            }
            if (!empty($request->hobbies)) {
                // Assuming $request->hobbies is an array of hobbies
                $query->where(function ($q) use ($request) {
                    foreach ($request->hobbies as $hobby) {
                        $q->orWhereJsonContains('users.hobbies', $hobby);
                    }
                });
            }
            $data ['data'] = $query->get();
            $html = view('pages.partial_view', $data)->render();
            return $html;
        }
    }

}





