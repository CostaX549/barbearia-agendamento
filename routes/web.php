<?php

use App\Http\Controllers\InstagramController;
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
use App\Livewire\Colaborador;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BarbeariaController;
use App\Http\Controllers\MercadoPago;
use App\Http\Controllers\Webhooks;
use App\Livewire\Calendario;
use App\Livewire\Subscribe;
use App\Livewire\Deletar;
use App\Livewire\Plano;
use App\Livewire\Services;
use App\Jobs\VerificarPagamento;
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


Route::post('/webhooks',[Webhooks::class, 'webhook'])->name('webhook');


Route::view('view', 'view');
Route::get('/barbearia/{nome}', [BarbeariaController::class, 'buscarPorNome']);



Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/byebye', [MercadoPago::class, 'index']);




Route::get('/criar-plano', [MercadoPago::class, 'criar']);


Route::get('/instagram', [InstagramController::class, 'instagram']);




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




Route::prefix('gerenciar/{slug}')->group(function () {
    Route::get('/', Gerenciar::class)->name('gerenciar');
    Route::get('/agendamentos', Agendar::class)->name('barbearia.agendamentos');
    Route::get('/horarios', Horarios::class)->name('horarios');
    Route::get('/horarios/calendario/{id}', Calendario::class)->name('barbeiro.calendario'); 
    Route::get('/billing', Colaborador::class)->name('barbearia.billing');
    Route::get('/deletar',Deletar::class)->name('deletar');
    Route::get('/services', Services::class)->name('barbearia.services');
    Route::get('/plano', Plano::class)->name('barbearia.plano');
})->middleware("auth");

Route::get('landing', LandingPage::class)->name('landing');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', Teste::class)->name('home');
    Route::get('/{slug}',BarbeariaView::class);
 
});








Route::post('/processar-pagamento/{orderId}/{barbeiroId}',[OrderController::class,'webhook']);


