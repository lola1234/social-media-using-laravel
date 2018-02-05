<?php

namespace App\Traits;
use App\Friend;

trait Friendable
{
	public function addFriend($userRequestedId){
		
		if($this->id === $userRequestedId){
			return 0;
		}
		
		if($this->isFriendsWith($userRequestedId)){
			return "already friends";
		}
		
		if($this->hasPendingFriendRequestSentTo($userRequestedId) === 1){
			return "Friend request already sent";
		}
		
		if($this->hasPendingFriendRequestFrom($userRequestedId) == 1){
			return $this->acceptFriend($userRequestedId);
		}
		
		$friends = Friend::create([
			'requester' =>$this->id,
			'user_requested' => $userRequestedId
		]);
		
		if($friends){
			return 1;
		}
		return 0;
	}
	
	public function acceptFriend($requester){
		if($this->hasPendingFriendRequestFrom($requester) === 0){
			return 0;
		}
		
		$friends = Friend::where('requester',$requester)
						->where('user_requested',$this->id)
						->first();
		
		if($friends){
			$friends->update([
				'status' => 1
			]);			
			return 1;
		}
		return 0;		
	}
	
	public function friends(){
		$friends = array();
		$f1 = Friend::where('status',1)
					->where('requester', $this->id)
					->get();
					
		foreach($f1 as $friendship):
			array_push($friends, \App\User::find($friendship->user_requested));
		endforeach;
		
		$friends2 = array();
		$f2 = Friend::where('status',1)
					->where('user_requested', $this->id)
					->get();
		
		foreach($f2 as $friendship):
			array_push($friends2, \App\User::find($friendship->requester));
		endforeach;
		
		return array_merge($friends,$friends2);
	}
	
	public function pendingFriendRequests(){
		$users = array();
		
		$friendships = Friend::where('status', 0)
							 ->where('user_requested', $this->id)
							 ->get();
		
		foreach($friendships as $pending):
			array_push($users, \App\User::find($pending->requester));
		endforeach;
		
		return $users;
	}
	
	public function friendsIds(){
		return collect($this->friends())->pluck('id')->toArray();
	}
	
	public function isFriendsWith($user_id){
		
		if(in_array($user_id, $this->friendsIds())){
			return 1;
		}else{
			return 0;
		}
			
	}

	public function pendingFriendRequestsIds(){
		return collect($this->pendingFriendRequests())->pluck('id')->toArray();
	}
	
	public function pendingFriendRequestsSent(){
		$users = array();
		
		$friendships = Friend::where('status', 0)
							->where('requester', $this->id)
							->get();
		
		foreach($friendships as $friendship):
			array_push($users,\App\User::find($friendship->user_requested));
		endforeach;
		
		return $users;
	}
	
	public function pendingFriendRequestsSentIds(){
		return collect($this->pendingFriendRequestsSent())->pluck('id')->toArray();
	}

	public function hasPendingFriendRequestFrom($user_id){
		if(in_array($user_id, $this->pendingFriendRequestsIds())){
			return 1;
		}else{
			return 0;
		}
	}
	
	public function hasPendingFriendRequestSentTo($user_id){
		if(in_array($user_id, $this->pendingFriendRequestsSentIds())){
			return 1;
		}else{
			return 0;
		}
		
	}
	
}