<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Importe a Facade Storage

class BookController extends Controller
{
    /**
     * Display a listing of the resource (READ).
     */
    public function index()
    {
        // 1. Busca todos os livros cadastrados
        $books = Book::all();

        // 2. Retorna a view de listagem, passando a coleção de livros
        return view('books.index', [
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource (CREATE - Formulário).
     */
    public function create()
    {
        // Retorna a view do formulário de criação (resources/views/books/create.blade.php)
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage (CREATE - Salvamento).
     */
    public function store(Request $request)
    {
        // 1. VALIDAÇÃO DOS DADOS (Requisito 6)
        $validated = $request->validate([
            'title'            => 'required|string|max:200',
            'author'           => 'required|string|max:100',
            'isbn'             => 'required|string|unique:books|max:13',
            'publication_year' => 'required|integer|min:1900|max:' . date('Y'),
            // Requisito 4: Upload de arquivos apenas PNG ou JPG, máximo 2MB
            'cover_image'      => 'nullable|image|mimes:png,jpg|max:2048',
        ]);

        $imagePath = null;
        
        // 2. TRATAMENTO DO UPLOAD DE ARQUIVOS (Requisito 4)
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('covers', 'public');
        }

        // 3. CRIAÇÃO DO REGISTRO NO BANCO DE DADOS
        $book = Book::create([
            'title'            => $validated['title'],
            'author'           => $validated['author'],
            'isbn'             => $validated['isbn'],
            'publication_year' => $validated['publication_year'],
            'cover_image_path' => $imagePath, // Salva o caminho
        ]);

        // 4. FEEDBACK E REDIRECIONAMENTO (Requisito 6)
        return redirect()->route('books.index')
                         ->with('success', 'Livro "' . $book->title . '" cadastrado com sucesso!');
    }

    /**
     * Display the specified resource. (Não obrigatório para o CRUD básico)
     */
    public function show(Book $book)
    {
        // Este método não é obrigatório no CRUD, mas pode ser implementado.
    }

    /**
     * Show the form for editing the specified resource (UPDATE - Formulário).
     */
    public function edit(Book $book)
    {
        // Retorna a view de edição, passando o objeto Book
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage (UPDATE - Salvamento).
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:200',
            'author'           => 'required|string|max:100',
            // O campo 'isbn' é único, MAS ignora o ID do livro ($book->id) que estamos editando
            'isbn'             => 'required|string|max:13|unique:books,isbn,' . $book->id,
            'publication_year' => 'required|integer|min:1900|max:' . date('Y'),
            // 'cover_image' é opcional no update, mas se enviado, deve ser PNG ou JPG
            'cover_image'      => 'nullable|image|mimes:png,jpg|max:2048',
        ]);

        $imagePath = $book->cover_image_path; // Mantém o caminho da imagem atual por padrão
        
        if ($request->hasFile('cover_image')) {
            
            // A. Deletar a imagem antiga do disco (Boas práticas)
            if ($book->cover_image_path) {
                Storage::disk('public')->delete($book->cover_image_path);
            }

            $imagePath = $request->file('cover_image')->store('covers', 'public');
        }

        // 3. ATUALIZAÇÃO DO REGISTRO NO BANCO DE DADOS
        $book->update([
            'title'            => $validated['title'],
            'author'           => $validated['author'],
            'isbn'             => $validated['isbn'],
            'publication_year' => $validated['publication_year'],
            'cover_image_path' => $imagePath, // Atualiza para o novo caminho ou mantém o antigo
        ]);

        return redirect()->route('books.index')
                         ->with('success', 'Livro "' . $book->title . '" atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage (DELETE).
     */
    public function destroy(Book $book)
    {
        // 1. Deletar a imagem associada do disco (se houver)
        if ($book->cover_image_path) {
            Storage::disk('public')->delete($book->cover_image_path);
        }

        // 2. Deletar o registro do banco de dados
        $book->delete();

        // 3. FEEDBACK E REDIRECIONAMENTO
        return redirect()->route('books.index')
                         ->with('success', 'Livro "' . $book->title . '" excluído com sucesso!');
    }
}