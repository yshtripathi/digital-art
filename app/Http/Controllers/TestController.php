<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\User;
use App\User;
use Illuminate\Support\Facades\Hash;
class TestController extends Controller
{
    public function test1() {
    $user= User::findorfail(1);
    $user->password=Hash::make('123456');
    
if($user->save())
{
return 'saved';
}
   }
    public function allusers()
    {
        $users= User::all();
        $users = User::select('id', 'name', 'phone as phone_jp')->get();
        $users = User::selectRaw('*, phone as phone_jp')->except('phone')->get();
        return $users;
    }
}
