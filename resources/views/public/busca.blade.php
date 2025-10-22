<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Busca: {{ $termo }} • Impulso MEI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="min-vh-100 bg-gradient-to-br from-pink-50 to-rose-100">
  @include('public.nav')
  
  <div class="container py-4 py-md-5">
    <!-- Resultados da Busca -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="d-flex align-items-center gap-3 mb-4">
          <h2 class="h3 text-dark mb-0">
            <i class="fas fa-search me-2 text-primary"></i>Resultados para "{{ $termo }}"
          </h2>
          <span class="badge bg-primary rounded-pill">{{ $produtos->count() + $negocios->count() }} resultados</span>
        </div>
      </div>
    </div>

    <!-- Produtos Encontrados -->
    @if($produtos->count() > 0)
      <div class="row mb-5">
        <div class="col-12">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="h4 text-dark mb-0">
              <i class="fas fa-box me-2 text-success"></i>Produtos ({{ $produtos->count() }})
            </h3>
            <a href="{{ route('public.produtos') }}?busca={{ $termo }}" class="btn btn-outline-primary rounded-pill">
              Ver Todos <i class="fas fa-arrow-right ms-2"></i>
            </a>
          </div>
          
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
        </div>
      </div>
    @endif

    <!-- Negócios Encontrados -->
    @if($negocios->count() > 0)
      <div class="row">
        <div class="col-12">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="h4 text-dark mb-0">
              <i class="fas fa-store me-2 text-primary"></i>Negócios ({{ $negocios->count() }})
            </h3>
            <a href="{{ route('public.negocios') }}?busca={{ $termo }}" class="btn btn-outline-primary rounded-pill">
              Ver Todos <i class="fas fa-arrow-right ms-2"></i>
            </a>
          </div>
          
          <div class="row g-4">
            @foreach($negocios as $negocio)
              <div class="col-lg-6">
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
                           class="rounded-circle" style="width:80px;height:80px;object-fit:cover;">
                      <div class="flex-fill">
                        <h5 class="mb-1 text-dark">{{ $negocio->name_negocio }}</h5>
                        <p class="text-muted mb-1">{{ $negocio->name_user }}</p>
                        @if($negocio->type_servico)
                          <span class="badge bg-primary rounded-pill">{{ $negocio->type_servico }}</span>
                        @endif
                      </div>
                    </div>
                    
                    @if($negocio->endereco)
                      <div class="mb-3">
                        <small class="text-muted">
                          <i class="fas fa-map-marker-alt me-2"></i>{{ $negocio->endereco }}
                        </small>
                      </div>
                    @endif
                    
                    @if($negocio->telefone)
                      <div class="mb-3">
                        <small class="text-muted">
                          <i class="fas fa-phone me-2"></i>{{ $negocio->telefone }}
                        </small>
                      </div>
                    @endif
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <small class="text-muted">
                        <i class="fas fa-box me-1"></i>{{ $negocio->produtos->count() }} produtos
                      </small>
                      <small class="text-muted">
                        <i class="fas fa-calendar me-1"></i>{{ $negocio->created_at->format('d/m/Y') }}
                      </small>
                    </div>
                    
                    <div class="d-grid gap-2">
                      <a href="{{ route('public.negocio', $negocio->id) }}" 
                         class="btn btn-primary rounded-pill">
                        <i class="fas fa-eye me-2"></i>Ver Negócio
                      </a>
                      @if($negocio->telefone)
                        <a href="https://wa.me/55{{ preg_replace('/[^0-9]/', '', $negocio->telefone) }}?text=Olá! Vi o negócio '{{ $negocio->name_negocio }}' no Impulso MEI e gostaria de mais informações." 
                           target="_blank" 
                           class="btn btn-success rounded-pill">
                          <i class="fab fa-whatsapp me-2"></i>Contato WhatsApp
                        </a>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    @endif

    <!-- Nenhum resultado -->
    @if($produtos->count() == 0 && $negocios->count() == 0)
      <div class="text-center py-5">
        <i class="fas fa-search fa-3x text-muted mb-3"></i>
        <h5 class="text-muted">Nenhum resultado encontrado</h5>
        <p class="text-muted">Tente buscar por outros termos ou explorar nossas categorias.</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
          <a href="{{ route('public.produtos') }}" class="btn btn-primary rounded-pill">
            <i class="fas fa-box me-2"></i>Ver Todos os Produtos
          </a>
          <a href="{{ route('public.negocios') }}" class="btn btn-outline-primary rounded-pill">
            <i class="fas fa-store me-2"></i>Ver Todos os Negócios
          </a>
        </div>
      </div>
    @endif
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>
