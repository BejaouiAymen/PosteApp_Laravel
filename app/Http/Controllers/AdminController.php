<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use App\Client;
use App\Reunion;
use App\Rappel;
use App\Pause;
use App\Stat;
use App\Printerr;
use App\Message;
use App\Chirurgien;
use App\Guichet;
use App\Specialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;use Carbon\Carbon;


class AdminController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth',['except' =>['print_aff','print_values']]);
		$this->middleware('admin',['only' =>['destroy','user_list']]);
		
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	 $admin =Profile::get();
		 $chirurgien=Chirurgien::get();
      return view('admins.team',compact('admin','chirurgien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	
		
			$profile=User::find(auth()->user()->id)->profile;
			$k=auth()->user()->id;
			if($profile==null){
		   		return view('admins.ajout_admin');
			}else{
					return redirect("/admin/$k");
			}
	    
	}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin=new Profile();
		$message=new Message();
		$message->user_id=auth()->user()->id;
		$message->received_id=1;
		$message->body="Bonjour j'ai cree mon profile cbon et je vais vous imforme puisque vous etes notre Chef";
		$message->save();
			$this->validate(
		$request,[
		'nom'=>['required','min:3'],
		'smalldescription'=>['required','min:3'],
		'age'=>['required','min:1'],
		'prenom'=>['required','min:4'],
		'sexe'=>['required','min:10'],	
		'email'=>['required','min:10'],					
		'telephone'=>['required','min:7'],					
		'fulldescription'=>['required','min:3']
				
		]
		);
		
		$admin->nom=request('nom');
		$admin->smalldescription=request('smalldescription');
		$admin->fulldescription=request('fulldescription');
		$admin->age=request('age');
		$admin->prenom=request('prenom');
		$admin->URL=request('sexe');
		$admin->email=request('email');
		$admin->telephone=request('telephone');
		$admin->user_id=request('id');
		
		$messag=new Message;
		$messag->recieved_id=auth()->user()->id;
		$x= $admin->prenom.' '.$admin->nom;
		auth()->user()->name=$x;
		auth()->user()->email=$admin->email;
		$admin->save();
		return redirect('/console_d_appel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	if(auth()->user()->id==1){
    		$profile=User::find($id)->profile;
			if($profile==null){
		   		return view('admins.ajout_admin',compact("id"));
			}else{
				return view('admins.affiche_profile',compact('profile'));   
			}
    	}else{
		$profile=User::find(auth()->user()->id)->profile;
		return view('admins.affiche_profile',compact('profile'));   
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
       
		$admin=User::find(auth()->user()->id)->profile;
		
		return view('admins.user_edit',compact('admin'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
      	$admin=Profile::find($id);
		
	  	$admin->nom=request('nom');
		$admin->smalldescription=request('smalldescription');
		$admin->fulldescription=request('fulldescription');
		$admin->age=request('age');
		$admin->prenom=request('prenom');
		$admin->URL=request('image');
		$admin->email=request('email');
		$currentUser=User::find(auth()->user()->id);
		$currentUser->name=$admin->nom." ".$admin->prenom;
		//$currentUser->email=$admin->email;
		$currentUser->save();
		$admin->save();
		return redirect('/admin');	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        User::find($id)->delete();
        return redirect("/administrateur/userlist");
    }
	
	public function message_index($id)
	{
		//les couples (receiver_id and sender_id) qui ont envoyer ou recu un message pour le logged_in user/utilisateur..
		$messages= DB::table('messages')
			->select('received_id as received_id', 'user_id as user_id')
			->distinct()
			->where('user_id', '=', auth()->user()->id)
    		->orWhere('received_id', '=', auth()->user()->id)
    		->get(); 
			
			//la list des personnes qui ont a envoyer ou recevoir un message en interaction avec cette utilisatuer	
			$i=0;
			foreach ($messages as $msg) {
				$i++;
				if($msg->received_id!=auth()->user()->id){
					$caracter[$i]=User::where('id',$msg->received_id )
					->get();	
				}
				if($msg->user_id!=auth()->user()->id){
					$caracter[$i]=User::where('id',$msg->user_id )
					->get();	
				}				
			}
		//supprimer les repetitions et refaire les indexe du elements du tableau parceque la suppression des elements a laiser des gaps..
		$distinctCaracters= array_values(array_unique($caracter));
		
		for ($i=0; $i < count($distinctCaracters); $i++) { 
			$users=array_values($distinctCaracters);

			 //la requette qui determine le dernier message envoyer ou recu pour this utilisateur et les autres utilisateur qui l'ont contacter
			 //resultat du cette requette dans un tableau ($var)
			$var[$i]= Message::
			 where(function ($query) use ($users,$i) {
                $query->where('received_id','=',$users[$i]->first()->id)
		           	->orWhere('user_id','=',$users[$i]->first()->id);
            })
			->where(function ($query2) {
                $query2->where('received_id','=',auth()->user()->id)
		           	->orWhere('user_id','=',auth()->user()->id);
            })		           
					->orderBy('created_at', 'DESC')
					->first();				
		}
		//la partie des messages inbox a terminer...
		
		//la 2eme partie des messages du selected user
		$requette= Message::
			 where(function ($query) use ($id) {
                $query->where('received_id','=',$id)
		           	->orWhere('user_id','=',$id);
            })
			->where(function ($query2) {
                $query2->where('received_id','=',auth()->user()->id)
		           	->orWhere('user_id','=',auth()->user()->id);
            })		           
					->orderBy('created_at', 'asc')
					->get();	
		
		
		
		//la 2eme partie est terminer!
		//return ($requette);  
			return view('admins.message',compact('distinctCaracters','var','requette','id'));		
	}
	
	public function send_message(Request $request, $id)
	{
		$message=new Message();
		$message->user_id=auth()->user()->id;
		$message->received_id=$id;
		$message->body=request('body');
		$message->save();
		
		return redirect("/messages/$id");	
		
	}
	public function user_list()
	{
		$users=User::get();
		return view("admins.user_list",compact("users"));
	}
	public function affichage(){
		
		$task=Specialite::get();
		
		$count=Client::count();
		return view("Queuee.queue",compact("task","count"));
	}
		public function affichage_admins(){
		
		$chirurgien=Chirurgien::find(auth()->user()->id);
		$tasks=Specialite::get();
		$date= Carbon::now()->format('l');
		if(!$tasks->first()){
			return redirect("/specialite");
		}
		$date1= $tasks->first()->updated_at->format('l');
		if($date!=$date1){
			
			
			
			
			Specialite::query()->update(['compteur' => 0]);
			Client::query()->delete();
			$tasks=Specialite::get();
			
		}
		$i=0;
		foreach ($tasks as $k) {
			Client::where('task_id','=',$k->id)->where('first','<=',$k->compteur)->delete();	
		}
		if(!$chirurgien){
			return redirect('/admin/create');
		}
		$k1=$chirurgien->specialites;
		foreach ($k1 as $x) {
			$array[$i]=$x->id;
			$i++;
			
		}
		$client=Client::whereIn('task_id',$array )->orderBy("created_at")->get();
		
	
		return view("Queuee.backQueue",compact("tasks","k1","client"));
	}
	
	public function update_affichage(){
		/*$task=Specialite::get();
		$i=1;
		foreach ($task as $k) {
			if(request("tache$i")){
			$k->compteur=request("tache$i");
			$k->save();}
			$i++;
		}
		*/
		$chirurgien=Chirurgien::find(auth()->user()->id);
		$i=0;
		foreach ($chirurgien->specialites as $k) {
			$x=Client::where('task_id','=',$k->id )->orderBy("created_at")->first();
			if($x){
			$client[$i]=$x;
			$i++;
			}
		}
		//return $client;
		$min=$client[0];
		for ($j=0; $j < sizeof($client); $j++) { 
			if($client[$j]->created_at < $min->created_at){
				$min=$client[$j];
			}
		}
		//return $min;
		//$client=Client::orderBy("created_at")->first();
		$stat=Stat::where('user_id','=',auth()->user()->id)->whereDate('created_at', Carbon::today())->first();
		if(!$stat){
			$stat=new Stat();
			$stat->user_id=auth()->user()->id;
			$guicht=Guichet::find(auth()->user()->id);
			$stat->guichet_id=$guicht->user_id;
			$stat->compteur=1;
			$stat->save();
		}else{
			$stat->compteur=$stat->compteur+1;
			$stat->save();
					}
		$task=Specialite::find($min->task_id);
		$task->compteur=$task->compteur+1;
		$task->save();
	
		return redirect("/console_d_appel/");
		
	}
	
public function print_aff()
{
	$print=Printerr::find(1);
	if($print){
		
	}else{
		$print=new Printerr();		
	  	$print->URL="https://mespetitspackagings.com/4738-large_default/livre-d-or-en-kraft-personnalise-logo-entreprise.jpg";
		$print->text="Bienvenu Chez Nous";
		$print->couleur="#ff6200";
		
		$print->save();
	}
	$task=Specialite::get();
	
	return view("Queuee.print_aff",compact("task","print"));
}


public function update_test($id){

	$x=Client::count();
	$y=Rappel::count();
	$guichet=Guichet::find(auth()->user()->id);
	$data[1]=$x;
	if($y!=0){
		$client=Client::find(Rappel::first()->id);
		$data[0]=Specialite::find($client->task_id);
		$data[1]=$x;
		$data[2]=$guichet;
		Rappel::truncate();
		return response()->json($data);
	}
	
	if($id>$x){
		$chirurgien=Chirurgien::find(auth()->user()->id);
		$i=0;
		$k1=$chirurgien->specialites;
		foreach ($k1 as $x) {
			$array[$i]=$x->id;
			$i++;
			
		}
		//$client=Client::orderby('created_at')->first();
		$client=Client::whereIn('task_id',$array )->orderBy("created_at")->first();
		
		$data[0]=Specialite::find($client->task_id);
		$data[2]=$guichet;
		
	    return response()->json($data);
	}
	else{
		return false;
	}
}

public function print_values()
{
	$msg=request('text');
	$number=Client::where('task_id','=',$msg)->count();
	if($number==0){
		$number=Specialite::find($msg);
		$number=$number->compteur;		
	}else{
		$number=Client::where('task_id','=',$msg)->latest()->first();
		$number=$number->first;		
		
	}
	$client=new Client();
	
	$client->first=$number+1;
	$client->task_id=$msg;
	$client->second=0;
	$client->third=0;
	$client->save();
	$task=Specialite::find($msg);
	$num=Client::where('task_id','=',$msg)->count();
	$num=$num-1;
	$print=Printerr::find(1);
	
	return view("Queuee.print_values",compact("client","task","num","print"));
}

public function client($id)
{
	$specialites=Specialite::get();
	return view("Queuee.Transferer",compact("specialites","id"));
}
public function client_update($id)
{
	$client=Client::find($id);
	$client->task_id=request('ids')[0];
	$client->save();
	return redirect("/console_d_appel");
	
}
public function client_rappel($id)
{
	$rappel=new Rappel;
	$rappel->id=$id;
	$rappel->save();
	return redirect("/console_d_appel");
	
}
public function reunion($id)
{
	$reunion=Reunion::find(auth()->user()->id);
	if($reunion){
		$reunion->reunion=$reunion->reunion +$id;
		$reunion->save();
	}
	else {
		$reunion=new Reunion;
		$reunion->id=auth()->user()->id;
		$reunion->reunion=$id;
		$reunion->save();
	}
	
	return redirect("/console_d_appel");	
}
public function pause($id)
{
	$reunion=Pause::find(auth()->user()->id);
	if($reunion){
		$reunion->reunion=$reunion->reunion +$id;
		$reunion->save();
	}
	else {
		$reunion=new Pause;
		$reunion->id=auth()->user()->id;
		$reunion->reunion=$id;
		$reunion->save();
	}
	
	return redirect("/console_d_appel");	
}

public function stats()
{
	$task=Specialite::get();
	return view("Queuee.Stat",compact("task"));
	
}

public function Todaystats(){
	$stat=Stat::whereDate('created_at', Carbon::today())->get();
	return $stat;
}
public function Everstats(){
	$stat=Stat::groupBy('user_id')
	   ->selectRaw('sum(compteur) as sum, user_id')
	   ->pluck('sum','user_id');
	   
	   $profile=Profile::select('id','nom','prenom')->get();
		
		return view("Queuee.stat_ever",compact("profile","stat"));
	
}

public function print_edit(){
	return view("Queuee.print_edit");
}

public function print_edit_update(){
	
	$print=Printerr::find(1);
	if($print){
		$print->URL=request('URL');
		$print->text=request('text');
		$print->couleur=request('couleur');
		$print->save();
	}else{
		$print=new Printerr();		
	  	$print->URL=request('URL');
		$print->text=request('text');
		$print->couleur=request('couleur');
		
		$print->save();
	}
		return redirect("/console_d_appel");	
		
}
public function logoutt(){
	Guichet::find(auth()->user()->id)->delete();
	auth()->logout();
	return redirect("/guichet/create");	
}
public function add_user(Request $request){
			$newadmin=new User;
			$newadmin->name=request('name');
			$newadmin->email=request('email');
			$newadmin->password=bcrypt(request('password'));
			
			$newadmin->save();
			return redirect("/admin/$newadmin->id");
			
}

}

