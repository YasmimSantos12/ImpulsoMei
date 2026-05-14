<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Esqueceu a Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <div class="container  justify-items-center d-flex justify-content-center align-items-center min-vh-100">
        <div class="row row w-100 justify-content-center">
            <div class="col bg-pink-50 text-pink-500 p-6 justify-items-center rounded-xl shadow-xl/30 col-md-6 col-lg-4">
                <img src="{{ asset('/logotipos/impulsoMei.png') }}" alt="" class="w-24 rounded-full shadow-xl/30">
                <h1 class="">Esqueceu a Senha</h1>
                <br>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        @error('email')
                            <div class="alert alert-warning">{{ $message }}</div>
                        @enderror
                        <label class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required
                            placeholder="E-mail (@gmail.com)" />
                    </div>

                    <button type="submit" class="rounded-full bg-pink-600 text-teal-50 w-32 pr-4 pl-4 pt-2 pb-2">Enviar Link de Reset</button>
                    <br><br>
                    <a href="{{ route('form_login_negocio') }}">Voltar ao Login</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>