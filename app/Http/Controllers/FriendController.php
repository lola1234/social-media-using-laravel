<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Notifications\NewFriendRequest;
use App\Notifications\FriendRequestAccepted;

class FriendController extends Controller
{
    public function check($id)
	{		
		if(Auth::user()->isFriendsWith($id) === 1){
			return ["status"  => "friends"];
		}
		
		if(Auth::user()->hasPendingFriendRequestFrom($id) === 1){
			return ["status"  => "pending"];
		}
		
		if(Auth::user()->hasPendingFriendRequestSentTo($id) === 1){
			return ["status"  => "waiting"];
		}
		return ["status" => 0];
		
	}
	
	public function addFriend($id){
		$resp = Auth::user()->addFriend($id);
		User::find($id)->notify(new NewFriendRequest(Auth::user()));		
		return $resp;
	}
	
	public function acceptFriend($id){
		$resp= Auth::user()->acceptFriend($id);
		User::find($id)->notify(new FriendRequestAccepted(Auth::user()));	
		return $resp;
	}
}
