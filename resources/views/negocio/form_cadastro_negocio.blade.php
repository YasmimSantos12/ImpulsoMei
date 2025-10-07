<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastre seu Negócio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <div class="container  justify-items-center d-flex justify-content-center align-items-center min-vh-100">
        <div class="row row w-100 justify-content-center">
            <div class="col bg-pink-50 text-pink-500 p-6 justify-items-center rounded-xl shadow-xl/30 col-md-6 col-lg-4">
                <img src="{{ asset('/logotipos/impulsoMei.png') }}" alt="" class="w-24 rounded-full shadow-xl/30">
                <h1>Cadastre seu Negócio</h1>
                <form method="POST" action="{{ route('cadastro_negocio') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        @if($errors->has('name_user'))
                            @foreach($errors->get('name_user') as $error)
                                <div class="alert alert-warning">{{ $error }}</div>
                            @endforeach
                        @endif

                        <label class="form-label">Seu Nome Completo</label>
                        <input type="text" class="form-control " name="name_user" value="{{ old('name_user') }}" />
                    </div>
                    <div class="mb-3">
                        @if($errors->has('email'))
                            @foreach($errors->get('email') as $error)
                                <div class="alert alert-warning">{{ $error }}</div>
                            @endforeach
                        @endif
                        <label class="form-label">E-mail</label>
                        <input type="email" class="form-control " name="email" value="{{ old('email') }}" placeholder="E-mail (@gmail.com)"/>
                    </div>
                    <div class="mb-3">
                        @if($errors->has('password'))
                            @foreach($errors->get('password') as $error)
                                <div class="alert alert-warning">{{ $error }}</div>
                            @endforeach
                        @endif
                        <label class="form-label">Defina uma senha de no minímo 8 caracteres</label>
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}" />
                    </div>
                    <div class="mb-3">
                        @if($errors->has('telefone'))
                            @foreach($errors->get('telefone') as $error)
                                <div class="alert alert-warning">{{ $error }}</div>
                            @endforeach
                        @endif
                        <label class="form-label">Telefone - Celular</label>
                        <input type="text" class="form-control" name="telefone" value="{{ old('telefone') }}" placeholder="(99)9999-9999" />
                    </div>
                    <div class="mb-3">
                         @if($errors->has('endereco'))
                            @foreach($errors->get('endereco') as $error)
                                <div class="alert alert-warning">{{ $error }}</div>
                            @endforeach
                        @endif
                        <label class="form-label">Endereço</label>
                        <input type="text" class="form-control" name="endereco" value="{{ old('endereco') }}" placeholder="Setor Bairro N°" />
                    </div>
                    <div class="mb-3">
                        @if($errors->has('name_negocio'))
                            @foreach($errors->get('name_negocio') as $error)
                                <div class="alert alert-warning">{{ $error }}</div>
                            @endforeach
                        @endif
                        <label class="form-label">Nome do seu Negócio</label>
                        <input type="text" class="form-control" name="name_negocio" value="{{ old('name_negocio') }}" />
                    </div>
                    <div class="mb-3">
                        @if($errors->has('type_servico'))
                            @foreach($errors->get('type_servico') as $error)
                                <div class="alert alert-warning">{{ $error }}</div>
                            @endforeach
                        @endif
                        <label class="form-label">Tipo de Serviço/Negócio</label>
                        <select name="type_servico" class="form-select">
                            <option value="" disabled selected>Selecione uma opção</option>
                            <option value="alimentacao">Alimentação (marmitas, doces, bolos...)</option>
                            <option value="beleza_estetica">Beleza e Estética (cabeleireira, manicure...)</option>
                            <option value="moda_vestuario">Moda e Vestuário (costura, bordado, confecção...)</option>
                            <option value="artesanato">Artesanato (crochê, lembrancinhas, papelaria...)</option>
                            <option value="saude_bem_estar">Saúde e Bem-estar (massagem, terapias, personal...)</option>
                            <option value="educacao_treinamento">Educação e Treinamentos (aulas, cursos...)</option>
                            <option value="servicos_domesticos">Serviços Domésticos (faxina, diarista, babá...)</option>
                            <option value="eventos_festas">Eventos e Festas (decoração, buffet, fotografia...)</option>
                            <option value="tecnologia_comunicacao">Tecnologia e Comunicação (design, social media,
                                web...)</option>
                            <option value="comercio_geral">Comércio em Geral (loja online, revenda de produtos...)
                            </option>
                            <option value="transporte_logistica">Transporte e Logística (entregas, motorista de app...)
                            </option>
                            <option value="servicos_administrativos">Serviços Administrativos (consultoria,
                                contabilidade...)</option>
                            <option value="agro_jardinagem">Agro e Jardinagem (horta, flores, manutenção...)</option>
                            <option value="pets">Pets (banho e tosa, adestramento, pet sitter...)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        @if($errors->has('logotipo'))
                            @foreach($errors->get('logotipo') as $error)
                                <div class="alert alert-warning">{{ $error }}</div>
                            @endforeach
                        @endif
                        <label class="form-label">Imagem de Capa do seu Negócio</label>
                        <input type="file" class="form-control" name="logotipo" />
                    </div>
                    <button type="submit" class="rounded-full bg-pink-600 text-teal-50 w-32 pr-4 pl-4 pt-2 pb-2">Cadastrar</button>
                    <br><br>
                    <a href="{{ route('form_login_negocio') }}">Fazer Login</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>