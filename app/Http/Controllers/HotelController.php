<?php

namespace App\Http\Controllers;
use DB;
use App\Hotel;
use App\User;
use Illuminate\Http\Request;
use App\Notifications\NewActionMade;


class HotelController extends Controller
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
       $hotel =Hotel::simplePaginate(6);
 
        return view('hotel.Hotel', compact('hotel'));

    }
	
	public function index_advanced()
	{
		 $hotel =Hotel::get();
 
        return view('hotel.advanced_recherche_hotel', compact('hotel'));
		
	}
	  public function index_list()
    {
      	$op0="";
      	$op1="";
      	$op2="";
      	$op3="";
      	$op4="";
  				$titre="Mode De Recherche Par Defaut";
  
       $hotel =Hotel::get();
 		$type="modification";
        return view('hotel.hotel_liste', compact('hotel','op0','op1','op2','op3','op4','titre','type'));
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
       $hotel =Hotel::latest()->get();
		}
		if($liste==1){ 
			$hotel = Hotel::orderBy('prix', 'DESC')->get();
		   	$op1="selected";
		}
		if($liste==2){
      		$op2="selected";
			$hotel = Hotel::orderBy('prix', 'ASC')->get();
		}
		if($liste==4){
      		$op4="selected";  
			$hotel = Hotel::orderBy('titre', 'ASC')->get();
		}
		if($liste==0){
      		$op0="selected";  
			$hotel = Hotel::get();
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
		$type="modification";
        return view('hotel.hotel_liste', compact('hotel','op0','op1','op2','op3','op4','titre','type'));
		

    }
	
	public function index_list_delete(Request $request)
	{
		$op0="";
      	$op1="";
      	$op2="";
      	$op3="";
      	$op4="";
  
    	$liste = $request->input('liste');
		if($liste==3){
      	$op3="selected";  
       $hotel =Hotel::latest()->get();
		}
		if($liste==1){ 
			$hotel = Hotel::orderBy('prix', 'DESC')->get();
		   	$op1="selected";
		}
		if($liste==2){
      		$op2="selected";
			$hotel = Hotel::orderBy('prix', 'ASC')->get();
		}
		if($liste==4){
      		$op4="selected";  
			$hotel = Hotel::orderBy('titre', 'ASC')->get();
		}
		if($liste==0){
      		$op0="selected";  
			$hotel = Hotel::get();
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
		$type="delete";
        return view('hotel.hotel_liste', compact('hotel','op0','op1','op2','op3','op4','titre','type'));
		
				
	}
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view('hotel.ajout_hotel');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $hotel=new Hotel();
		
	
			$this->validate(
		$request,[
		'titre'=>['required','min:3'],
		'description'=>['required','min:3'],
		'prix'=>['required','min:1'],
		'year'=>['required','min:4'],
		'image'=>['required','min:10']
		
		]
		);
		
		$hotel->titre=request('titre');
		$hotel->description=request('description');
		$hotel->prix=request('prix');
		$hotel->year=request('year');
		$hotel->URL=request('image');

		$hotel->save();
		$user=auth()->user();
		//variable pour les notifications...
		$action="a ajouter un hotel";
		$link="hotel/$hotel->id";
		$type="ajout";
		
		$users = User::all();
		
		\Notification::send($users, new NewActionMade($action,$user,$link,$type));

		
		//$user->notify(new NewActionMade($action,$user,$link));
		return redirect('/hotel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$hotel=Hotel::find($id);
		if($hotel)
		return view('hotel.delete_hotel',compact('hotel'));   
		else {
			return redirect("/hotel");
		}    

	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

		$hotel=Hotel::find($id);
		

		return view('hotel.hotel_edit',compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      	$hotel=Hotel::find($id);
		
		$hotel->titre=request('titre');
		$hotel->description=request('description');
		$hotel->prix=request('prix');
		$hotel->year=request('year');
		$hotel->URL=request('image');

		$hotel->save();
		$user=auth()->user();
		//variable pour les notifications...
		$action="a Modifier un hotel";
		$link="/hotel/$hotel->id";
		$type="modification";
		
		$users = User::all();
		
		\Notification::send($users, new NewActionMade($action,$user,$link,$type));

		
		return redirect('/hotel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$users0 = User::all();
		foreach($users0 as $user){
	    	foreach ($user->notifications as $notification) {
				if($notification->data["link"]=="hotel/$id"){
					$user->notifications()->find($notification->id)->delete();
				}
			}
		}
        Hotel::find($id)->delete();
	
		$user=auth()->user();
		//variable pour les notifications...
		$action="a Supprimer un hotel";
		$link="/hotel";
		$type="suppression";
		
		$users = User::all();
		
		\Notification::send($users, new NewActionMade($action,$user,$link,$type));

			
		return redirect('/list_adv');	  	
    
    }
	
	public function read($id)
	{
		$date=date('Y-m-d H:i:s');
		$notification=DB::table('notifications')->where('id', '=', $id)->get();
		DB::table('notifications')
            ->where('id', $id)
            ->update(['read_at' => $date]);	
			
 $data = json_decode($notification->first()->data, true); 
		$k= $data['link'];
		return redirect($k);

	}
	public function notif_list()
	{
		return view('hotel.notification_list');
	}
	
}
