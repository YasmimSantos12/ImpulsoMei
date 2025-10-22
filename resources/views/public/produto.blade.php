<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $produto->nome }} • Impulso MEI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="min-vh-100 bg-gradient-to-br from-pink-50 to-rose-100">
  @include('public.nav')
  
  <div class="container py-4 py-md-5">
    <div class="row g-4">
      <!-- Produto Principal -->
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
          <div class="row g-0">
            <div class="col-md-6">
              <img src="{{ $produto->foto
                ? (\Illuminate\Support\Str::startsWith($produto->foto, ['http://','https://'])
                    ? $produto->foto
                    : (\Illuminate\Support\Str::contains($produto->foto, 'logotipos/')
                        ? asset($produto->foto)
                        : asset('logotipos/' . $produto->foto)))
                : asset('/logotipos/impulsoMei.png') }}"
                   alt="{{ $produto->nome }}"
                   onerror="this.onerror=null;this.src='{{ asset('/logotipos/impulsoMei.png') }}'"
                   class="img-fluid w-100" style="height: 400px; object-fit: cover;">
            </div>
            <div class="col-md-6">
              <div class="card-body p-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                  @if(!empty($produto->categoria))
                    <span class="badge bg-primary rounded-pill">{{ $produto->categoria }}</span>
                  @endif
                  @if(!is_null($produto->preco))
                    <span class="badge bg-success rounded-pill">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                  @endif
                </div>
                
                <h1 class="h3 text-dark mb-3">{{ $produto->nome }}</h1>
                
                @if(!empty($produto->descricao))
                  <p class="text-muted mb-4">{{ $produto->descricao }}</p>
                @endif

                <!-- Informações do Negócio -->
                <div class="border-top pt-4">
                  <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ $produto->negocio->logotipo 
                      ? (\Illuminate\Support\Str::startsWith($produto->negocio->logotipo, ['http://','https://'])
                          ? $produto->negocio->logotipo
                          : asset('logotipos/' . $produto->negocio->logotipo))
                      : asset('/logotipos/impulsoMei.png') }}"
                         alt="{{ $produto->negocio->name_negocio }}"
                         onerror="this.onerror=null;this.src='{{ asset('/logotipos/impulsoMei.png') }}'"
                         class="rounded-circle" style="width:50px;height:50px;object-fit:cover;">
                    <div>
                      <h6 class="mb-1 text-dark">{{ $produto->negocio->name_negocio }}</h6>
                      <small class="text-muted">{{ $produto->negocio->name_user }}</small>
                    </div>
                  </div>
                  
                  @if($produto->negocio->telefone)
                    <div class="d-grid gap-2">
                      <a href="https://wa.me/55{{ preg_replace('/[^0-9]/', '', $produto->negocio->telefone) }}?text=Olá! Vi o produto '{{ $produto->nome }}' no Impulso MEI e gostaria de mais informações." 
                         target="_blank" 
                         class="btn btn-success btn-lg rounded-pill">
                        <i class="fab fa-whatsapp me-2"></i>Entrar em Contato via WhatsApp
                      </a>
                    </div>
                  @else
                    <div class="alert alert-warning">
                      <i class="fas fa-exclamation-triangle me-2"></i>
                      Este negócio não possui telefone cadastrado para contato.
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Informações Adicionais -->
      <div class="col-lg-4">
        <!-- Informações do Negócio -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-header bg-white border-0">
            <h5 class="mb-0 text-dark">
              <i class="fas fa-store me-2 text-primary"></i>Informações do Negócio
            </h5>
          </div>
          <div class="card-body">
            <div class="d-flex align-items-center gap-3 mb-3">
              <img src="{{ $produto->negocio->logotipo 
                ? (\Illuminate\Support\Str::startsWith($produto->negocio->logotipo, ['http://','https://'])
                    ? $produto->negocio->logotipo
                    : asset('logotipos/' . $produto->negocio->logotipo))
                : asset('/logotipos/impulsoMei.png') }}"
                   alt="{{ $produto->negocio->name_negocio }}"
                   onerror="this.onerror=null;this.src='{{ asset('/logotipos/impulsoMei.png') }}'"
                   class="rounded-circle" style="width:60px;height:60px;object-fit:cover;">
              <div>
                <h6 class="mb-1 text-dark">{{ $produto->negocio->name_negocio }}</h6>
                <small class="text-muted">{{ $produto->negocio->name_user }}</small>
              </div>
            </div>
            
            @if($produto->negocio->type_servico)
              <div class="mb-3">
                <label class="form-label text-muted small">Tipo de Serviço</label>
                <p class="mb-0">{{ $produto->negocio->type_servico }}</p>
              </div>
            @endif
            
            @if($produto->negocio->endereco)
              <div class="mb-3">
                <label class="form-label text-muted small">Endereço</label>
                <p class="mb-0">{{ $produto->negocio->endereco }}</p>
              </div>
            @endif
            
            @if($produto->negocio->telefone)
              <div class="mb-3">
                <label class="form-label text-muted small">Telefone</label>
                <p class="mb-0">
                  <a href="tel:{{ $produto->negocio->telefone }}" class="text-decoration-none">
                    <i class="fas fa-phone me-2"></i>{{ $produto->negocio->telefone }}
                  </a>
                </p>
              </div>
            @endif
            
            <div class="d-grid">
              <a href="{{ route('public.negocio', $produto->negocio->id) }}" 
                 class="btn btn-outline-primary rounded-pill">
                <i class="fas fa-store me-2"></i>Ver Negócio Completo
              </a>
            </div>
          </div>
        </div>

        <!-- Produtos Relacionados -->
        @if($produtosRelacionados->count() > 0)
          <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0">
              <h5 class="mb-0 text-dark">
                <i class="fas fa-box me-2 text-success"></i>Outros Produtos
              </h5>
            </div>
            <div class="card-body">
              @foreach($produtosRelacionados as $produtoRelacionado)
                <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                  <img src="{{ $produtoRelacionado->foto
                    ? (\Illuminate\Support\Str::startsWith($produtoRelacionado->foto, ['http://','https://'])
                        ? $produtoRelacionado->foto
                        : (\Illuminate\Support\Str::contains($produtoRelacionado->foto, 'logotipos/')
                            ? asset($produtoRelacionado->foto)
                            : asset('logotipos/' . $produtoRelacionado->foto)))
                    : asset('/logotipos/impulsoMei.png') }}"
                       alt="{{ $produtoRelacionado->nome }}"
                       onerror="this.onerror=null;this.src='{{ asset('/logotipos/impulsoMei.png') }}'"
                       class="rounded" style="width:60px;height:60px;object-fit:cover;">
                  <div class="flex-fill">
                    <h6 class="mb-1">{{ $produtoRelacionado->nome }}</h6>
                    @if(!is_null($produtoRelacionado->preco))
                      <span class="badge bg-success">R$ {{ number_format($produtoRelacionado->preco, 2, ',', '.') }}</span>
                    @endif
                  </div>
                  <a href="{{ route('public.produto', $produtoRelacionado->id) }}" 
                     class="btn btn-sm btn-outline-primary rounded-pill">
                    Ver
                  </a>
                </div>
              @endforeach
            </div>
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
