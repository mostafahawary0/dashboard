<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\permissions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('web')->user()->role != 1){
            return redirect(route('home'));
        }
        $sections = User::paginate(10);
        return view('dashboard.users.index',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::guard('web')->user()->role != 1){
            return redirect(route('home'));
        }
        $sections = permissions::get();
        return view('dashboard.users.create',compact('sections'));
    }


    function registrationpost(Request $request){
        if (Auth::guard('web')->user()->role != 1){
            return redirect(route('home'));
        }
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ],
        [
            'name.required' => __('lang.Valid'),
            'email.required' =>  __('lang.Valid'),
            'email.unique' =>  __('lang.Validunique'),
            'password.required' =>  __('lang.Valid'),
        ]);

        $password = Hash::make($request->password);

        
        $user= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$password,
            'role'=>$request->role,
         ]);
      

        if(!$user){
            return back()->with("error"," error");
        }
        return back()->with("success",__('lang.saved'));
    }

     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::guard('web')->user()->role != 1){
            return redirect(route('home'));
        }

        $sections = permissions::get();
        $user= User::findorFail($id);
        return view('dashboard.users.edit',compact('sections','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::guard('web')->user()->role != 1){
            return redirect(route('home'));
        }

        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ],
        [
            'name.required' => __('lang.Valid'),
            'password.required' =>  __('lang.Valid'),
        ]);
    
        $section= User::findorFail($id);
        $section->update([
            'name'=>$request->name,
            'password' => Hash::make($request->password),
            'role'=>$request->role,
        ]);

        if(!$section){
            return back()->with("error"," error");
        }
        else
        {
            return back()->with("success",__('lang.saved'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::guard('web')->user()->role != 1){
            return redirect(route('home'));
        }
        $section= User::findorFail($id)->delete();
        if(!$section){
            return back()->with("error"," error");
        }
        else
        {
            return back()->with("success",__('lang.deleted'));
        }
    }


    public function password()
    {
        return view('dashboard.settings.password');
    }
    

    public function updatePass(Request $request)
    {
        $request->validate([
            'old' => 'required',
            'new' => 'required|min:6|max:100',
            'confirm' => 'required|same:new'
        ],
        [
            'old.required' => __('lang.Valid'),
            'new.min' => __('lang.Valid'),
            'new.required' => __('lang.Valid'),
            'confirm.required' => __('lang.Valid'),
            'confirm.same' => __('lang.Valid'),
        ]
    );

    $admin= Auth::guard('web')->user();
 
     if(!Hash::check($request->old,  $admin->password)){
            return back()->with("error", __('lang.validpass'));
        }


        #Update the new Password
        User::whereId($admin->id)->update([
            'password' => Hash::make($request->new),
            'email' => $request->email
        ]);

        return back()->with("success", __('lang.saved'));

    }

}


 