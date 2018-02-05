<?php

namespace App\Http\Controllers;

use Session;
use Auth;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(){
	   $this->middleware('auth');
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $user=User::where('slug',$slug)->first();
		return view('profile.index')->with('user', $user);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('profile.edit')->with('profile', Auth::user()->profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
			'about' => 'required|max:255',
			'location' => 'required'		
		]);
		
		Auth::user()->profile()->update([
			'about' => $request->about,
			'location' => $request->location
		]);
		
		if($request->hasFile('avatar')){
			Auth::user()->update([
				'avatar' => $request->avatar->store('public/avatars')
			]);
		}
		Session::flash('success', 'Profile Updated');
		return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
