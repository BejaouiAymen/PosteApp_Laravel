<?php

namespace App\Http\Controllers;

use App\Guichet;
use Illuminate\Http\Request;

class GuichetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function __construct()
    {
        $this->middleware('auth');
				
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $guichet=Guichet::find(auth()->user()->id);
		if($guichet){
		return redirect("/console_d_appel");
		}
		$guichet=Guichet::get();
      return view('guichet.guichet_create',compact("guichet"));
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
        
         $guichet=new Guichet();
        $guichet->id=auth()->user()->id;
		$guichet->user_id=request('guichet');
		$guichet->save();
		return redirect("/console_d_appel");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guichet  $guichet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $guichet=Guichet::find($id);
		if(!$guichet){
			return redirect("/guichet");
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guichet  $guichet
     * @return \Illuminate\Http\Response
     */
    public function edit(Guichet $guichet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Guichet  $guichet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guichet $guichet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guichet  $guichet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $res=User::where('id',$id)->delete();
        return redirect("/guichet/create");
    }
}
