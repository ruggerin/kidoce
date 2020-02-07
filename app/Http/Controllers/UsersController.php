<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function __construct()
    {
        $this->middleware('auth');
        
    }
   

    public function index(User $users)
    {
        $title = 'Cadastro de Lojas';
        $users =  $users->all();
        return view('versao1.usuarios', compact('users','title')); 
    }
    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function create()
    {
        $title = 'Nova Loja';
        $perfisAcesso = ['ADMIN','ANALISTA','SUPERVISOR','PROMOTOR','ENTREGADOR','CLIENTE'];
        return view('versao1.usuario',['title'=>'TESTE','perfisAcesso'=>$perfisAcesso]); 
        //return view('versao1.usuario', compact('title','perfisAcesso')); 

       

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $users)
    {
        $dataFrom= $request->except(['_token','_method','password','ativo']);
        
        foreach ($dataFrom as $key=>$value){
            if($value==!null){
                if($key =="email"){
                    $dataFrom[$key] = $value;
                }else{
                    $dataFrom[$key] = strtoupper($value); 
                }      
            }            
            
        }

        if(isset($request['ativo'])){
            $dataFrom['ativo']=true;
        }else{
            $dataFrom['ativo']=false;
        }

        if(!is_null($request['password'])){
            $password=  Hash::make($request['password']);
            $dataFrom['password']=$password;
        }

       // return $dataFrom;
       

        $update = $users->insert( $dataFrom);
  
        if($update)
        {
            $mensagem='Inserido com sucesso';
            return redirect()->route('usuarios.index')->with(['message'=> 'State saved correctly!!!']);
        }
        else
        {
            return "erro";
        }
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

    public function edit($id,User $users)
    {
        if($id == 1){
            return redirect()->route('usuarios.index')->with(['message'=> 'CONTAMASTER']);
        }else{
            $usuario = $users->find($id);
            $title = "Edição de Usuário $id";
            $perfisAcesso = ['ADMIN','ANALISTA','SUPERVISOR','PROMOTOR','ENTREGADOR','CLIENTE'];
            //return view('versao1.usuario', compact('title','usuario','perfisAcesso')); 
          
            return view('versao1.usuario',[
                'title'=>$title,
                'usuario'=>$usuario,
                'perfisAcesso'=>$perfisAcesso
            ]); 
        }
    }


    public function update(Request $request, $id, User $users)
    {
        $dataFrom= $request->except(['_token','_method','password','ativo','imgUpload1']);
        $user = $users->find($id);
        foreach ($dataFrom as $key=>$value){
            if($value==!null){
                if($key =="email"){
                    $dataFrom[$key] = $value;
                }else{
                    $dataFrom[$key] = strtoupper($value); 
                }      
            }     
            
        }


        if(isset($request['ativo'])){
            $dataFrom['ativo']=true;
        }else{
            $dataFrom['ativo']=false;
        }

        if(isset($request['administrador'])){
            $dataFrom['administrador']=true;
        }else{
            $dataFrom['administrador']=false;
        }
        if(!is_null($request['password'])){
            $password=  Hash::make($request['password']);
            $dataFrom['password']=$password;
        }

       // $uploaddir = 'C:\Users\rugge\Desktop\curso';
        if ($request->hasFile('imgUpload1') && $request->file('imgUpload1')->isValid()) {
         
            $uploadfile = "$id.jpg";
             $file = $request->file('imgUpload1')->storeAs('users', $uploadfile);;
            //$upload = $request->imgupload->store('users');
        }
       
        $update = $user->update( $dataFrom);
  
        if($update)
        {
            $mensagem='Inserido com sucesso';
            return redirect()->route('usuarios.index')->with(['message'=> 'State saved correctly!!!']);
        }
        else
        {
            return "erro";
        }
        
    }


    public function destroy($id)
    {
        //
    }
}
