<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin • Impulso MEI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-vh-100 bg-gradient-to-br from-pink-50 to-rose-100 d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-lg rounded-4">
          <div class="card-body p-5">
            <div class="text-center mb-4">
              <img src="{{ asset('/logotipos/impulsoMei.png') }}" alt="Logo" 
                   class="rounded-circle border border-3 border-pink-200 mb-3" 
                   style="width:80px;height:80px;object-fit:cover;">
              <h3 class="h4 text-dark mb-1">Área Administrativa</h3>
              <p class="text-muted">Faça login para acessar o painel</p>
            </div>

            @if ($errors->any())
              <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                  {{ $error }}
                @endforeach
              </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
              @csrf
              
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-4">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password" required>
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">
                Entrar
              </button>
            </form>

            <div class="text-center mt-4">
              <a href="{{ route('form_login_negocio') }}" class="text-decoration-none text-muted">
                ← Voltar ao login de usuários
              </a>
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
