<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Negócios • Impulso MEI</title>
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
            <form method="GET" action="{{ route('public.negocios') }}">
              <!-- Busca por nome -->
              <div class="mb-3">
                <label class="form-label text-muted small">Buscar Negócio</label>
                <input type="text" name="busca" class="form-control" 
                       value="{{ request('busca') }}" placeholder="Nome do negócio...">
              </div>

              <!-- Tipo de Serviço -->
              <div class="mb-4">
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

              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary rounded-pill">
                  <i class="fas fa-search me-2"></i>Aplicar Filtros
                </button>
                <a href="{{ route('public.negocios') }}" class="btn btn-outline-secondary rounded-pill">
                  <i class="fas fa-times me-2"></i>Limpar Filtros
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Lista de Negócios -->
      <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="h3 text-dark mb-0">
            <i class="fas fa-store me-2 text-primary"></i>Negócios
            <small class="text-muted">({{ $negocios->total() }} encontrados)</small>
          </h2>
        </div>

        @if($negocios->count() > 0)
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

          <!-- Paginação -->
          @if($negocios->hasPages())
            <div class="d-flex justify-content-center mt-5">
              {{ $negocios->links() }}
            </div>
          @endif
        @else
          <div class="text-center py-5">
            <i class="fas fa-store fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Nenhum negócio encontrado</h5>
            <p class="text-muted">Tente ajustar os filtros ou buscar por outros termos.</p>
            <a href="{{ route('public.negocios') }}" class="btn btn-primary rounded-pill">
              <i class="fas fa-refresh me-2"></i>Ver Todos os Negócios
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
