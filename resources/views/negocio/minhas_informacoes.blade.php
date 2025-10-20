<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Minhas Informações • Impulso MEI</title>
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
    @if (session('error'))
      <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
    @endif

    <div class="mb-3">
      <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill px-4">Voltar para a Home</a>
    </div>

    <div class="row g-4">
      <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 text-center p-4">
          <img src="{{ $user->logotipo
            ? (\Illuminate\Support\Str::startsWith($user->logotipo, ['http://','https://'])
                ? $user->logotipo
                : (\Illuminate\Support\Str::contains($user->logotipo, 'logotipos/')
                    ? asset($user->logotipo)
                    : asset('logotipos/' . $user->logotipo)))
            : asset('/logotipos/impulsoMei.png') }}"
            alt="{{ $user->name_negocio }}"
            onerror="this.onerror=null;this.src='{{ asset('/logotipos/impulsoMei.png') }}'"
            class="rounded-circle mx-auto mb-3" style="width:84px;height:84px;object-fit:cover;border:2px solid #fbcfe8;">
          <h5 class="mb-1">{{ $user->name_user }}</h5>
          <p class="text-muted mb-0">{{ $user->email }}</p>
        </div>
      </div>
      <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4">
          <div class="row g-3">
            <div class="col-md-6">
              <div class="small text-muted">Nome do negócio</div>
              <div class="fw-semibold">{{ $user->name_negocio }}</div>
            </div>
            <div class="col-md-6">
              <div class="small text-muted">Telefone</div>
              <div class="fw-semibold">{{ $user->telefone }}</div>
            </div>
            <div class="col-12">
              <div class="small text-muted">Endereço</div>
              <div class="fw-semibold">{{ $user->endereco }}</div>
            </div>
            <div class="col-md-6">
              <div class="small text-muted">Tipo de serviço</div>
              <div class="fw-semibold">{{ $user->type_servico }}</div>
            </div>
          </div>
          <div class="text-end mt-3">
            <a href="{{ route('perfil.editar') }}" class="btn btn-primary rounded-pill px-4">Editar perfil</a>
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

