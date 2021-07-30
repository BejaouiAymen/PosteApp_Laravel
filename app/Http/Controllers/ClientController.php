<?php

namespace App\Http\Controllers;

use App\Oldclient;
use App\Client;
use App\Hotel;
use App\Clinique;
use App\Chirurgien;
use App\Specialite;
use App\Mail\ClientMessages;
use Mail;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function __construct()
    {
        $this->middleware('auth',['except' =>['client_info']]);
    }
	
    public function index()
    {
        //
        $titre="";
		$i=0;
        $newclient=Oldclient::get();
		$completeclient=Client::get();
		if(!$newclient->isEmpty()){
			foreach ($newclient as $clients) {
				$i++;
				if($completeclient){    
				foreach ($completeclient as $finishedclient) {
					if($clients->id!=$finishedclient->id){
						$list[$i]=$clients;
					}
				}
			}		
				if($completeclient->isEmpty()) {
				$list[]=$clients;
				}
			}			
			return view("clients.index",compact("list","titre"));
		}
		else{
			$titre="Aucun Client Pour le traiter!!";
			return view("clients.index",compact("titre"));
		}
			
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $chirurgiens=Chirurgien::get();
		$i=0;
		foreach ($chirurgiens as $chirurgien) {
			foreach($chirurgien->specialites as $k){
					$i++;
				$specialites[$i]=[$k->specialite,$k->pivot->chirurgien_id];		
			}
		}		return view("clients.chirurgien",compact("chirurgiens","specialites"));
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
     * @param  \App\Oldclient  $oldclient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $hotels=Hotel::get();
        $client=Oldclient::find($id);
		return view("clients.hotel_list",compact("hotels","id","client"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Oldclient  $oldclient
     * @return \Illuminate\Http\Response
     */
    public function edit(Oldclient $oldclient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Oldclient  $oldclient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Oldclient $oldclient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Oldclient  $oldclient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Oldclient $oldclient)
    {
        //
    }
	public function done_clients()
	{
		$clients=Client::get();
		$i=0;
		foreach ($clients as $client) {
			foreach($client->chirurgiens as $k){
					$i++;
				$chirurgiens[$i]=[$k,$k->pivot->client_id];		
			}
		}	
			return view("clients.final_clients",compact("clients","chirurgiens"));
	}
	
	public function next_show($id,Request $request)
	{
		//return $request->optradio;
		$cliniques=Clinique::get();
		return view("clients.clinique_list",compact("cliniques","hotel","id"));	
			
	}
	public function save(Request $request,$id)
	{
        $client=Oldclient::find($id);
		$completeclient=new Client;
		
		$completeclient->id=$client->id;
		$completeclient->nom_prenom=$client->nom_prenom;
		$completeclient->description=$client->description;
		$completeclient->pays=$client->pays;
		$completeclient->email=$client->email;
		$completeclient->telephone=$client->telephone;
		$completeclient->URL=$client->URL;
    	$completeclient->hotel_id=request('hotel');
    	$completeclient->clinique_id=request('optradioCli');
		Mail::to($client->email)->send(
			new ClientMessages($completeclient)
		);
		$completeclient->save();
		Oldclient::find($id)->delete();
		return redirect("/clien/list");
	}
	
	public function client_info($id)
	{
		$client=Client::find($id);
		return view("emails.Clientview",compact("client"));
	}
	
	 public function destroye($id)
    {
        Oldclient::find($id)->delete();

		return redirect('/client');	  	
		
    }
	
	public function add_chirurgien($id)
    {
        //
        $chirurgiens=Chirurgien::get();
		$i=0;
		foreach ($chirurgiens as $chirurgien) {
			foreach($chirurgien->specialites as $k){
					$i++;
				$specialites[$i]=[$k->specialite,$k->pivot->chirurgien_id];		
			}
		}		return view("clients.chirurgien",compact("chirurgiens","specialites","id"));
    }
	
	public function save_chirurgien($id)
    {
        //
       	$client=Client::find($id);
		$chirurgien=request('ids');
		$client->chirurgiens()->sync($chirurgien,'false');
		return redirect('/client');
			
	}
	
	
	
}