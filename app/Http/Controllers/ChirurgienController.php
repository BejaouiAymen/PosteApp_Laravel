<?php

namespace App\Http\Controllers;

use App\Chirurgien;
use App\Specialite;
use App\User;
use App\Profile;
use App\Notifications\NewActionMade;

use Illuminate\Http\Request;

class ChirurgienController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('admin',['only' =>['show','destroye','specialite','teammember']]);
		
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
    	
		
    	//return view("Queuee.backQueue");
		$specialites=Specialite::get();
		if($specialites->isEmpty()){
			return redirect("/specialite");
		}
		if(auth()->user()->id==1){
			$j=0;
			$chirurgiens=Chirurgien::get();
			foreach ($chirurgiens as $chirurgien) {
				$j++;
				$chirur[$j]=[$chirurgien->id, $chirurgien->fullname,$chirurgien->URL,$chirurgien->telephone,$chirurgien->age];
			
				$i=0;
								$specialit[$j][$i]=$chirurgien->id;		
				
				foreach($chirurgien->specialites as $k){
					$i++;
				$specialit[$j][$i]=$k->specialite;		
				}
				$specialit[$j][-1]=$i;		
			}
			//return $i;
			//return $specialit[1][1];			
			//return $chirur[1][3];
			return view("chirurgiens.admin_chirurgien",compact("chirur","specialit"));
		}
		else{
			
		
		
    	$chirurgien=Chirurgien::find(auth()->user()->id);
		//return $chirurgiens;
		
		/*foreach ($chirurgiens as $chirurgien) {
			foreach ($chirurgien->specialites as $m ) {
			$i++;
				if($m)
				 $test[$i] = $m->pivot;
				else {
					$test[$i]=null;
				}		
			}
		}
		*/
		$i=0;
		
		if(!$chirurgien){
			return "Wait for the admin!";
		}
			foreach($chirurgien->specialites as $k){
					$i++;
				$specialites[$i]=[$k->specialite,$k->pivot->chirurgien_id];		
			}
					//return ($specialites);
			
		//return ($int);
		$id=auth()->user()->id;
		return view("chirurgiens.index_chirurgien",compact('chirurgien','specialites',"id"));
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$specialites=Specialite::get();
		if($specialites->isEmpty()){
			return redirect("/specialite");
		}
		return view("chirurgiens.ajouter_chirurgien",compact("specialites"));     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	 $chirurgien=new Chirurgien();
		
		$chirur=Chirurgien::get();
		foreach ($chirur as $k) {
			if($k->id==request('id')){
				$x=request('id');
				return redirect("chirurgien/$x");
			}
		}
		$this->validate(
		$request,[
		'nom'=>['required','min:3'],
		'age'=>['required','min:1'],
		'telephone'=>['required','min:6'],
		'image'=>['required','min:10']
		
		]
		);
		$chirurgien->id=request('id');
		$chirurgien->fullname=request('nom');
		$chirurgien->age=request('age');
		$chirurgien->telephone=request('telephone');
		$chirurgien->URL=request('image');
				
		$chirurgien->save();
		$spec=request('ids');
		$chirurgien->specialites()->sync($spec,'false');
		
		
		
		return redirect('/chirurgien');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chirurgien  $chirurgien
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chirurgien=Chirurgien::find($id);
		$specialites=Specialite::get();
    	foreach($chirurgien->specialites as $specials){
    		$specialite[]=$specials->id;	
    	}
		//return ($chirurgien);
    	return view("chirurgiens.modifier_chirurgien",compact('chirurgien','specialite','specialites'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chirurgien  $chirurgien
     * @return \Illuminate\Http\Response
     */
    public function edit(Chirurgien $chirurgien)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chirurgien  $chirurgien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $chirurgien=Chirurgien::find($id);
		
	
		$this->validate(
		$request,[
		'nom'=>['required','min:3'],
		'age'=>['required','min:1'],
		'telephone'=>['required','min:8'],
		'image'=>['required','min:10']
		
		]
		);
		
		$chirurgien->fullname=request('nom');
		$chirurgien->age=request('age');
		$chirurgien->telephone=request('telephone');
		$chirurgien->URL=request('image');

		
		$chirurgien->save();
		$spec=request('ids');
		$chirurgien->specialites()->sync($spec,'false');
		
		
		
		return redirect("/chirurgien");
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chirurgien  $chirurgien
     * @return \Illuminate\Http\Response
     */
    public function destroye($id)
    {
        //
        Chirurgien::find($id)->delete();
		$user=auth()->user();
		//variable pour les notifications...
		$action="a Supprimer un Chirurgien";
		$link="/chirurgien";
		$type="suppression";
		
		$users = User::all();
		
		\Notification::send($users, new NewActionMade($action,$user,$link,$type));
		
		return redirect('/chirurgien');	  	
		
    }
	
	public function specialite()
	{
		$k="";
    	 $specialites=Specialite::get();
		 if($specialites->isEmpty()){
		 	$k="vous n avez aucune specialite a selectionner...veuiller ajouter des uns";
		 }
		return view("chirurgiens.specialite",compact('specialites','k'));
		
	}
	public function specialite_save(Request $request)
	{
		 $specialite=new Specialite();
		
	
		$this->validate(
		$request,[
		'specialite'=>['required','min:3']
		]);
		$specialite->compteur=0;
		$specialite->specialite=request('specialite');
		$specialite->save();
		
		return redirect('/specialite');
    
		
	}
	
	public function teammember($id)
	{
		$profile=Profile::get()->where('user_id',$id)->first();
		$specialites=Specialite::get();
		return view("chirurgiens.ajouter_chirurgien",compact("profile","specialites","id"));
	}
	
}
