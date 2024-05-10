<?php
namespace App\Http\Controllers;

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
    // here i show the  form to create a new user, and return it

    public function show()
    {
        $country = Country::get();
        return view('users/signup', compact('country'));

    }

    // here i validate the fields and  save the data of the new user in the database
    public function signup(Request $request)
    {
        //  validate the input fields
        try {
            $validationRules = [
                "firstname" => "required|regex:/^[a-zA-Z\s]+$/",
                "lastname" => "required|alpha",
                "email" => "required|email|unique:users",
                "password" => "required|min:8|max:12",
                "country" => "required",
                "gender" => "required",
                "hobbies" => "required",
            ];
            $validator = Validator::make($request->all(), $validationRules)->stopOnFirstFailure();
            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
            }
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
        } catch (Exception) {
            return back()->withErrors($validator->errors())->withInput();
        }
    }

    public function verifyemail()
    {
        return view('users.addverifyemail');
    }
    public function addverifyemail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $otps = new Otps();
        $token = str::random(6);
        $otps->email = $request->email;
        $otps->token = $token;
        $otps->save();
        return redirect('/token')->with('success', 'Check your mail and fill OTP');
    }

    public function showemailverify()
    {
        return view('users.verifyemailtoken');
    }

    public function ckeckemailtoken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $otps = Otps::where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if ($otps) {
            $otps->delete();
        } else {
            return back()->withErrors(['message' => 'Invalid token or email'])->withInput();
        }
        return redirect('/signup')->with('success', 'Register your account');
    }


    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user && $user->is_active) {
            if ($user->role == '1') {
                Auth::login($user);
                return redirect()->route('admin');
            }
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput();
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
                return redirect('/');
            }
        } else {
            // Redirect to the login page if the user is not logged in
            return redirect('/login');
        }
    }

    // here i add the functionality of profile page
    public function showProfile()
    {
        $user = auth()->user();
        $userWithCountry = User::join('country', 'users.country_id', '=', 'country.id')// here i join the country and users table for visibility of country at  frontend side.
            ->select('country.country')
            ->where('users.id', $user->id)
            ->first();
        return view('pages.profile', compact('user', 'userWithCountry'));
    }

    // adding a profileimage functionality
    public function Profile(Request $request)
    {
        $user = auth()->user();
        if ($request->hasFile('profileimage')) {
            $filename = time() . "carsafe." . $request->file('profileimage')->getClientOriginalExtension();
            $filePath = $request->file('profileimage')->storeAs('public/profileimages', $filename);
            $user->profileimage = $filename; // Store only the filename in the database
            $user->save();
            return redirect()->route('profile')->with('success', 'Profile updated successfully.');
        }
        // return redirect()->route('profile')->with('error', 'No image uploaded.');
    }

    public function editProfile()
    {
        $user = auth()->user();
        $countries = Country::all(); // Fetch all countries
        $userWithCountry = User::join('country', 'users.country_id', '=', 'country.id')
            ->where('users.id', $user->id)
            ->select('users.*', 'country_id')
            ->first();
        $hobbies = json_decode($user->hobbies); // Decode hobbies from JSON to array
        return view('pages/profileedit', compact('user', 'userWithCountry', 'countries', 'hobbies'));
    }

    public function updateProfile(Request $request)
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
        $country = Country::all();
        $users = User::with('country')->get();
        return view('pages.search', compact('users', 'country'));
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
            $data = $query->get();
            $html = view('pages.partial_view', compact('data'))->render();
            return $html;
        }
    }

}



// php artisan make:controller PostController --resource




