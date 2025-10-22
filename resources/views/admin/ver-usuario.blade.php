<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detalhes do Usuário • Impulso MEI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="min-vh-100 bg-gradient-to-br from-pink-50 to-rose-100">
  @include('admin.nav')
  <div class="container py-4 py-md-5">
    <div class="row g-4 align-items-stretch">
      <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
          <div class="card-header bg-white border-0 py-4">
            <div class="d-flex flex-column flex-md-row align-items-md-center gap-3 gap-md-4">
              <img src="{{ $usuario->logotipo 
                ? (\Illuminate\Support\Str::startsWith($usuario->logotipo, ['http://','https://'])
                    ? $usuario->logotipo
                    : asset('logotipos/' . $usuario->logotipo))
                : asset('/logotipos/impulsoMei.png') }}"
                   alt="{{ $usuario->name_negocio }}"
                   onerror="this.onerror=null;this.src='{{ asset('/logotipos/impulsoMei.png') }}'"
                   class="rounded-circle border border-3 border-pink-200" style="width:64px;height:64px;object-fit:cover;">
              <div class="flex-fill">
                <h1 class="h4 mb-1 text-dark">{{ $usuario->name_negocio }}</h1>
                <p class="text-muted mb-0">Detalhes do Usuário</p>
              </div>
              <div class="d-flex gap-2">
                <a href="{{ route('admin.usuarios') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                  <i class="fas fa-arrow-left me-2"></i>Voltar
                </a>
                <button type="button" class="btn btn-outline-danger rounded-pill px-4 py-2" 
                        onclick="confirmarRemocao({{ $usuario->id }}, '{{ $usuario->name_negocio }}')">
                  <i class="fas fa-trash me-2"></i>Remover
                </button>
              </div>
            </div>
          </div>

          <div class="card-body">
            <!-- Informações do Usuário -->
            <div class="row g-4 mb-5">
              <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                  <div class="card-header bg-white border-0">
                    <h5 class="mb-0 text-dark">
                      <i class="fas fa-user me-2 text-primary"></i>Informações Pessoais
                    </h5>
                  </div>
                  <div class="card-body">
                    <div class="mb-3">
                      <label class="form-label text-muted small">Nome do Responsável</label>
                      <p class="mb-0">{{ $usuario->name_user }}</p>
                    </div>
                    <div class="mb-3">
                      <label class="form-label text-muted small">Email</label>
                      <p class="mb-0">{{ $usuario->email }}</p>
                    </div>
                    @if($usuario->telefone)
                      <div class="mb-3">
                        <label class="form-label text-muted small">Telefone</label>
                        <p class="mb-0">{{ $usuario->telefone }}</p>
                      </div>
                    @endif
                    @if($usuario->endereco)
                      <div class="mb-3">
                        <label class="form-label text-muted small">Endereço</label>
                        <p class="mb-0">{{ $usuario->endereco }}</p>
                      </div>
                    @endif
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                  <div class="card-header bg-white border-0">
                    <h5 class="mb-0 text-dark">
                      <i class="fas fa-store me-2 text-success"></i>Informações do Negócio
                    </h5>
                  </div>
                  <div class="card-body">
                    <div class="mb-3">
                      <label class="form-label text-muted small">Nome do Negócio</label>
                      <p class="mb-0">{{ $usuario->name_negocio }}</p>
                    </div>
                    @if($usuario->type_servico)
                      <div class="mb-3">
                        <label class="form-label text-muted small">Tipo de Serviço</label>
                        <p class="mb-0">{{ $usuario->type_servico }}</p>
                      </div>
                    @endif
                    <div class="mb-3">
                      <label class="form-label text-muted small">Data de Cadastro</label>
                      <p class="mb-0">{{ $usuario->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="mb-3">
                      <label class="form-label text-muted small">Última Atualização</label>
                      <p class="mb-0">{{ $usuario->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Produtos do Usuário -->
            <div class="card border-0 shadow-sm rounded-4">
              <div class="card-header bg-white border-0">
                <h5 class="mb-0 text-dark">
                  <i class="fas fa-box me-2 text-info"></i>Produtos Cadastrados ({{ $usuario->produtos->count() }})
                </h5>
              </div>
              <div class="card-body">
                @forelse ($usuario->produtos as $produto)
                  <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                    <img src="{{ $produto->foto
                      ? (\Illuminate\Support\Str::startsWith($produto->foto, ['http://','https://'])
                          ? $produto->foto
                          : (\Illuminate\Support\Str::contains($produto->foto, 'logotipos/')
                              ? asset($produto->foto)
                              : asset('logotipos/' . $produto->foto)))
                      : asset('/logotipos/impulsoMei.png') }}"
                         alt="{{ $produto->nome }}"
                         onerror="this.onerror=null;this.src='{{ asset('/logotipos/impulsoMei.png') }}'"
                         class="rounded-circle border border-2 border-pink-200" 
                         style="width:56px;height:56px;object-fit:cover;">
                    <div class="flex-fill">
                      <h6 class="mb-1">{{ $produto->nome }}</h6>
                      @if(!empty($produto->descricao))
                        <p class="text-muted small mb-1">{{ Str::limit($produto->descricao, 100) }}</p>
                      @endif
                      <div class="d-flex align-items-center gap-2 flex-wrap">
                        @if(!is_null($produto->preco))
                          <span class="badge text-bg-light border">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                        @endif
                        @if(!empty($produto->categoria))
                          <span class="badge rounded-pill text-bg-secondary">{{ $produto->categoria }}</span>
                        @endif
                        <small class="text-muted">{{ $produto->created_at->format('d/m/Y') }}</small>
                      </div>
                    </div>
                  </div>
                @empty
                  <div class="text-center py-4">
                    <i class="fas fa-box fa-2x text-muted mb-3"></i>
                    <p class="text-muted">Este usuário ainda não cadastrou nenhum produto.</p>
                  </div>
                @endforelse
              </div>
            </div>
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
