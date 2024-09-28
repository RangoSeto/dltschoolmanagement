<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Gender;
use App\Models\Lead;
use App\Models\Country;
use App\Models\City;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // single step
        // $genders = Gender::orderBy('name','asc')->get();
        // $countries = Country::orderBy('name','asc')->where('status_id',3)->get();
        // return view('auth.register',compact('genders','countries',));


        // multi step form 
        return view('auth.registerstep1');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstname' => 'required|string|max:100',
            'lastname' => 'string|max:100',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender_id' => 'required|exists:genders,id',
            'age' => 'required|integer|min:13|max:45',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        $user = User::create([
            'name' => $request['firstname']." ".$request['lastname'],
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($user->id){
            // create lead
            
            Lead::create([
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],
                'gender_id' => $request['gender_id'],
                'age' => $request['age'],
                'email' => $request['email'],
                'country_id' => $request['country_id'],
                'city_id' => $request['city_id'],
                'user_id' => $user->id
            ]);

        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }



    public function createstep1(){
        return view('auth.registerstep1');
    }

    public function storestep1(Request $request){

        $request->validate([
            'email'=>'required|string|email|max:100|unique:users',
            'password'=>'required|string|min:8|confirmed'
        ]);

        $request->session()->put('registerationdatas',$request->only('email','password'));

        return redirect()->route('register.step2');
    }

    

    public function createstep2(){
        $genders = Gender::all();
        return view('auth.registerstep2',compact('genders'));
    }

    public function storestep2(Request $request){

        $request->validate([
            'firstname'=>'required|string|max:100',
            'lastname'=>'nullable|string|max:100',
            'gender_id' => 'required|exists:genders,id',
            'age'=>'required|integer|min:13|max:35'
        ]);

        $regdatas = $request->session()->get('registerationdatas');
        // step1 မလုပ်ရသေးဘဲ step2 ကေျာ်လို့ရနေတယ်
        $regdatas['lead'] = $request->only('firstname','lastname','gender_id','age');
        $request->session()->put('registerationdatas',$regdatas);


        return redirect()->route('register.step3');

    }



    public function createstep3(){
        $countries = Country::orderBy('name','asc')->where('status_id',3)->get();

        return view('auth.registerstep3',compact('countries'));
    }

    public function storestep3(Request $request){

        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
        ]);


        $regdatas = $request->session()->get('registerationdatas');

        if(!$regdatas){
            return redirect()->route('register.step1')->with('error','Registeration Data is missing.');
        }

        $regdatas['country_id'] = $request->input('country_id');
        $regdatas['city_id'] = $request->input('city_id');


        $request->session()->put('registerationdatas',$regdatas);



        $user = User::create([
            'name' => $regdatas['lead']['firstname']." ".$regdatas['lead']['lastname'],
            'email' => $regdatas['email'],
            'password' => Hash::make($regdatas['password']),
        ]);


        $user->lead()->create([
            'firstname' => $regdatas['lead']['firstname'],
            'lastname' => $regdatas['lead']['lastname'],
            'gender_id' => $regdatas['lead']['gender_id'],
            'age' => $regdatas['lead']['age'],
            'email' => $regdatas['email'],
            'country_id' => $regdatas['country_id'],
            'city_id' => $regdatas['city_id']
        ]);




        // return redirect()->route('home');

        event(new Registered($user));

        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
