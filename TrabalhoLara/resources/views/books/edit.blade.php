<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro: {{ $book->title }}</title>
</head>
<body>
    <h1>Editar Livro</h1>
    <a href="{{ route('books.index') }}">Voltar para a Lista</a>

    {{-- Exibir erros de validação --}}
    @if ($errors->any())
        <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ATENÇÃO: Usar @method('PUT') e enctype="multipart/form-data" --}}
    <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Indica que este é um método de UPDATE --}}

        <label for="title">Título:</label><br>
        {{-- Preenche o campo com o valor atual ou o valor 'old' após erro de validação --}}
        <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" required><br><br>

        <label for="author">Autor:</label><br>
        <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" required><br><br>

        <label for="isbn">ISBN (Máx. 13 caracteres, deve ser único):</label><br>
        <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}" required><br><br>

        <label for="publication_year">Ano de Publicação:</label><br>
        <input type="number" name="publication_year" id="publication_year" value="{{ old('publication_year', $book->publication_year) }}" required><br><br>

        {{-- Visualização e Substituição da Capa --}}
        <label>Capa Atual:</label><br>
        @if ($book->cover_image_path)
            <img src="{{ asset('storage/' . $book->cover_image_path) }}" alt="Capa Atual" style="width: 100px; height: auto;"><br>
            <p>Selecione um novo arquivo para substituir a capa.</p>
        @else
            <p>Nenhuma capa cadastrada.</p>
        @endif

        <label for="cover_image">Nova Capa do Livro (PNG ou JPG):</label><br>
        <input type="file" name="cover_image" id="cover_image" accept="image/png, image/jpeg"><br><br>

        <button type="submit" style="padding: 10px; background-color: #FFA500; color: white; border: none; cursor: pointer;">
            Salvar Alterações
        </button>
    </form>
</body>
</html>