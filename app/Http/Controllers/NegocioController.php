<?php

namespace App\Http\Controllers;

use App\Http\Requests\NegocioRequest;
use App\Models\Negocio;
use Exception;
use Hash;
use Illuminate\Http\Request;

class NegocioController extends Controller
{
    public function indexCadastro(){
        return view('negocio.form_cadastro_negocio');
    }

    public function cadastro(NegocioRequest $request){

        $request->validated();

        try {

            if($request->hasFile('logotipo')){

            $filenameWithExt= $request->file('logotipo')->getClientOriginalName();
            $fileName = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('logotipo')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('logotipo')->move(public_path('logotipos'), $fileNameToStore);
        }

            Negocio::create([
                'password' => Hash::make($request->password),
                'name_user' => $request->name_user,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'endereco' => $request->endereco,
                'name_negocio' => $request->name_negocio,
                'type_servico' => $request->type_servico,
                'logotipo' => $fileNameToStore
            ]);
            return redirect()->route('form_login_negocio')->with('success','Negócio Cadastrado com Sucesso!');
        } catch (Exception $e) {
             return back()->withInput()->with('error', 'Falha ao Cadastrar Negócio. ' . $e->getMessage());
        }
    }
}
