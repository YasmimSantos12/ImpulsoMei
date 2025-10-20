<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\Negocio;
use App\Models\Produto;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        return view('negocio.form_login_negocio');
    }

   public function logar(AuthRequest $request){
        
        //tudo é validado
            $credenciais = $request->validated();
            /*aqui eu checo se existe algum aluno no banco de dados
            /com os mesmos dados fornecidos
            /sem a especificação Auth::guard('aluno')  ele não
            sabe em qual tabela/modelo procurar*/
            if(Auth::guard('negocio')->attempt($credenciais)){
                $request->session()->regenerate();
                return redirect()->route('home');
            }
        
            return back()->withErrors(['email' => 'Credenciais inválidas.'])->onlyInput('email');
        
    }

    public function logout(Request $request){
        Auth::guard('negocio')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function home(){
        $user = Negocio::findOrFail(Auth::guard('negocio')->id());
        $produtos = Produto::where('negocio_id', $user->id)->latest()->paginate(9);
        return view('negocio.home', compact('user', 'produtos'));
    }
}
