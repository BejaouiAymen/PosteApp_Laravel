<?php
namespace App\Helpers;

use App\User;
use App\Message;
use App\Profile;
use Illuminate\Support\Facades\DB;

class Apphelper
{
	public function usernumber()
	{
		$users=Profile::get();
		$number=sizeof($users);
		return $number;
	}
	
	public function ContactedUser()
	{
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
		
		return $distinctCaracters;
	}
	
      public function lastMessage()
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
            })
			->where(function ($query2) {
                $query2->where('received_id','=',auth()->user()->id)
		           	->orWhere('user_id','=',auth()->user()->id);
            })		           
					->orderBy('created_at', 'DESC')
					->first();				
		}
             return $var;
      }
	 public static function instance()
	     {
	         return new AppHelper();
	     }
    
}