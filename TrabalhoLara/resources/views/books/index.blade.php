<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Livros</title>
</head>
<body>
    <h1>📚 Lista de Livros Cadastrados</h1>

    {{-- Exibe a mensagem de sucesso se houver (Requisito: Exibir mensagens de sucesso) --}}
    @if (session('success'))
        <p style="color: green; border: 1px solid green; padding: 10px;">
            {{ session('success') }}
        </p>
    @endif

    {{-- Link para o Formulário de Criação --}}
    <p>
        <a href="{{ route('books.create') }}">
            <button>➕ Adicionar Novo Livro</button>
        </a>
    </p>

    @if($books->isEmpty())
        <p>Nenhum livro cadastrado. Comece adicionando um novo.</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>ID</th>
                    <th>Capa</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Ano</th>
                    <th>ISBN</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop para exibir cada livro --}}
                @foreach ($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>
                        {{-- Exibe a capa se o caminho existir --}}
                        @if ($book->cover_image_path)
                            {{-- Acessa a imagem pelo link simbólico criado com artisan storage:link --}}
                            <img src="{{ asset('storage/' . $book->cover_image_path) }}" alt="Capa do Livro" style="width: 50px; height: auto;">
                        @else
                            Sem Capa
                        @endif
                    </td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publication_year }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>
                        {{-- Links para Ações --}}
                        <a href="{{ route('books.edit', $book) }}">Editar</a> |
                        
                        {{-- Formulário de DELEÇÃO (Deve ser um POST/DELETE) --}}
                        <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este livro?')" style="color: red; background: none; border: none; padding: 0; cursor: pointer;">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>