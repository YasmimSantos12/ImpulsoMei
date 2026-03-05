<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Admin • Impulso MEI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-vh-100 bg-gradient-to-br from-pink-50 to-rose-100">
  @include('admin.nav')
  <div class="container py-4 py-md-5">
    @if (session('success'))
      <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="row g-4 align-items-stretch">
      <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
          <div class="card-header bg-white border-0 py-4">
            <div class="d-flex flex-column flex-md-row align-items-md-center gap-3 gap-md-4">
              <img src="{{ asset('/logotipos/impulsoMei.png') }}" alt="Logo"
                class="rounded-circle border border-3 border-pink-200" style="width:64px;height:64px;object-fit:cover;">
              <div class="flex-fill">
                <h1 class="h4 mb-1 text-dark">Dashboard Administrativo</h1>
                <p class="text-muted mb-0">Painel de Controle do Sistema</p>
              </div>
            </div>
          </div>

          <div class="card-body">
            <!-- Cards de Estatísticas -->
            <div class="row g-4 mb-5">
              <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                  <div class="card-body text-center">
                    <div class="text-primary mb-3">
                      <i class="fas fa-store fa-2x"></i>
                    </div>
                    <h3 class="h2 text-dark mb-1">{{ $totalNegocios }}</h3>
                    <p class="text-muted mb-0">Negócios Cadastrados</p>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                  <div class="card-body text-center">
                    <div class="text-success mb-3">
                      <i class="fas fa-box fa-2x"></i>
                    </div>
                    <h3 class="h2 text-dark mb-1">{{ $totalProdutos }}</h3>
                    <p class="text-muted mb-0">Produtos Cadastrados</p>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                  <div class="card-body text-center">
                    <div class="text-info mb-3">
                      <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h3 class="h2 text-dark mb-1">{{ $totalUsuarios }}</h3>
                    <p class="text-muted mb-0">Usuários Ativos</p>
                  </div>
                </div>
              </div>
            </div>
            <!-- Botões de Ação -->
            <div class="mb-4 d-flex flex-wrap gap-2">
              <a href="{{ route('admin.usuarios') }}" class="btn btn-primary rounded-pill px-4 py-2">
                <i class="fas fa-users me-2"></i>Gerenciar Usuários
              </a>
              <button type="button" class="btn btn-outline-primary rounded-pill px-4 py-2" data-bs-toggle="modal"
                data-bs-target="#relatoriosModal">
                <i class="fas fa-chart-bar me-2"></i>Relatórios
              </button>
              <a href="{{ route('admin.logout') }}" class="btn btn-outline-danger rounded-pill px-4 py-2">
                <i class="fas fa-sign-out-alt me-2"></i>Sair
              </a>
            </div>

            <div class="row g-4">
              <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                  <div class="card-header bg-white border-0">
                    <h5 class="mb-0 text-dark">
                      <i class="fas fa-store me-2 text-primary"></i>Negócios Recentes
                    </h5>
                  </div>
                  <div class="card-body">
                    @forelse ($negociosRecentes as $negocio)
                                      <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                                        <img src="{{ $negocio->logotipo
                      ? (\Illuminate\Support\Str::startsWith($negocio->logotipo, ['http://', 'https://'])
                        ? $negocio->logotipo
                        : asset('logotipos/' . $negocio->logotipo))
                      : asset('/logotipos/impulsoMei.png') }}" alt="{{ $negocio->name_negocio }}"
                                          onerror="this.onerror=null;this.src='{{ asset('/logotipos/impulsoMei.png') }}'"
                                          class="rounded-circle border border-2 border-pink-200"
                                          style="width:48px;height:48px;object-fit:cover;">
                                        <div class="flex-fill">
                                          <h6 class="mb-1">{{ $negocio->name_negocio }}</h6>
                                          <p class="text-muted small mb-0">{{ $negocio->name_user }}</p>
                                          <small class="text-muted">{{ $negocio->created_at->format('d/m/Y') }}</small>
                                        </div>
                                        <a href="{{ route('admin.ver-usuario', $negocio->id) }}"
                                          class="btn btn-sm btn-outline-primary rounded-pill">
                                          Ver
                                        </a>
                                      </div>
                    @empty
                      <p class="text-muted text-center py-3">Nenhum negócio cadastrado ainda.</p>
                    @endforelse
                  </div>
                </div>
              </div>

              <!-- Produtos Recentes -->
              <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                  <div class="card-header bg-white border-0">
                    <h5 class="mb-0 text-dark">
                      <i class="fas fa-box me-2 text-success"></i>Produtos Recentes
                    </h5>
                  </div>
                  <div class="card-body">
                    @forelse ($produtosRecentes as $produto)
                                      <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                                        <img src="{{ $produto->foto
                      ? (\Illuminate\Support\Str::startsWith($produto->foto, ['http://', 'https://'])
                        ? $produto->foto
                        : (\Illuminate\Support\Str::contains($produto->foto, 'logotipos/')
                          ? asset($produto->foto)
                          : asset('logotipos/' . $produto->foto)))
                      : asset('/logotipos/impulsoMei.png') }}" alt="{{ $produto->nome }}"
                                          onerror="this.onerror=null;this.src='{{ asset('/logotipos/impulsoMei.png') }}'"
                                          class="rounded-circle border border-2 border-pink-200"
                                          style="width:48px;height:48px;object-fit:cover;">
                                        <div class="flex-fill">
                                          <h6 class="mb-1">{{ $produto->nome }}</h6>
                                          <p class="text-muted small mb-0">{{ $produto->negocio->name_negocio }}</p>
                                          @if(!is_null($produto->preco))
                                            <span class="badge text-bg-light border">R$
                                              {{ number_format($produto->preco, 2, ',', '.') }}</span>
                                          @endif
                                        </div>
                                      </div>
                    @empty
                      <p class="text-muted text-center py-3">Nenhum produto cadastrado ainda.</p>
                    @endforelse
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de Relatórios -->
  <div class="modal fade" id="relatoriosModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-4 border-0 shadow">
        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title fw-bold">Gerar Relatórios</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body pt-4">
          <p class="text-muted mb-4">Selecione o tipo de relatório que deseja gerar. O download iniciará automaticamente
            em formato PDF.</p>

          <div class="d-grid gap-3">
            <form action="{{ route('admin.relatorios.gerar') }}" method="POST">
              @csrf
              <input type="hidden" name="tipo" value="usuarios">
              <button type="submit"
                class="btn btn-outline-primary w-100 py-3 rounded-3 text-start d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                  <i class="fas fa-users text-primary"></i>
                </div>
                <div>
                  <div class="fw-bold">Relatório de Usuários</div>
                  <small class="text-muted">Lista completa de negócios cadastrados</small>
                </div>
                <i class="fas fa-download ms-auto text-muted"></i>
              </button>
            </form>

            <form action="{{ route('admin.relatorios.gerar') }}" method="POST">
              @csrf
              <input type="hidden" name="tipo" value="produtos">
              <button type="submit"
                class="btn btn-outline-success w-100 py-3 rounded-3 text-start d-flex align-items-center">
                <div class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                  <i class="fas fa-box text-success"></i>
                </div>
                <div>
                  <div class="fw-bold">Relatório de Produtos</div>
                  <small class="text-muted">Lista completa de produtos cadastrados</small>
                </div>
                <i class="fas fa-download ms-auto text-muted"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</body>

</html>