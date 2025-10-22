<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Impulso MEI - Portal de Produtos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="min-vh-100 bg-gradient-to-br from-pink-50 to-rose-100">
  @include('public.nav')
  
  <div class="container py-4 py-md-5">
    <!-- Banner Principal -->
    <div class="row mb-5">
      <div class="col-12">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-6 d-flex align-items-center p-5">
                <div>
                  <h1 class="display-4 fw-bold text-dark mb-3">
                    Descubra Produtos <span class="text-pink-600">Incríveis</span>
                  </h1>
                  <p class="lead text-muted mb-4">
                    Conecte-se com empreendedores locais e encontre produtos únicos em nossa plataforma.
                  </p>
                  <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('public.produtos') }}" class="btn btn-primary btn-lg rounded-pill px-4">
                      <i class="fas fa-search me-2"></i>Explorar Produtos
                    </a>
                    <a href="{{ route('form_cadastro_negocio') }}" class="btn btn-outline-primary btn-lg rounded-pill px-4">
                      <i class="fas fa-plus me-2"></i>Cadastrar Negócio
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="bg-gradient-to-br from-pink-100 to-rose-200 p-5 d-flex align-items-center justify-content-center" style="min-height: 400px;">
                  <div class="text-center">
                    <i class="fas fa-store fa-5x text-pink-600 mb-3"></i>
                    <h3 class="text-dark">Portal Impulso MEI</h3>
                    <p class="text-muted">Conectando empreendedores e clientes</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Estatísticas -->
    <div class="row g-4 mb-5">
      <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 text-center h-100">
          <div class="card-body">
            <i class="fas fa-store fa-2x text-primary mb-3"></i>
            <h3 class="h2 text-dark mb-1">{{ $totalNegocios }}</h3>
            <p class="text-muted mb-0">Negócios Cadastrados</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 text-center h-100">
          <div class="card-body">
            <i class="fas fa-box fa-2x text-success mb-3"></i>
            <h3 class="h2 text-dark mb-1">{{ $totalProdutos }}</h3>
            <p class="text-muted mb-0">Produtos Disponíveis</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 text-center h-100">
          <div class="card-body">
            <i class="fas fa-users fa-2x text-info mb-3"></i>
            <h3 class="h2 text-dark mb-1">{{ $totalNegocios }}</h3>
            <p class="text-muted mb-0">Empreendedores</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 text-center h-100">
          <div class="card-body">
            <i class="fas fa-heart fa-2x text-danger mb-3"></i>
            <h3 class="h2 text-dark mb-1">100%</h3>
            <p class="text-muted mb-0">Gratuito</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Produtos em Destaque -->
    <div class="row mb-5">
      <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="h3 text-dark mb-0">
            <i class="fas fa-star me-2 text-warning"></i>Produtos em Destaque
          </h2>
          <a href="{{ route('public.produtos') }}" class="btn btn-outline-primary rounded-pill">
            Ver Todos <i class="fas fa-arrow-right ms-2"></i>
          </a>
        </div>
        
        <div class="row g-4">
          @forelse ($produtosDestaque as $produto)
            <div class="col-lg-3 col-md-6">
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
                </div>
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title text-dark">{{ $produto->nome }}</h5>
                  @if(!empty($produto->descricao))
                    <p class="card-text text-muted small">{{ Str::limit($produto->descricao, 80) }}</p>
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
          @empty
            <div class="col-12">
              <div class="text-center py-5">
                <i class="fas fa-box fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Nenhum produto cadastrado ainda</h5>
                <p class="text-muted">Seja o primeiro a cadastrar seu produto!</p>
              </div>
            </div>
          @endforelse
        </div>
      </div>
    </div>

    <!-- Negócios em Destaque -->
    <div class="row">
      <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="h3 text-dark mb-0">
            <i class="fas fa-store me-2 text-primary"></i>Negócios em Destaque
          </h2>
          <a href="{{ route('public.negocios') }}" class="btn btn-outline-primary rounded-pill">
            Ver Todos <i class="fas fa-arrow-right ms-2"></i>
          </a>
        </div>
        
        <div class="row g-4">
          @forelse ($negociosDestaque as $negocio)
            <div class="col-lg-4 col-md-6">
              <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ $negocio->logotipo 
                      ? (\Illuminate\Support\Str::startsWith($negocio->logotipo, ['http://','https://'])
                          ? $negocio->logotipo
                          : asset('logotipos/' . $negocio->logotipo))
                      : asset('/logotipos/impulsoMei.png') }}"
                         alt="{{ $negocio->name_negocio }}"
                         onerror="this.onerror=null;this.src='{{ asset('/logotipos/impulsoMei.png') }}'"
                         class="rounded-circle" style="width:60px;height:60px;object-fit:cover;">
                    <div class="flex-fill">
                      <h5 class="mb-1 text-dark">{{ $negocio->name_negocio }}</h5>
                      <p class="text-muted small mb-0">{{ $negocio->name_user }}</p>
                      @if($negocio->type_servico)
                        <span class="badge bg-light text-dark border">{{ $negocio->type_servico }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                      <i class="fas fa-box me-1"></i>{{ $negocio->produtos->count() }} produtos
                    </small>
                    <a href="{{ route('public.negocio', $negocio->id) }}" 
                       class="btn btn-sm btn-outline-primary rounded-pill">
                      Ver Negócio
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <div class="col-12">
              <div class="text-center py-5">
                <i class="fas fa-store fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Nenhum negócio cadastrado ainda</h5>
                <p class="text-muted">Seja o primeiro a cadastrar seu negócio!</p>
              </div>
            </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>
