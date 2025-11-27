<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Novo Livro</title>
</head>
<body>
    <h1>Adicionar Novo Livro</h1>
    <a href="{{ route('books.index') }}">Voltar para a Lista</a>

    {{-- Exibe erros de validação se houver (Requisito: Utilizar validação adequada) --}}
    @if ($errors->any())
        <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Requisito 4: enctype="multipart/form-data" é obrigatório para o campo de arquivo --}}
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf {{-- Token de segurança obrigatório --}}

        <label for="title">Título:</label><br>
        <input type="text" name="title" id="title" value="{{ old('title') }}" required><br><br>

        <label for="author">Autor:</label><br>
        <input type="text" name="author" id="author" value="{{ old('author') }}" required><br><br>

        <label for="isbn">ISBN (Máx. 13 caracteres, deve ser único):</label><br>
        <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}" required><br><br>

        <label for="publication_year">Ano de Publicação:</label><br>
        <input type="number" name="publication_year" id="publication_year" value="{{ old('publication_year') }}" required><br><br>

        {{-- Campo para o requisito de Upload de Arquivos --}}
        <label for="cover_image">Capa do Livro (Apenas PNG ou JPG):</label><br>
        <input type="file" name="cover_image" id="cover_image" accept="image/png, image/jpeg"><br><br>

        <button type="submit" style="padding: 10px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">
            Salvar Livro
        </button>
    </form>
</body>
</html>