<?php

namespace App\Http\Controllers;

use App\Models\Negocio;
use App\Models\Produto;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Página inicial do portal público
     */
    public function index()
    {
        // Buscar produtos em destaque (mais recentes)
        $produtosDestaque = Produto::with('negocio')
            ->latest()
            ->take(8)
            ->get();

        // Buscar negócios em destaque
        $negociosDestaque = Negocio::with('produtos')
            ->latest()
            ->take(6)
            ->get();

        // Estatísticas gerais
        $totalNegocios = Negocio::count();
        $totalProdutos = Produto::count();

        return view('public.index', compact(
            'produtosDestaque', 
            'negociosDestaque', 
            'totalNegocios', 
            'totalProdutos'
        ));
    }

    /**
     * Lista todos os produtos com filtros
     */
    public function produtos(Request $request)
    {
        $query = Produto::with('negocio');

        // Filtro por categoria
        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        // Filtro por tipo de serviço do negócio
        if ($request->filled('tipo_servico')) {
            $query->whereHas('negocio', function($q) use ($request) {
                $q->where('type_servico', $request->tipo_servico);
            });
        }

        // Busca por nome do produto
        if ($request->filled('busca')) {
            $query->where('nome', 'like', '%' . $request->busca . '%');
        }

        // Busca por nome do negócio
        if ($request->filled('negocio')) {
            $query->whereHas('negocio', function($q) use ($request) {
                $q->where('name_negocio', 'like', '%' . $request->negocio . '%');
            });
        }

        // Filtro por faixa de preço
        if ($request->filled('preco_min')) {
            $query->where('preco', '>=', $request->preco_min);
        }
        if ($request->filled('preco_max')) {
            $query->where('preco', '<=', $request->preco_max);
        }

        $produtos = $query->latest()->paginate(12);

        // Buscar categorias únicas para filtros
        $categorias = Produto::select('categoria')
            ->whereNotNull('categoria')
            ->where('categoria', '!=', '')
            ->distinct()
            ->pluck('categoria');

        // Buscar tipos de serviço únicos
        $tiposServico = Negocio::select('type_servico')
            ->whereNotNull('type_servico')
            ->where('type_servico', '!=', '')
            ->distinct()
            ->pluck('type_servico');

        return view('public.produtos', compact(
            'produtos', 
            'categorias', 
            'tiposServico'
        ));
    }

    /**
     * Lista todos os negócios
     */
    public function negocios(Request $request)
    {
        $query = Negocio::with('produtos');

        // Filtro por tipo de serviço
        if ($request->filled('tipo_servico')) {
            $query->where('type_servico', $request->tipo_servico);
        }

        // Busca por nome do negócio
        if ($request->filled('busca')) {
            $query->where('name_negocio', 'like', '%' . $request->busca . '%');
        }

        $negocios = $query->latest()->paginate(12);

        // Buscar tipos de serviço únicos
        $tiposServico = Negocio::select('type_servico')
            ->whereNotNull('type_servico')
            ->where('type_servico', '!=', '')
            ->distinct()
            ->pluck('type_servico');

        return view('public.negocios', compact('negocios', 'tiposServico'));
    }

    /**
     * Detalhes de um produto específico
     */
    public function produto($id)
    {
        $produto = Produto::with('negocio')->findOrFail($id);
        
        // Buscar produtos relacionados (mesmo negócio)
        $produtosRelacionados = Produto::where('negocio_id', $produto->negocio_id)
            ->where('id', '!=', $produto->id)
            ->latest()
            ->take(4)
            ->get();

        return view('public.produto', compact('produto', 'produtosRelacionados'));
    }

    /**
     * Detalhes de um negócio específico
     */
    public function negocio($id)
    {
        $negocio = Negocio::with('produtos')->findOrFail($id);
        
        return view('public.negocio', compact('negocio'));
    }

    /**
     * Busca geral (produtos e negócios)
     */
    public function busca(Request $request)
    {
        $termo = $request->get('q', '');
        
        if (empty($termo)) {
            return redirect()->route('public.index');
        }

        // Buscar produtos
        $produtos = Produto::with('negocio')
            ->where('nome', 'like', '%' . $termo . '%')
            ->orWhere('descricao', 'like', '%' . $termo . '%')
            ->latest()
            ->take(6)
            ->get();

        // Buscar negócios
        $negocios = Negocio::with('produtos')
            ->where('name_negocio', 'like', '%' . $termo . '%')
            ->orWhere('name_user', 'like', '%' . $termo . '%')
            ->latest()
            ->take(6)
            ->get();

        return view('public.busca', compact('produtos', 'negocios', 'termo'));
    }
}
