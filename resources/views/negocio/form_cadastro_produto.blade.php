<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastrar Produto • Impulso MEI</title>
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
        <img src="{{ asset('/logotipos/impulsoMei.png') }}" alt="Impulso MEI" class="rounded-circle" style="width:72px;height:72px;object-fit:cover;border:2px solid #fbcfe8;">
      </div>
      <h4 class="mb-3 text-center">Cadastrar novo produto/serviço</h4>
      <form method="POST" enctype="multipart/form-data" action="{{ route('cadastro_produto') }}">
        @csrf
        <div class="row g-3">
          <!-- Primeira divisão -->
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" id="nome" class="form-control @error('nome') is-invalid @enderror" name="nome" placeholder="Nome do produto" value="{{ old('nome') }}">
              <label for="nome">Nome do Produto/Serviço</label>
              @error('nome')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-floating mt-3">
              <textarea id="descricao" class="form-control @error('descricao') is-invalid @enderror" name="descricao" placeholder="Descreva seu produto/serviço" style="height: 140px;">{{ old('descricao') }}</textarea>
              <label for="descricao">Descrição do Produto/Serviço</label>
              @error('descricao')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mt-3">
              <label for="preco" class="form-label">Preço do Produto/Serviço</label>
              <div class="input-group">
                <span class="input-group-text">R$</span>
                <input type="text" inputmode="decimal" id="preco" class="form-control @error('preco') is-invalid @enderror" name="preco" placeholder="0,00" value="{{ old('preco') }}">
                @error('preco')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-text">Informe o preço no formato 0,00</div>
            </div>
          </div>

          <!-- Segunda divisão -->
          <div class="col-md-6">
            <div class="mb-3">
              <label for="foto" class="form-label">Foto do Produto</label>
              <input type="file" id="foto" class="form-control @error('foto') is-invalid @enderror" name="foto" accept="image/*">
              @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <div class="mt-3 text-center">
                <img id="preview" src="#" alt="Pré-visualização" class="rounded-3 d-none" style="max-width: 220px; max-height: 160px; object-fit: cover; border: 2px solid #fbcfe8;"/>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="categoria">Tipo de Produto/Serviço</label>
              <select id="categoria" name="categoria" class="form-select @error('categoria') is-invalid @enderror">
                <option value="" disabled {{ old('categoria') ? '' : 'selected' }}>Selecione uma opção</option>
                <option value="alimentacao" {{ old('categoria')=='alimentacao' ? 'selected' : '' }}>Alimentação (marmitas, doces, bolos...)</option>
                <option value="beleza_estetica" {{ old('categoria')=='beleza_estetica' ? 'selected' : '' }}>Beleza e Estética (cabeleireira, manicure...)</option>
                <option value="moda_vestuario" {{ old('categoria')=='moda_vestuario' ? 'selected' : '' }}>Moda e Vestuário (costura, bordado, confecção...)</option>
                <option value="artesanato" {{ old('categoria')=='artesanato' ? 'selected' : '' }}>Artesanato (crochê, lembrancinhas, papelaria...)</option>
                <option value="saude_bem_estar" {{ old('categoria')=='saude_bem_estar' ? 'selected' : '' }}>Saúde e Bem-estar (massagem, terapias, personal...)</option>
                <option value="educacao_treinamento" {{ old('categoria')=='educacao_treinamento' ? 'selected' : '' }}>Educação e Treinamentos (aulas, cursos...)</option>
                <option value="servicos_domesticos" {{ old('categoria')=='servicos_domesticos' ? 'selected' : '' }}>Serviços Domésticos (faxina, diarista, babá...)</option>
                <option value="eventos_festas" {{ old('categoria')=='eventos_festas' ? 'selected' : '' }}>Eventos e Festas (decoração, buffet, fotografia...)</option>
                <option value="tecnologia_comunicacao" {{ old('categoria')=='tecnologia_comunicacao' ? 'selected' : '' }}>Tecnologia e Comunicação (design, social media, web...)</option>
                <option value="comercio_geral" {{ old('categoria')=='comercio_geral' ? 'selected' : '' }}>Comércio em Geral (loja online, revenda de produtos...)</option>
                <option value="transporte_logistica" {{ old('categoria')=='transporte_logistica' ? 'selected' : '' }}>Transporte e Logística (entregas, motorista de app...)</option>
                <option value="servicos_administrativos" {{ old('categoria')=='servicos_administrativos' ? 'selected' : '' }}>Serviços Administrativos (consultoria, contabilidade...)</option>
                <option value="agro_jardinagem" {{ old('categoria')=='agro_jardinagem' ? 'selected' : '' }}>Agro e Jardinagem (horta, flores, manutenção...)</option>
                <option value="pets" {{ old('categoria')=='pets' ? 'selected' : '' }}>Pets (banho e tosa, adestramento, pet sitter...)</option>
              </select>
              @error('categoria')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>

        <div class="text-center mt-2">
          <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancelar</a>
          <button type="submit" class="btn btn-primary rounded-pill px-4">Cadastrar</button>
        </div>
      </form>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <script>
    // Máscara simples de moeda brasileira e preview de imagem
    (function () {
      const preco = document.getElementById('preco');
      if (preco) {
        preco.addEventListener('input', function (e) {
          const onlyDigits = e.target.value.replace(/\D/g, '');
          const number = (parseInt(onlyDigits, 10) || 0) / 100;
          e.target.value = number.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        });
      }

      const fotoInput = document.getElementById('foto');
      const preview = document.getElementById('preview');
      if (fotoInput && preview) {
        fotoInput.addEventListener('change', function () {
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