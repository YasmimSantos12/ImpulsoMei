<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard • Impulso MEI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-vh-100 bg-gradient-to-br from-pink-50 to-rose-100">
  @include('negocio.nav')
  <div class="container py-4 py-md-5">
    @if (session('success'))
      <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="row g-4 align-items-stretch">
      <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
          <div class="card-body p-4 p-md-5 bg-white/80">
            <div class="d-flex flex-column flex-md-row align-items-md-center gap-3 gap-md-4">
              <img src="{{ asset('/logotipos/impulsoMei.png') }}" alt="Logo"
                   class="rounded-circle border border-3 border-pink-200" style="width:64px;height:64px;object-fit:cover;">
              <div class="flex-fill">
                <h1 class="h4 mb-1 text-dark">Bem-vindo(a), <span class="text-pink-600">{{ $user->name_user}}</span></h1>
                <p class="text-muted mb-0">Painel do(a) Empreendedor(a)</p>
              </div>
            </div>

            <div class="mt-4 d-flex flex-wrap gap-2">
              <form action="{{ route('form_cadastro_produto') }}" method="get">
                <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">
                  Cadastrar produto/serviço
                </button>
              </form>
              <form action="{{ route('form_cadastro_produto') }}" method="get">
                <button type="submit" class="btn btn-outline-primary rounded-pill px-4 py-2">
                  Minhas informações
                </button>
              </form>
              <form action="{{ route('form_cadastro_produto') }}" method="get">
                <button type="submit" class="btn btn-dark rounded-pill px-4 py-2">
                  Solicitar site do meu negócio
                </button>
              </form>
            </div>

            <div class="table-responsive mt-4">
              <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-light">
                  <tr>
                    <th scope="col" class="text-muted fw-semibold">Imagem</th>
                    <th scope="col" class="text-muted fw-semibold">Produto</th>
                    <th scope="col" class="text-muted fw-semibold">Preço</th>
                    <th scope="col" class="text-muted fw-semibold text-center">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <img src="{{ asset('/logotipos/impulsoMei.png') }}" alt=""
                           class="rounded-circle border border-2 border-pink-200 d-block mx-auto" style="width:56px;height:56px;object-fit:cover;">
                    </td>
                    <td class="fw-medium">Impulso MEI</td>
                    <td><span class="badge text-bg-light border">R$ 1.000,00</span></td>
                    <td>
                      <div class="d-flex justify-content-center gap-2">
                        <form action="{{ route('form_cadastro_produto') }}" method="get">
                          <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Editar</button>
                        </form>
                        <form action="{{ route('form_cadastro_produto') }}" method="get">
                          <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3">Excluir</button>
                        </form>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>