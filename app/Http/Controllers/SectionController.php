<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SectionController extends Controller
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
        $sections = Section::paginate(10);
        return view('dashboard.section.index',compact('sections'));
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
        return view('dashboard.section.create');
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
            'nameAR' => 'required',
            'nameEN' => 'required',
            'nameFR' => 'required',
        ],
        [
            'nameAR.required' => __('lang.ValidSecAR'),
            'nameEN.required' =>  __('lang.ValidSecEN'),
            'nameFR.required' =>  __('lang.ValidSecFR'),
        ]
    );

    $section= Section::create([
        'nameAR'=>$request->nameAR,
        'nameEN'=>$request->nameEN,
        'nameFR'=>$request->nameFR,
     ]);
     
     if(!$section){
        return redirect(route('section.create'))->with("error"," error");
    }
    else
    {
    return redirect(route('section.create'))->with("success",__('lang.saved'));
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::guard('web')->user()->role != 1){
            return redirect(route('home'));
        }
        $sections= Section::findorFail($id);
        return view('dashboard.section.edit',compact('sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
            'nameAR.required' => __('lang.ValidSecAR'),
            'nameEN.required' =>  __('lang.ValidSecEN'),
            'nameFR.required' =>  __('lang.ValidSecFR'),
        ]
    );
    
        $section= Section::findorFail($id);
        $section->update([
            'nameAR'=>$request->nameAR,
            'nameEN'=>$request->nameEN,
            'nameFR'=>$request->nameFR,
        ]);

        if(!$section){
            return redirect(route('section.edit',$id))->with("error"," error");
        }
        else
        {
        return redirect(route('section.edit',$id))->with("success",__('lang.saved'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        if (Auth::guard('web')->user()->role != 1){
            return redirect(route('home'));
        }
        $section= section::findorFail($id)->delete();
        if(!$section){
            return redirect(route('section.index'))->with("error"," error");
        }
        else
        {
        return redirect(route('section.index'))->with("success",__('lang.deleted'));
        }

    }
}
