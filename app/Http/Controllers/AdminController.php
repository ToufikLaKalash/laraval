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
        return view('admin', ['admin' => $user->admin, 'userList' => User::all()]);
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
