<?php

namespace App\Http\Controllers;

use App\Http\Requests\NegocioRequest;
use App\Models\Negocio;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Auth;

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

    public function info()
    {
        $user = Negocio::findOrFail(Auth::guard('negocio')->id());
        return view('negocio.minhas_informacoes', compact('user'));
    }

    public function editProfile()
    {
        $user = Negocio::findOrFail(Auth::guard('negocio')->id());
        return view('negocio.form_editar_perfil', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Negocio::findOrFail(Auth::guard('negocio')->id());
        $data = $request->validate([
            'name_user' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'nullable|string|max:30',
            'endereco' => 'nullable|string|max:255',
            'name_negocio' => 'nullable|string|max:255',
            'type_servico' => 'nullable|string|max:255',
            'logotipo' => 'nullable|image|max:4096',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        try {
            if ($request->hasFile('logotipo')) {
                $filenameWithExt= $request->file('logotipo')->getClientOriginalName();
                $fileName = pathinfo($filenameWithExt,PATHINFO_FILENAME);
                $extension = $request->file('logotipo')->getClientOriginalExtension();
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                $request->file('logotipo')->move(public_path('logotipos'), $fileNameToStore);
                $data['logotipo'] = 'logotipos/'.$fileNameToStore;
            }

            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $user->update($data);
            return redirect()->route('minhas_informacoes')->with('success', 'Perfil atualizado com sucesso!');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Falha ao atualizar perfil. ' . $e->getMessage());
        }
    }
}
