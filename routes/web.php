<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',function(){
  return redirect()->route('home');
});
 


//Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
Route::group(['prefix' => 'admin'], function(){
  Auth::routes();
 
  Route::get('vieworbiter',function(){
    return view('layouts.main');
  });
    Route::middleware('can:teste')->group(function(){
    //Route::middleware('can:teste')->group(function(){

    Route::post('/entregas/buscarcliente','LojasController@buscarLoja')->name('entregas.buscarLoja');
    Route::get('/entregas/ultimaposicao','AppClientBeta@UltimaLocalizacaoMotoristas')->name('ultimaposicao');
    //Route::get('/', 'HomeController@index')->name('home');
  
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/pegarinformacaoloja/{id?}','LojasController@infoloja')->name('infoloja');
    Route::get('/entregas/listar/{carregamento?}', 'PedidosController@listar')->name('entregas.listar');
    Route::post('/entregas/alterarposicaopedido', 'PedidosController@alterarposicaopedido')->name('alterarposicaopedido');
    Route::post('/entregas/sequenciaarrastada','PedidosController@processarSequencia')->name('sequenciaarrastada');
    Route::get('/maplinksequencia/envplannning/{numcar}','MapLinkIntegracao@sendMapLink')->name('envplannning');
    
    Route::resource('/lojas','LojasController');
    Route::resource('/usuarios','UsersController');
    Route::resource('/tipoprodutos','TipoProdutoController');
    Route::resource('/tipoderegistros','TipoRegistroController');
    Route::resource('/carregamentos','CarregamentosController');
    Route::resource('/pesquisa','Pesquisa');
    Route::resource('/entregas','PedidosController');
    Route::get('/rtlcarregamentos','CarregamentosController@rlt_carregamentos_index')->name('rlt_carregamentos_index');
    Route::post('/rltcarregamentos/lst','CarregamentosController@buscarCarregamentos' )->name('buscarCarregamentos');
    
    
    Route::get('/rltcarregamentos/analitico/{numcarreg}', 'CarregamentosController@imprimirDetalhesCarregamento')->name('imprimirdetalhescarregamento');
    Route::get('/entregasdashboard', function(){
      return view('versao1.entregas-dashboard');
    } )->name('entregas.dashboard');;
    Route::get('posicaogeografica', 'CarregamentosController@posicaogeograficaPeriodo');
    Route::post('/posicaogeografica/carregardados','CarregamentosController@buscarPosicao');
    Route::get('/montagemcarga','MontagemCargaController@index')->name('montagemcarga');
    Route::post('/montagemcarga/pedidos','MontagemCargaController@RelacaoPedidos');
    Route::post('/montagemcarga/selecionados','MontagemCargaController@pedidosSelecionados');

    /*Validação foto Perfil, tentar colocar dentro do controler*/
    Route::get('/fotoperfil', function(){
      $iduser =  auth()->user()->id;
      $fileDir = "users/$iduser.jpg";
      if(!Storage::exists($fileDir)){
        $fileDir ="users/defaultuser.png";
      }
      $file =  Storage::get($fileDir);
      $type = Storage::mimeType($fileDir);
      $response = Response::make($file, 200);
      $response->header("Content-Type", $type);
      return $response;
    
    })->name('fotoperfil');

    Route::get('/fotousuario/{id}', function($id){
      $iduser =  $id;
      $fileDir = "users/$iduser.jpg";
      if(!Storage::exists($fileDir)){
        $fileDir ="users/defaultuser.png";
      }
      $file =  Storage::get($fileDir);
      $type = Storage::mimeType($fileDir);
      $response = Response::make($file, 200);
      $response->header("Content-Type", $type);
      return $response;
    
    });
  } );
 } );


Route::post('/testecadcli', 'Api\SubirDados@Cadcli');
Route::post('/subircadprod', 'Api\ProdutosController@update');
Route::post('/subirdepartamento','Api\DepartamentoController@update');
Route::post('/retclientes','Api\ClientesController@show');

Route::post('/maplinkplanning','MapLinkIntegracao@processplanningmaplink');


//Mapeamento temporario aplicativo de operadores
Route::post('/api/login','AppClientBeta@LoginApp');
Route::post('/api/romaneio','AppClientBeta@Romaneio');
Route::post('/api/v1-0/updata/localizacao','AppClientBeta@receive_gps_usuario_v2');
Route::post('/api/v1-0/updata/localizacao/statusentrega','AppClientBeta@AtualizarStatusEntrega');

//Eu direto
Route::post('/api/eudireto/v1/atualizacao','Eudireto\Sincronizacao@validaSinc');
Route::post('/api/eudireto/v1/exceptions','Eudireto\Sincronizacao@exceptions');
Route::post('/montagemcarga/t');
