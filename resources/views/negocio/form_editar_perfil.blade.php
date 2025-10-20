<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Perfil • Impulso MEI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-vh-100 bg-gradient-to-br from-pink-50 to-rose-100">
  @include('negocio.nav')

  <div class="container py-4 py-md-5">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
      <div class="card-body p-4 p-md-5 bg-white/80 text-body">
        <div class="text-center mb-3">
          <img src="{{ $user->logotipo
            ? (\Illuminate\Support\Str::startsWith($user->logotipo, ['http://','https://'])
                ? $user->logotipo
                : (\Illuminate\Support\Str::contains($user->logotipo, 'logotipos/')
                    ? asset($user->logotipo)
                    : asset('logotipos/' . $user->logotipo)))
            : asset('/logotipos/impulsoMei.png') }}"
            alt="{{ $user->name_negocio }}"
            onerror="this.onerror=null;this.src='{{ asset('/logotipos/impulsoMei.png') }}'"
            class="rounded-circle" style="width:72px;height:72px;object-fit:cover;border:2px solid #fbcfe8;">
        </div>
        <h4 class="mb-3 text-center">Editar perfil</h4>
        <form method="POST" enctype="multipart/form-data" action="{{ route('perfil.atualizar') }}">
          @csrf
          @method('PUT')
          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" id="name_user" class="form-control @error('name_user') is-invalid @enderror" name="name_user" placeholder="Seu nome" value="{{ old('name_user', $user->name_user) }}">
                <label for="name_user">Seu nome</label>
                @error('name_user')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Seu e-mail" value="{{ old('email', $user->email) }}">
                <label for="email">E-mail</label>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" id="name_negocio" class="form-control @error('name_negocio') is-invalid @enderror" name="name_negocio" placeholder="Nome do negócio" value="{{ old('name_negocio', $user->name_negocio) }}">
                <label for="name_negocio">Nome do negócio</label>
                @error('name_negocio')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" id="telefone" class="form-control @error('telefone') is-invalid @enderror" name="telefone" placeholder="Telefone" value="{{ old('telefone', $user->telefone) }}">
                <label for="telefone">Telefone</label>
                @error('telefone')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="col-12">
              <div class="form-floating">
                <input type="text" id="endereco" class="form-control @error('endereco') is-invalid @enderror" name="endereco" placeholder="Endereço" value="{{ old('endereco', $user->endereco) }}">
                <label for="endereco">Endereço</label>
                @error('endereco')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <label for="type_servico" class="form-label">Tipo de Serviço/Negócio</label>
              <select id="type_servico" name="type_servico" class="form-select @error('type_servico') is-invalid @enderror">
                <option value="" disabled {{ old('type_servico', $user->type_servico) ? '' : 'selected' }}>Selecione uma opção</option>
                <option value="alimentacao" {{ old('type_servico', $user->type_servico)=='alimentacao' ? 'selected' : '' }}>Alimentação (marmitas, doces, bolos...)</option>
                <option value="beleza_estetica" {{ old('type_servico', $user->type_servico)=='beleza_estetica' ? 'selected' : '' }}>Beleza e Estética (cabeleireira, manicure...)</option>
                <option value="moda_vestuario" {{ old('type_servico', $user->type_servico)=='moda_vestuario' ? 'selected' : '' }}>Moda e Vestuário (costura, bordado, confecção...)</option>
                <option value="artesanato" {{ old('type_servico', $user->type_servico)=='artesanato' ? 'selected' : '' }}>Artesanato (crochê, lembrancinhas, papelaria...)</option>
                <option value="saude_bem_estar" {{ old('type_servico', $user->type_servico)=='saude_bem_estar' ? 'selected' : '' }}>Saúde e Bem-estar (massagem, terapias, personal...)</option>
                <option value="educacao_treinamento" {{ old('type_servico', $user->type_servico)=='educacao_treinamento' ? 'selected' : '' }}>Educação e Treinamentos (aulas, cursos...)</option>
                <option value="servicos_domesticos" {{ old('type_servico', $user->type_servico)=='servicos_domesticos' ? 'selected' : '' }}>Serviços Domésticos (faxina, diarista, babá...)</option>
                <option value="eventos_festas" {{ old('type_servico', $user->type_servico)=='eventos_festas' ? 'selected' : '' }}>Eventos e Festas (decoração, buffet, fotografia...)</option>
                <option value="tecnologia_comunicacao" {{ old('type_servico', $user->type_servico)=='tecnologia_comunicacao' ? 'selected' : '' }}>Tecnologia e Comunicação (design, social media, web...)</option>
                <option value="comercio_geral" {{ old('type_servico', $user->type_servico)=='comercio_geral' ? 'selected' : '' }}>Comércio em Geral (loja online, revenda de produtos...)</option>
                <option value="transporte_logistica" {{ old('type_servico', $user->type_servico)=='transporte_logistica' ? 'selected' : '' }}>Transporte e Logística (entregas, motorista de app...)</option>
                <option value="servicos_administrativos" {{ old('type_servico', $user->type_servico)=='servicos_administrativos' ? 'selected' : '' }}>Serviços Administrativos (consultoria, contabilidade...)</option>
                <option value="agro_jardinagem" {{ old('type_servico', $user->type_servico)=='agro_jardinagem' ? 'selected' : '' }}>Agro e Jardinagem (horta, flores, manutenção...)</option>
                <option value="pets" {{ old('type_servico', $user->type_servico)=='pets' ? 'selected' : '' }}>Pets (banho e tosa, adestramento, pet sitter...)</option>
              </select>
              @error('type_servico')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="logotipo" class="form-label">Logotipo</label>
              <input type="file" id="logotipo" class="form-control @error('logotipo') is-invalid @enderror" name="logotipo" accept="image/*">
              @error('logotipo')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <div class="mt-3 text-center">
                <img id="preview-logotipo" src="#" alt="Pré-visualização" class="rounded-3 d-none" style="max-width: 220px; max-height: 160px; object-fit: cover; border: 2px solid #fbcfe8;"/>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Nova senha">
                <label for="password">Nova senha (opcional)</label>
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Confirmar senha">
                <label for="password_confirmation">Confirmar senha</label>
              </div>
            </div>
          </div>

          <div class="text-center mt-3">
            <a href="{{ route('minhas_informacoes') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancelar</a>
            <button type="submit" class="btn btn-primary rounded-pill px-4">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <script>
    (function () {
      // Máscara de telefone brasileira dinâmica: (99) 9999-9999 ou (99) 99999-9999
      const tel = document.getElementById('telefone');
      if (tel) {
        const applyMask = (value) => {
          const digits = (value || '').replace(/\D/g, '').slice(0, 11);
          if (digits.length <= 10) {
            return digits
              .replace(/(\d{2})(\d)/, '($1) $2')
              .replace(/(\d{4})(\d)/, '$1-$2')
              .replace(/(-\d{4})\d+?$/, '$1');
          }
          return digits
            .replace(/(\d{2})(\d)/, '($1) $2')
            .replace(/(\d{5})(\d)/, '$1-$2')
            .replace(/(-\d{4})\d+?$/, '$1');
        };
        tel.addEventListener('input', (e) => { e.target.value = applyMask(e.target.value); });
        tel.value = applyMask(tel.value);
      }

      // Preview de imagem do logotipo
      const inputLogo = document.getElementById('logotipo');
      const preview = document.getElementById('preview-logotipo');
      if (inputLogo && preview) {
        inputLogo.addEventListener('change', function () {
          const file = this.files && this.files[0];
          if (!file) { preview.classList.add('d-none'); return; }
          const reader = new FileReader();
          reader.onload = function (ev) {
            preview.src = ev.target.result;
            preview.classList.remove('d-none');
          };
          reader.readAsDataURL(file);
        });
      }
    })();
  </script>
</body>

</html>

