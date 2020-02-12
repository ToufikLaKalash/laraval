<?php

namespace App\Http\Controllers;

use App\Skill;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller{
    public function log(){
        $user = Auth::user();
        return view('admin', ['userList' => User::all(), 'admin' => $user->admin]);
    }

    public function post(Request $request){
        $user = Auth::user();
        return view('admin', ['data' => $request->post(), 'admin' => $user->admin]);
    }

    public function delete(Request $request){
        $skillName = $request['skillName'];
        $userId = $request['userId'];
        $key = $request['key'];

        User::find($userId)->skills->where('name', $skillName)[$key]->pivot->delete();
        return redirect("/admin");
    }

    public function modifself(Request $request){
		$user = User::where('email', $request['oldemail'])->first();
		$user->name = $request['name'];
		$user->firstname = $request['firstname'];
		$user->lastname = $request['lastname'];
		$user->email = $request['email'];
		$user->bio = $request['bio'];
		$user->password = hash('SHA512', $request['password']);
		$user->save();
        return redirect("/home");
    }

    public function modify(Request $request){
        $skillId = $request['skillId'];
        $skillValue = $request['skillValue'];
        $userId = $request['userId'];
        $key = $request['key'];

        User::find($userId)->skills->where('id', $skillId)[$key]->pivot->update(['level' => $skillValue]);
        return redirect("/admin");
    }

    public function add(Request $request){
        $userId = $request['userId'];
        $skillId = $request['skillId'];

        DB::table('skill_user')->insert(array('skill_id' => $skillId, 'user_id' => $userId, 'level' => 1));
        return redirect("/admin");
    }
}
