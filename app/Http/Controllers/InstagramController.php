<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Barbearia;


class InstagramController extends Controller
{
    public function instagram(Request $request)
    {
        $response = Http::asForm()->post('https://api.instagram.com/oauth/access_token', [
            'client_id' => '1059008688493787',
            'client_secret' => 'a4a1e753a8aa8b54d964e577ca4134b2',
            'grant_type' => 'authorization_code',
            'redirect_uri' => 'https://localhost/instagram',
            'code' => $request->query('code'), 
        ]);

     

        if ($response->successful() && isset($response->json()['access_token'])) {
      
       
        $barbearia = Barbearia::findOrFail($request->query('state'));
        $barbearia->instagram_token = $response->json()['access_token'];
        $barbearia->instagram_id = $response->json()['user_id'];
        $barbearia->save();
    } else {
      
        return response()->json(['error' => 'Invalid authorization code.'], 400);
    }
  

        return view('instagram', compact('barbearia'));
    }
}
