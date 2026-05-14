<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\Negocio;
use App\Models\Produto;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

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

    public function showForgotPassword(){
        return view('negocio.forgot_password');
    }

    public function sendResetLink(Request $request){
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O e-mail informado não é válido.',
        ]);

        $status = Password::broker('negocios')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPassword(Request $request, $token){
        return view('negocio.reset_password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function resetPassword(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'token.required' => 'O token de reset é obrigatório.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O e-mail informado não é válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha precisa ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação de senha não corresponde.',
        ]);

        $status = Password::broker('negocios')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(\Illuminate\Support\Str::random(60));

                $user->save();

                event(new \Illuminate\Auth\Events\PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('form_login_negocio')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
