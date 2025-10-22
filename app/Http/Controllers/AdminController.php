<?php

namespace App\Http\Controllers;

use App\Models\Negocio;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Exibe o dashboard administrativo
     */
    public function dashboard()
    {
        // Contar total de negócios cadastrados
        $totalNegocios = Negocio::count();
        
        // Contar total de produtos cadastrados
        $totalProdutos = Produto::count();
        
        // Contar total de usuários (negócios)
        $totalUsuarios = Negocio::count();
        
        // Buscar negócios recentes
        $negociosRecentes = Negocio::latest()->take(5)->get();
        
        // Buscar produtos recentes
        $produtosRecentes = Produto::with('negocio')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalNegocios', 
            'totalProdutos', 
            'totalUsuarios', 
            'negociosRecentes', 
            'produtosRecentes'
        ));
    }

    /**
     * Exibe lista de todos os usuários (negócios) cadastrados
     */
    public function usuarios()
    {
        $usuarios = Negocio::with('produtos')->latest()->paginate(10);
        
        return view('admin.usuarios', compact('usuarios'));
    }

    /**
     * Exibe detalhes de um usuário específico
     */
    public function verUsuario($id)
    {
        $usuario = Negocio::with('produtos')->findOrFail($id);
        
        return view('admin.ver-usuario', compact('usuario'));
    }

    /**
     * Remove um usuário do sistema
     */
    public function removerUsuario($id)
    {
        $usuario = Negocio::findOrFail($id);
        
        // Remove todos os produtos do usuário
        $usuario->produtos()->delete();
        
        // Remove o usuário
        $usuario->delete();
        
        return redirect()->route('admin.usuarios')->with('success', 'Usuário removido com sucesso!');
    }

    /**
     * Exibe formulário de login para admin
     */
    public function loginForm()
    {
        return view('admin.login');
    }

    /**
     * Processa login do admin
     */
    public function login(Request $request)
    {
        $credenciais = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('web')->attempt($credenciais)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas.'])->onlyInput('email');
    }

    /**
     * Logout do admin
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
