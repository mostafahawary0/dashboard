<?php

namespace App\Http\Controllers;

use App\Models\news;
use App\Models\Section;
use App\Models\permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_news($id)
    {

    $uuid = Auth::user()->role;  
    $permissions = permissions::where('uuid', $uuid)
        ->where('section_id', $id)  
        ->exists();  
 
    if ($permissions) {
       
        $sections = Section::where('id' , $id)->first();
        return view('dashboard.news.create',compact('sections'));
    } 
    elseif($uuid == 1)
     {
        $sections = Section::where('id' , $id)->first();
        return view('dashboard.news.create',compact('sections'));
     }
    else
     {
         return redirect()->route('home');  
     }
        
    }

    public function news($id)
    {

        $uuid = Auth::user()->role;  
        $permissions = permissions::where('uuid', $uuid)
            ->where('section_id', $id)  
            ->exists();  
     
        if ($permissions) {
           
            $sections = Section::where('id' , $id)->first();
            $news = news::where('section_id' , $id)->orderBy('id', 'desc')->paginate(10);
            return view('dashboard.news.index',compact('sections','news'));
        } 
        elseif($uuid == 1)
         {
            $sections = Section::where('id' , $id)->first();
            $news = news::where('section_id' , $id)->orderBy('id', 'desc')->paginate(10);
            return view('dashboard.news.index',compact('sections','news'));
         }
        else
         {
             return redirect()->route('home');  
         }

       
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $news = news::where('title', 'LIKE', "%{$query}%")->get();

        return response()->json($news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
             'img' => 'required|mimes:jpg,png,jpeg,gif,svg,bmp',
        ],
        [
            'title.required' => __('lang.ValidTitle'),
            'content.required' =>  __('lang.ValidContnent'),
            'img.required' =>  __('lang.ValidImg'),
            'img.mimes' => 'The image field must be an image.',
        ]
    );

    $image= $request->file('img')->getClientOriginalName();
    $path = $request->file('img')->store('news','imgs');

    $section= news::create([
        'section_id'=>$request->section,
        'user_id'=>$request->user,
        'title'=>$request->title,
        'content'=>$request->content,
        'image'=>$path ,
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
     * Display the specified resource.
     *
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function show(news $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        
        $sections= news::findorFail($id);
        return view('dashboard.news.edit',compact('sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ],
        [
            'title.required' => __('lang.ValidTitle'),
            'content.required' =>  __('lang.ValidContnent'),
        ]
    );
    
   
    $news = news::findOrFail($id);

    $news->title = $request->input('title');
    $news->content = $request->input('content');

    if ($request->hasFile('img')) {
        $path = $request->file('img')->store('news', 'imgs');
        $news->image = $path;
    }

    $news->save();

    return back()->with("success",__('lang.saved'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $uuid = Auth::user()->role;  
        $permissions = permissions::where('uuid', $uuid)
            ->where('section_id', $id)  
            ->exists();  
     
        if ($permissions) {
           
            $section= news::findorFail($id)->delete();
        if(!$section){
            return back()->with("error"," error");
        }
        else
        {
            return back()->with("success",__('lang.deleted'));
        }
        } 
        elseif($uuid == 1)
         {
            $section= news::findorFail($id)->delete();
        if(!$section){
            return back()->with("error"," error");
        }
        else
        {
            return back()->with("success",__('lang.deleted'));
        }
         }
        else
         {
             return redirect()->route('home');  
         }

       
    }
}
