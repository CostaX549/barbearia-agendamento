<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{
     public function store(Request $request){
          $token = $request->token;

          $user = auth()->user();

          if($user){
                 $user->token = $token;
                 $user->save();
          }
     }
}
