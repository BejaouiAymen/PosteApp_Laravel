<?php

namespace App\Http\Controllers;

use App\Clinique;
use App\User;
use Illuminate\Http\Request;
use App\Notifications\NewActionMade;

class CliniqueController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinique =Clinique::simplePaginate(6);
 
        return view('cliniques.list_clinique', compact('clinique'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("cliniques.ajout_clinique");
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
        $clinique=new Clinique();
		
	
			$this->validate(
		$request,[
		'titre'=>['required','min:3'],
		'description'=>['required','min:3'],
		'prix'=>['required','min:1'],
		'year'=>['required','min:4'],
		'image'=>['required','min:10']
		
		]
		);
		
		$clinique->titre=request('titre');
		$clinique->description=request('description');
		$clinique->prix=request('prix');
		$clinique->year=request('year');
		$clinique->URL=request('image');

		$clinique->save();
		$user=auth()->user();
		//variable pour les notifications...
		$action="a ajouter un clinique";
		$link="clinique/$clinique->id";
		$type="ajout";
		
		$users = User::all();
		
		\Notification::send($users, new NewActionMade($action,$user,$link,$type));
		
		return redirect("/clinique");        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clinique  $clinique
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $clinique=Clinique::find($id);
		if($clinique)
		return view('cliniques.supprimer_clinique',compact('clinique'));   
		else {
			return redirect("/clinique");
		}    
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clinique  $clinique
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$clinique=Clinique::find($id);
		
		return view('cliniques.modify_clinique',compact('clinique'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clinique  $clinique
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $clinique=Clinique::find($id);
		
		$clinique->titre=request('titre');
		$clinique->description=request('description');
		$clinique->prix=request('prix');
		$clinique->year=request('year');
		$clinique->URL=request('image');

		$clinique->save();
		$user=auth()->user();
		//variable pour les notifications...
		$action="a Modifier un clinique";
		$link="/clinique/$clinique->id";
		$type="modification";
		
		$users = User::all();
		
		\Notification::send($users, new NewActionMade($action,$user,$link,$type));

		
		return redirect('/clinique');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clinique  $clinique
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Clinique::find($id)->delete();
	
		$user=auth()->user();
		//variable pour les notifications...
		$action="a Supprimer un clinique";
		$link="/clinique";
		$type="suppression";
		
		$users = User::all();
		
		\Notification::send($users, new NewActionMade($action,$user,$link,$type));

			
		return redirect('/clinique');	
    }
	
	 public function index_list()
    {
      	$op0="";
      	$op1="";
      	$op2="";
      	$op3="";
      	$op4="";
  				$titre="Mode De Recherche Par Defaut";
  
       $clinique =Clinique::get();
        return view('cliniques.all_clinique', compact('clinique','op0','op1','op2','op3','op4','titre'));
    }
	public function index_list_req(Request $request)
    {
    	$op0="";
      	$op1="";
      	$op2="";
      	$op3="";
      	$op4="";
  
    	$liste = $request->input('liste');
		if($liste==3){
      	$op3="selected";  
       $clinique =Clinique::latest()->get();
		}
		if($liste==1){ 
			$clinique = Clinique::orderBy('prix', 'DESC')->get();
		   	$op1="selected";
		}
		if($liste==2){
      		$op2="selected";
			$clinique = Clinique::orderBy('prix', 'ASC')->get();
		}
		if($liste==4){
      		$op4="selected";  
			$clinique = Clinique::orderBy('titre', 'ASC')->get();
		}
		if($liste==0){
      		$op0="selected";  
			$clinique = Clinique::get();
		}
		switch ($liste) {
		    case 0:
				$titre="Mode De Recherche Par Defaut";
		        break;
		    case 1:
				$titre="Mode De Recherche Par Prix Decroissant";
		        break;
		    case 2:
				$titre="Mode De Recherche Par Prix Croissant";
		        break;
			case 3:
				$titre="Mode De Recherche Par Date";
		        break;
		    case 4:
				$titre="Mode De Recherche Par Titre";
		        break;
		    default:
				$titre="erruer";
}
        return view('cliniques.all_clinique', compact('clinique','op0','op1','op2','op3','op4','titre'));
		

    }
	
}
