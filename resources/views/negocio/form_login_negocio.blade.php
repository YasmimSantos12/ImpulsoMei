<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Faça Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <div class="container  justify-items-center d-flex justify-content-center align-items-center min-vh-100">
        <div class="row row w-100 justify-content-center">
            <div class="col bg-pink-50 text-pink-500 p-6 justify-items-center rounded-xl shadow-xl/30 col-md-6 col-lg-4">
                <img src="{{ asset('/logotipos/impulsoMei.png') }}" alt="" class="w-24 rounded-full shadow-xl/30">
                <h1 class="">Entrar no Sistema</h1>
                <br>
                <form method="POST" action="{{ route('login_negocio') }}">
                    @csrf

                    <div class="mb-3">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if($errors->has('email'))
                            @foreach($errors->get('email') as $error)
                                <div class="alert alert-warning">{{ $error }}</div>
                            @endforeach
                        @endif
                        <label class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                            placeholder="E-mail (@gmail.com)" />
                    </div>
                    <div class="mb-3">
                        @if($errors->has('password'))
                            @foreach($errors->get('password') as $error)
                                <div class="alert alert-warning">{{ $error }}</div>
                            @endforeach
                        @endif
                        <label class="form-label">Sua Senha</label>
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}" />
                    </div>



                    <button type="submit" class="rounded-full bg-pink-600 text-teal-50 w-32 pr-4 pl-4 pt-2 pb-2">Login</button>
                    <br><br>
                    <a href="{{ route('form_cadastro_negocio') }}">Ainda não é cadastrada?</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>