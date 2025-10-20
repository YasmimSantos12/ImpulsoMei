<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use Illuminate\Support\Facades\Storage;
use Auth;
use Exception;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    private function ensureOwnership(Produto $produto): void
    {
        if ($produto->negocio_id !== Auth::guard('negocio')->id()) {
            abort(403);
        }
    }
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
                'foto'=> isset($fileNameToStore) ? 'logotipos/'.$fileNameToStore : null,
                'categoria'=>$request->categoria,
                'negocio_id'=>Auth::guard('negocio')->id(),
            ]);
            return redirect()->route('home')->with('success','Produto Cadastrado com Sucesso!');
        } catch (Exception $e) {
             return back()->withInput()->with('error', 'Falha ao Cadastrar Produto. ' . $e->getMessage());
        }
    }

    public function edit(Produto $produto)
    {
        $this->ensureOwnership($produto);
        return view('negocio.form_editar_produto', compact('produto'));
    }

    public function update(ProdutoRequest $request, Produto $produto)
    {
        $this->ensureOwnership($produto);
        $data = $request->validated();
        try {
            if($request->hasFile('foto')){
                $filenameWithExt= $request->file('foto')->getClientOriginalName();
                $fileName = pathinfo($filenameWithExt,PATHINFO_FILENAME);
                $extension = $request->file('foto')->getClientOriginalExtension();
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                $request->file('foto')->move(public_path('logotipos'), $fileNameToStore);
                $data['foto'] = 'logotipos/'.$fileNameToStore;
            }
            $produto->update($data);
            return redirect()->route('home')->with('success','Produto atualizado com sucesso!');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Falha ao atualizar produto. ' . $e->getMessage());
        }
    }

    public function destroy(Produto $produto)
    {
        $this->ensureOwnership($produto);
        try {
            if ($produto->foto && file_exists(public_path($produto->foto))) {
                @unlink(public_path($produto->foto));
            }
            $produto->delete();
            return redirect()->route('home')->with('success','Produto excluído com sucesso!');
        } catch (Exception $e) {
            return back()->with('error', 'Falha ao excluir produto. ' . $e->getMessage());
        }
    }
}
