<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Produtos • Impulso MEI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="min-vh-100 bg-gradient-to-br from-pink-50 to-rose-100">
  @include('public.nav')
  
  <div class="container py-4 py-md-5">
    <div class="row g-4">
      <!-- Filtros -->
      <div class="col-lg-3">
        <div class="card border-0 shadow-sm rounded-4">
          <div class="card-header bg-white border-0">
            <h5 class="mb-0 text-dark">
              <i class="fas fa-filter me-2 text-primary"></i>Filtros
            </h5>
          </div>
          <div class="card-body">
            <form method="GET" action="{{ route('public.produtos') }}">
              <!-- Busca por nome -->
              <div class="mb-3">
                <label class="form-label text-muted small">Buscar Produto</label>
                <input type="text" name="busca" class="form-control" 
                       value="{{ request('busca') }}" placeholder="Nome do produto...">
              </div>

              <!-- Busca por negócio -->
              <div class="mb-3">
                <label class="form-label text-muted small">Buscar Negócio</label>
                <input type="text" name="negocio" class="form-control" 
                       value="{{ request('negocio') }}" placeholder="Nome do negócio...">
              </div>

              <!-- Categoria -->
              <div class="mb-3">
                <label class="form-label text-muted small">Categoria</label>
                <select name="categoria" class="form-select">
                  <option value="">Todas as categorias</option>
                  @foreach($categorias as $categoria)
                    <option value="{{ $categoria }}" {{ request('categoria') == $categoria ? 'selected' : '' }}>
                      {{ $categoria }}
                    </option>
                  @endforeach
                </select>
              </div>

              <!-- Tipo de Serviço -->
              <div class="mb-3">
                <label class="form-label text-muted small">Tipo de Serviço</label>
                <select name="tipo_servico" class="form-select">
                  <option value="">Todos os tipos</option>
                  @foreach($tiposServico as $tipo)
                    <option value="{{ $tipo }}" {{ request('tipo_servico') == $tipo ? 'selected' : '' }}>
                      {{ $tipo }}
                    </option>
                  @endforeach
                </select>
              </div>

              <!-- Faixa de Preço -->
              <div class="mb-3">
                <label class="form-label text-muted small">Preço Mínimo</label>
                <input type="number" name="preco_min" class="form-control" 
                       value="{{ request('preco_min') }}" placeholder="0.00" step="0.01">
              </div>

              <div class="mb-4">
                <label class="form-label text-muted small">Preço Máximo</label>
                <input type="number" name="preco_max" class="form-control" 
                       value="{{ request('preco_max') }}" placeholder="999.99" step="0.01">
              </div>

              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary rounded-pill">
                  <i class="fas fa-search me-2"></i>Aplicar Filtros
                </button>
                <a href="{{ route('public.produtos') }}" class="btn btn-outline-secondary rounded-pill">
                  <i class="fas fa-times me-2"></i>Limpar Filtros
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Lista de Produtos -->
      <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="h3 text-dark mb-0">
            <i class="fas fa-box me-2 text-primary"></i>Produtos
            <small class="text-muted">({{ $produtos->total() }} encontrados)</small>
          </h2>
        </div>

        @if($produtos->count() > 0)
          <div class="row g-4">
            @foreach($produtos as $produto)
              <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                  <div class="position-relative">
                    <img src="{{ $produto->foto
                      ? (\Illuminate\Support\Str::startsWith($produto->foto, ['http://','https://'])
                          ? $produto->foto
                          : (\Illuminate\Support\Str::contains($produto->foto, 'logotipos/')
                              ? asset($produto->foto)
                              : asset('logotipos/' . $produto->foto)))
                      : asset('/logotipos/impulsoMei.png') }}"
                         alt="{{ $produto->nome }}"
                         onerror="this.onerror=null;this.src='{{ asset('/logotipos/impulsoMei.png') }}'"
                         class="card-img-top" style="height: 200px; object-fit: cover;">
                    @if(!is_null($produto->preco))
                      <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-success rounded-pill">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                      </div>
                    @endif
                    @if(!empty($produto->categoria))
                      <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge bg-primary rounded-pill">{{ $produto->categoria }}</span>
                      </div>
                    @endif
                  </div>
                  <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-dark">{{ $produto->nome }}</h5>
                    @if(!empty($produto->descricao))
                      <p class="card-text text-muted small">{{ Str::limit($produto->descricao, 100) }}</p>
                    @endif
                    <div class="mt-auto">
                      <div class="d-flex align-items-center gap-2 mb-3">
                        <img src="{{ $produto->negocio->logotipo 
                          ? (\Illuminate\Support\Str::startsWith($produto->negocio->logotipo, ['http://','https://'])
                              ? $produto->negocio->logotipo
                              : asset('logotipos/' . $produto->negocio->logotipo))
                          : asset('/logotipos/impulsoMei.png') }}"
                             alt="{{ $produto->negocio->name_negocio }}"
                             onerror="this.onerror=null;this.src='{{ asset('/logotipos/impulsoMei.png') }}'"
                             class="rounded-circle" style="width:32px;height:32px;object-fit:cover;">
                        <small class="text-muted">{{ $produto->negocio->name_negocio }}</small>
                      </div>
                      <a href="{{ route('public.produto', $produto->id) }}" 
                         class="btn btn-primary w-100 rounded-pill">
                        <i class="fas fa-eye me-2"></i>Ver Detalhes
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>

          <!-- Paginação -->
          @if($produtos->hasPages())
            <div class="d-flex justify-content-center mt-5">
              {{ $produtos->links() }}
            </div>
          @endif
        @else
          <div class="text-center py-5">
            <i class="fas fa-search fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Nenhum produto encontrado</h5>
            <p class="text-muted">Tente ajustar os filtros ou buscar por outros termos.</p>
            <a href="{{ route('public.produtos') }}" class="btn btn-primary rounded-pill">
              <i class="fas fa-refresh me-2"></i>Ver Todos os Produtos
            </a>
          </div>
        @endif
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>
