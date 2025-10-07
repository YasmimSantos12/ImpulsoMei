<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use Auth;
use Exception;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(){
        return view('negocio.form_cadastro_produto');
    }

    public function cadastrar(ProdutoRequest $request){
        $request->validated();
         try {

            if($request->hasFile('foto')){

            $filenameWithExt= $request->file('foto')->getClientOriginalName();
            $fileName = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('foto')->move(public_path('logotipos'), $fileNameToStore);
        }

            Produto::create([
                'nome'=>$request->nome,
                'descricao'=>$request->descricao,
                'preco'=>$request->preco,
                'foto'=>$fileNameToStore,
                'categoria'=>$request->categoria,
                'negocio_id'=>Auth::guard('negocio')->id(),
            ]);
            return redirect()->route('home')->with('success','Produto Cadastrado com Sucesso!');
        } catch (Exception $e) {
             return back()->withInput()->with('error', 'Falha ao Cadastrar Produto. ' . $e->getMessage());
        }
    }
}
