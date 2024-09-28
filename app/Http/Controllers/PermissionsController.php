<?php

namespace App\Http\Controllers;

use App\Models\permissions;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class PermissionsController extends Controller
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
    $sections = permissions::select('uuid', 'permissionsAR', 'permissionsEN', 'permissionsFR', DB::raw('count(*) as count'))
    ->groupBy('uuid', 'permissionsAR', 'permissionsEN', 'permissionsFR')->paginate(10);
                
        return view('dashboard.permissions.index',compact('sections'));
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
        $sections = section::get();
        return view('dashboard.permissions.create',compact('sections'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::guard('web')->user()->role != 1){
            return redirect(route('home'));
        }

        $request->validate([
            'permissionsAR' => 'required',
            'permissionsEN' => 'required',
            'permissionsFR' => 'required',
            'section' => 'required',
        ],
        [
         
            'permissionsAR.required' => __('lang.ValidPrAR'),
            'permissionsEN.required' =>  __('lang.ValidPrEN'),
            'permissionsFR.required' =>  __('lang.ValidPrFR'),
            'section.required' =>  __('lang.ValiCheckbox'),
        ]
    );

    $permissionsAR= $request->input('permissionsAR');
    $permissionsEN= $request->input('permissionsEN');
    $permissionsFR= $request->input('permissionsFR');
    $section= $request->input('section',[]);
    $uuid = Str::uuid()->toString();
    $units = [];

    foreach ($section as $index => $unit) {
        $units[] = [
            "uuid" => $uuid,
            "permissionsAR" => $permissionsAR,
            "permissionsEN" => $permissionsEN,
            "permissionsFR" => $permissionsFR,
            "section_id" => $section[$index],
            'created_at' => now() 
         ];
    }

    $created = permissions::insert($units);

       
    if(!$created){
        return back()->with("error"," error");
    }
    else
    {
    return back()->with("success",__('lang.saved'));
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function show(permissions $permissions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::guard('web')->user()->role != 1){
            return redirect(route('home'));
        }

        $Namepermissions= permissions::where('uuid','=',$id)->get();
        
        $sections = Section::whereDoesntHave('permissions', function($query) use ($Namepermissions) {
            $query->whereIn('section_id', $Namepermissions->pluck('section_id'));
        })->get();

        return view('dashboard.permissions.edit',compact('Namepermissions','sections'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request, $uuid)
    {

        if (Auth::guard('web')->user()->role != 1){
            return redirect(route('home'));
        }

        $request->validate([
            'nameAR' => 'required',
            'nameEN' => 'required',
            'nameFR' => 'required',
        ],
        [
            'nameAR.required' => __('lang.ValidPrAR'),
            'nameEN.required' =>  __('lang.ValidPrEN'),
            'nameFR.required' =>  __('lang.ValidPrFR'),
        ]
    );

    $section = permissions::where('uuid', $uuid)
    ->update([
        'permissionsAR'=>$request->nameAR,
        'permissionsEN'=>$request->nameEN,
        'permissionsFR'=>$request->nameFR,
     ]);

     $nameAR= $request->nameAR;
     $nameEN= $request->nameEN;
     $nameFR= $request->nameFR;
     
     $sections= $request->input('section',[]);
     $uid = $uuid;
     $units = [];
 
     foreach ($sections as $index => $unit) {
         $units[] = [
             "uuid" => $uid,
             "permissionsAR" => $nameAR,
            "permissionsEN" => $nameEN,
            "permissionsFR" => $nameFR,
             "section_id" => $sections[$index],
             'created_at' => now() 
          ];
     }
     $created = permissions::insert($units);

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
     * @param  \App\Models\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        if (Auth::guard('web')->user()->role != 1){
            return redirect(route('home'));
        }

        $order= permissions::where('uuid',$uuid)->delete();
        if(!$order){
            return back()->with("error"," error");
        }
        else
        {
        return back()->with("success",__('lang.deleted'));
        }
    }

    public function destroyOne($id)
    {
        if (Auth::guard('web')->user()->role != 1){
            return redirect(route('home'));
        }
        
        $section= permissions::findorFail($id)->delete();
        if(!$section){
            return back()->with("error"," error");
        }
        else
        {
            return back()->with("success",__('lang.deleted'));
        }
    }
    
}
