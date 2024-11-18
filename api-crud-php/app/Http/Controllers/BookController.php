<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Exception;

class BookController extends Controller
{

    
    public function index(): JsonResponse
    {
        try {
            $allBooks = Book::all();

            if ($allBooks->isEmpty()) {
                return response()->json(['message' => 'Nenhum livro encontrado!'], 200);
            }

            return response()->json($allBooks, 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ocorreu um erro ao buscar os livros!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(BookRequest $request): JsonResponse
    {
        try {
            $book = Book::create($request->validated());

            return response()->json([
                'message' => 'Livro criado com sucesso!',
                'data' => $book,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao criar o livro!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $book = Book::find($id);

            if (!$book) {
                return response()->json(['message' => 'Nenhum livro encontrado com esse ID!'], 404);
            }

            return response()->json($book, 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ocorreu um erro ao buscar o livro!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(BookRequest $request, int $id): JsonResponse
    {
        try {
            $book = Book::find($id);

            if (!$book) {
                return response()->json(['message' => 'Nenhum livro encontrado com esse ID!'], 404);
            }

            $book->update($request->validated());

            return response()->json([
                'message' => 'Livro atualizado com sucesso!',
                'data' => $book,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar o livro!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $book = Book::find($id);

            if (!$book) {
                return response()->json(['message' => 'Nenhum livro encontrado com esse ID!'], 404);
            }

            $book->delete();

            return response()->json(['message' => 'Livro deletado com sucesso!'], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao deletar o livro!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}