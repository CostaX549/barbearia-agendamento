<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Teste;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Livewire\Agendar;
use App\Livewire\BarbeariaView;
use App\Livewire\Gerenciar;
use App\Livewire\Horarios;
use App\Livewire\Agendamentos;
use App\Livewire\LandingPage;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MercadoPago;
use App\Http\Controllers\Webhooks;
use App\Livewire\Subscribe;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::post('/webhooks',[Webhooks::class, 'webhook']);
Route::put('/cancelpause/{id}',[MercadoPago::class,'uptade']);
Route::get("/planos",[MercadoPago::class,'assinaturas']);
Route::post('/criar-cliente', [MercadoPago::class, 'criarCliente']);

Route::get('/checkout', [MercadoPago::class, 'index']);
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');





Route::get('/subscription-checkout', function (Request $request) {
    return $request->user()
        ->newSubscription('default', 'price_1OZPhaLHLvX4BR9HUv8tKmkh')
        ->trialDays(30)
        ->allowPromotionCodes()
        ->checkout([
            'success_url' => route('checkout-success'),
            'cancel_url' => route('checkout-cancel'),
        ]);
})->middleware('subscribe');

Route::view('checkout.success', 'dashboard')->name('checkout-success');
Route::view('checkout.cancel', 'dashboard')->name('checkout-cancel');


Route::get('/auth/{provider}/redirect', function(string $provider) {
      return Socialite::driver($provider)->redirect();
});

Route::get('/auth/{provider}/callback', function(string $provider) {
       $providerUser = Socialite::driver($provider)->user();

       $user = User::updateOrCreate([
        'provider_id' => $providerUser->id
       ], [
        'name' => $providerUser->name,
        'email' => $providerUser->email,
        'provider_avatar' => $providerUser->avatar,
        'provider_name' => $provider,
       ]);

 

       Auth::login($user);

       return redirect('/home');

});
Route::get('/sucesso', [OrderController::class, 'index'])->name('checkout.success');
Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::get('/gerenciar/{slug}/agendamentos',Agendar::class)->name('barbearia.agendamentos');

Route::get('/gerenciar/{slug}',Gerenciar::class)->name('gerenciar');
Route::get('/gerenciar/{slug}/horarios', Horarios::class)->name('horarios');
Route::get('meus-agendamentos', Agendamentos::class)->name('agendamentos');
Route::get('landing', LandingPage::class)->name('landing');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', Teste::class)->name('home');
        
   
});


Route::get('/{slug}',BarbeariaView::class);

Route::post('/processar-pagamento/{orderId}/{barbeiroId}',[OrderController::class,'webhook']);


