<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $negocio->name_negocio }} • Impulso MEI</title>

  {{-- Open Graph Meta Tags (WhatsApp, Facebook, LinkedIn) --}}
  <meta property="og:type" content="website">
  <meta property="og:title" content="{{ $negocio->name_negocio }} • Impulso MEI">
  <meta property="og:description"
    content="{{ $negocio->type_servico ? $negocio->type_servico . ' - ' : '' }}Confira os produtos e serviços de {{ $negocio->name_negocio }} no Impulso MEI!">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:image" content="{{ $negocio->logotipo
  ? (\Illuminate\Support\Str::startsWith($negocio->logotipo, ['http://', 'https://'])
    ? $negocio->logotipo
    : asset('logotipos/' . $negocio->logotipo))
  : asset('/logotipos/impulsoMei.png') }}">
  <meta property="og:site_name" content="Impulso MEI">
  <meta property="og:locale" content="pt_BR">

  {{-- Twitter Card Meta Tags --}}
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="{{ $negocio->name_negocio }} • Impulso MEI">
  <meta name="twitter:description"
    content="{{ $negocio->type_servico ? $negocio->type_servico . ' - ' : '' }}Confira os produtos e serviços de {{ $negocio->name_negocio }} no Impulso MEI!">
  <meta name="twitter:image" content="{{ $negocio->logotipo
  ? (\Illuminate\Support\Str::startsWith($negocio->logotipo, ['http://', 'https://'])
    ? $negocio->logotipo
    : asset('logotipos/' . $negocio->logotipo))
  : asset('/logotipos/impulsoMei.png') }}">

  {{-- Meta Description --}}
  <meta name="description" content="Confira os produtos e serviços de {{ $negocio->name_negocio }} no Impulso MEI!">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="min-vh-100 bg-gradient-to-br from-pink-50 to-rose-100">
  @include('public.nav')

  <div class="container py-4 py-md-5">
    <!-- Informações do Negócio -->
    <div class="row mb-5">
      <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
          <div class="card-body p-4">
            <div class="row align-items-center">
              <div class="col-md-3 text-center mb-3 mb-md-0">
                <img src="{{ $negocio->logotipo
  ? (\Illuminate\Support\Str::startsWith($negocio->logotipo, ['http://', 'https://'])
    ? $negocio->logotipo
    : asset('logotipos/' . $negocio->logotipo))
  : asset('/logotipos/impulsoMei.png') }}" alt="{{ $negocio->name_negocio }}"
                  onerror="this.onerror=null;this.src='{{ asset('/logotipos/impulsoMei.png') }}'"
                  class="rounded-circle border border-3 border-pink-200"
                  style="width:120px;height:120px;object-fit:cover;">
              </div>
              <div class="col-md-6">
                <h1 class="h3 text-dark mb-2">{{ $negocio->name_negocio }}</h1>
                <p class="text-muted mb-2">
                  <i class="fas fa-user me-2"></i>{{ $negocio->name_user }}
                </p>
                @if($negocio->type_servico)
                  <span class="badge bg-primary rounded-pill mb-2">{{ $negocio->type_servico }}</span>
                @endif
                <div class="d-flex align-items-center gap-3 text-muted small">
                  <span><i class="fas fa-box me-1"></i>{{ $negocio->produtos->count() }} produtos</span>
                  <span><i class="fas fa-calendar me-1"></i>Desde {{ $negocio->created_at->format('d/m/Y') }}</span>
                </div>
              </div>
              <div class="col-md-3 text-md-end">
                @if($negocio->telefone)
                  <div class="d-grid gap-2">
                    <a href="https://wa.me/55{{ preg_replace('/[^0-9]/', '', $negocio->telefone) }}?text=Olá! Vi o negócio '{{ $negocio->name_negocio }}' no Impulso MEI e gostaria de mais informações."
                      target="_blank" class="btn btn-success btn-lg rounded-pill">
                      <i class="fab fa-whatsapp me-2"></i>Contato WhatsApp
                    </a>
                    <a href="tel:{{ $negocio->telefone }}" class="btn btn-outline-primary rounded-pill">
                      <i class="fas fa-phone me-2"></i>Ligar
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

    <div class="row g-4">
      <!-- Informações de Contato -->
      <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
          <div class="card-header bg-white border-0">
            <h5 class="mb-0 text-dark">
              <i class="fas fa-info-circle me-2 text-primary"></i>Informações de Contato
            </h5>
          </div>
          <div class="card-body">
            @if($negocio->telefone)
              <div class="mb-3">
                <label class="form-label text-muted small">Telefone</label>
                <p class="mb-0">
                  <a href="tel:{{ $negocio->telefone }}" class="text-decoration-none">
                    <i class="fas fa-phone me-2"></i>{{ $negocio->telefone }}
                  </a>
                </p>
              </div>
            @endif

            @if($negocio->email)
              <div class="mb-3">
                <label class="form-label text-muted small">Email</label>
                <p class="mb-0">
                  <a href="mailto:{{ $negocio->email }}" class="text-decoration-none">
                    <i class="fas fa-envelope me-2"></i>{{ $negocio->email }}
                  </a>
                </p>
              </div>
            @endif

            @if($negocio->endereco)
              <div class="mb-3">
                <label class="form-label text-muted small">Endereço</label>
                <p class="mb-0">
                  <i class="fas fa-map-marker-alt me-2"></i>{{ $negocio->endereco }}
                </p>
              </div>
            @endif

            @if($negocio->type_servico)
              <div class="mb-3">
                <label class="form-label text-muted small">Tipo de Serviço</label>
                <p class="mb-0">{{ $negocio->type_servico }}</p>
              </div>
            @endif

            <div class="mb-3">
              <label class="form-label text-muted small">Membro desde</label>
              <p class="mb-0">{{ $negocio->created_at->format('d/m/Y') }}</p>
            </div>
          </div>
        </div>

        <!-- Estatísticas -->
        <div class="card border-0 shadow-sm rounded-4">
          <div class="card-header bg-white border-0">
            <h5 class="mb-0 text-dark">
              <i class="fas fa-chart-bar me-2 text-success"></i>Estatísticas
            </h5>
          </div>
          <div class="card-body">
            <div class="row text-center">
              <div class="col-6">
                <h4 class="text-primary mb-1">{{ $negocio->produtos->count() }}</h4>
                <small class="text-muted">Produtos</small>
              </div>
              <div class="col-6">
                <h4 class="text-success mb-1">{{ $negocio->produtos->where('preco', '>', 0)->count() }}</h4>
                <small class="text-muted">Com Preço</small>
              </div>
            </div>
          </div>
        </div>

        <!-- Compartilhar Negócio -->
        <div class="card border-0 shadow-sm rounded-4 mt-4">
          <div class="card-header bg-white border-0">
            <h5 class="mb-0 text-dark">
              <i class="fas fa-share-alt me-2 text-info"></i>Compartilhar Negócio
            </h5>
          </div>
          <div class="card-body">
            <p class="text-muted small mb-3">Compartilhe este negócio com seus amigos!</p>
            <div class="d-grid gap-2">
              {{-- WhatsApp --}}
              <a href="{!! 'https://wa.me/?text=' . rawurlencode($negocio->name_negocio . ' - Confira este negócio no Impulso MEI! ' . url()->current()) !!}"
                target="_blank" class="btn btn-success rounded-pill btn-sm">
                <i class="fab fa-whatsapp me-2"></i>WhatsApp
              </a>
              {{-- Facebook --}}
              <a href="{!! 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode(url()->current()) !!}"
                target="_blank" class="btn btn-primary rounded-pill btn-sm">
                <i class="fab fa-facebook-f me-2"></i>Facebook
              </a>
              {{-- Twitter / X --}}
              <a href="{!! 'https://twitter.com/intent/tweet?text=' . rawurlencode($negocio->name_negocio . ' - Confira este negócio no Impulso MEI!') . '&url=' . rawurlencode(url()->current()) !!}"
                target="_blank" class="btn rounded-pill btn-sm text-white" style="background-color:#000;">
                <i class="fab fa-x-twitter me-2"></i>X (Twitter)
              </a>
              {{-- LinkedIn --}}
              <a href="{!! 'https://www.linkedin.com/sharing/share-offsite/?url=' . rawurlencode(url()->current()) !!}"
                target="_blank" class="btn rounded-pill btn-sm text-white" style="background-color:#0077b5;">
                <i class="fab fa-linkedin-in me-2"></i>LinkedIn
              </a>
              {{-- Copiar Link --}}
              <button onclick="copiarLink()" class="btn btn-outline-secondary rounded-pill btn-sm" id="btnCopiar">
                <i class="fas fa-link me-2"></i>Copiar Link
              </button>
            </div>

            {{-- Botão nativo de compartilhamento (mobile) --}}
            <button onclick="compartilharNativo()" class="btn btn-outline-info rounded-pill btn-sm w-100 mt-2 d-none"
              id="btnShareNativo">
              <i class="fas fa-share me-2"></i>Mais opções de compartilhamento
            </button>
          </div>
        </div>
      </div>

      <!-- Produtos do Negócio -->
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
          <div class="card-header bg-white border-0">
            <h5 class="mb-0 text-dark">
              <i class="fas fa-box me-2 text-primary"></i>Produtos ({{ $negocio->produtos->count() }})
            </h5>
          </div>
          <div class="card-body">
            @if($negocio->produtos->count() > 0)
              <div class="row g-4">
                @foreach($negocio->produtos as $produto)
                          <div class="col-lg-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                              <div class="position-relative">
                                <img src="{{ $produto->foto
                  ? (\Illuminate\Support\Str::startsWith($produto->foto, ['http://', 'https://'])
                    ? $produto->foto
                    : (\Illuminate\Support\Str::contains($produto->foto, 'logotipos/')
                      ? asset($produto->foto)
                      : asset('logotipos/' . $produto->foto)))
                  : asset('/logotipos/impulsoMei.png') }}" alt="{{ $produto->nome }}"
                                  onerror="this.onerror=null;this.src='{{ asset('/logotipos/impulsoMei.png') }}'"
                                  class="card-img-top" style="height: 200px; object-fit: cover;">
                                @if(!is_null($produto->preco))
                                  <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-success rounded-pill">R$
                                      {{ number_format($produto->preco, 2, ',', '.') }}</span>
                                  </div>
                                @endif
                                @if(!empty($produto->categoria))
                                  <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge bg-primary rounded-pill">{{ $produto->categoria }}</span>
                                  </div>
                                @endif
                              </div>
                              <div class="card-body d-flex flex-column">
                                <h6 class="card-title text-dark">{{ $produto->nome }}</h6>
                                @if(!empty($produto->descricao))
                                  <p class="card-text text-muted small">{{ Str::limit($produto->descricao, 80) }}</p>
                                @endif
                                <div class="mt-auto">
                                  <a href="{{ route('public.produto', $produto->id) }}" class="btn btn-primary w-100 rounded-pill">
                                    <i class="fas fa-eye me-2"></i>Ver Detalhes
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                @endforeach
              </div>
            @else
              <div class="text-center py-5">
                <i class="fas fa-box fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Nenhum produto cadastrado</h5>
                <p class="text-muted">Este negócio ainda não cadastrou produtos.</p>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>

  <script>
    // Mostrar botão nativo se o navegador suportar Web Share API
    if (navigator.share) {
      document.getElementById('btnShareNativo').classList.remove('d-none');
    }

    function copiarLink() {
      var url = window.location.href;
      var textarea = document.createElement('textarea');
      textarea.value = url;
      textarea.style.position = 'fixed';
      textarea.style.opacity = '0';
      document.body.appendChild(textarea);
      textarea.select();
      document.execCommand('copy');
      document.body.removeChild(textarea);

      var btn = document.getElementById('btnCopiar');
      var textoOriginal = btn.innerHTML;
      btn.innerHTML = '<i class="fas fa-check me-2"></i>Link copiado!';
      btn.classList.remove('btn-outline-secondary');
      btn.classList.add('btn-success');
      setTimeout(function () {
        btn.innerHTML = textoOriginal;
        btn.classList.remove('btn-success');
        btn.classList.add('btn-outline-secondary');
      }, 2000);
    }

    function compartilharNativo() {
      navigator.share({
        title: @json($negocio->name_negocio),
        text: 'Confira este negócio no Impulso MEI: ' + @json($negocio->name_negocio),
        url: window.location.href
      }).catch(function (err) {
        console.log('Compartilhamento cancelado', err);
      });
    }
  </script>
</body>

</html>