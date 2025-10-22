<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gerenciar Usuários • Impulso MEI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                <h1 class="h4 mb-1 text-dark">Gerenciar Usuários</h1>
                <p class="text-muted mb-0">Lista de todos os usuários cadastrados no sistema</p>
              </div>
            </div>
          </div>

          <div class="card-body">
            <!-- Filtros e Busca -->
            <div class="row mb-4">
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                  </span>
                  <input type="text" class="form-control border-start-0" placeholder="Buscar por nome ou email...">
                </div>
              </div>
              <div class="col-md-6 text-md-end">
                <span class="text-muted">Total: {{ $usuarios->total() }} usuários</span>
              </div>
            </div>

            <!-- Lista de Usuários -->
            <div class="row g-3">
              @forelse ($usuarios as $usuario)
                <div class="col-12">
                  <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-md-2">
                          <img src="{{ $usuario->logotipo 
                            ? (\Illuminate\Support\Str::startsWith($usuario->logotipo, ['http://','https://'])
                                ? $usuario->logotipo
                                : asset('logotipos/' . $usuario->logotipo))
                            : asset('/logotipos/impulsoMei.png') }}"
                               alt="{{ $usuario->name_negocio }}"
                               onerror="this.onerror=null;this.src='{{ asset('/logotipos/impulsoMei.png') }}'"
                               class="rounded-circle border border-2 border-pink-200" 
                               style="width:60px;height:60px;object-fit:cover;">
                        </div>
                        
                        <div class="col-md-6">
                          <h5 class="mb-1 text-dark">{{ $usuario->name_negocio }}</h5>
                          <p class="text-muted mb-1">{{ $usuario->name_user }}</p>
                          <p class="text-muted small mb-0">
                            <i class="fas fa-envelope me-1"></i>{{ $usuario->email }}
                          </p>
                          @if($usuario->telefone)
                            <p class="text-muted small mb-0">
                              <i class="fas fa-phone me-1"></i>{{ $usuario->telefone }}
                            </p>
                          @endif
                        </div>
                        
                        <div class="col-md-2 text-center">
                          <div class="d-flex flex-column align-items-center">
                            <span class="badge bg-primary rounded-pill mb-1">{{ $usuario->produtos->count() }}</span>
                            <small class="text-muted">Produtos</small>
                          </div>
                        </div>
                        
                        <div class="col-md-2 text-center">
                          <small class="text-muted d-block">Cadastrado em</small>
                          <span class="text-dark">{{ $usuario->created_at->format('d/m/Y') }}</span>
                        </div>
                        
                        <div class="col-md-12 col-lg-2 mt-3 mt-lg-0">
                          <div class="d-flex gap-2 justify-content-lg-end">
                            <a href="{{ route('admin.ver-usuario', $usuario->id) }}" 
                               class="btn btn-sm btn-outline-primary rounded-pill">
                              <i class="fas fa-eye me-1"></i>Ver
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill" 
                                    onclick="confirmarRemocao({{ $usuario->id }}, '{{ $usuario->name_negocio }}')">
                              <i class="fas fa-trash me-1"></i>Remover
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @empty
                <div class="col-12">
                  <div class="text-center py-5">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Nenhum usuário cadastrado</h5>
                    <p class="text-muted">Ainda não há usuários no sistema.</p>
                  </div>
                </div>
              @endforelse
            </div>

            <!-- Paginação -->
            @if($usuarios->hasPages())
              <div class="d-flex justify-content-center mt-4">
                {{ $usuarios->links() }}
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de Confirmação -->
  <div class="modal fade" id="confirmModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmar Remoção</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>Tem certeza que deseja remover o usuário <strong id="usuarioNome"></strong>?</p>
          <p class="text-danger small">Esta ação não pode ser desfeita e removerá todos os produtos associados.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <form id="deleteForm" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Remover</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <script>
    function confirmarRemocao(id, nome) {
      document.getElementById('usuarioNome').textContent = nome;
      document.getElementById('deleteForm').action = `/admin/usuarios/${id}`;
      new bootstrap.Modal(document.getElementById('confirmModal')).show();
    }
  </script>
</body>

</html>
