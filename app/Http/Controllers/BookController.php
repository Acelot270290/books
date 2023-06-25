<?php

namespace App\Http\Controllers;


use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Books;

  

class BookController extends Controller
{
    public function __construct(books $books) {
        $this->books = $books;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Buscar todos os livros do banco de dados
        $books = Books::all();
        
        // Retornar a resposta JSON contendo os livros
        return response()->json($books, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Name' => 'required',
            'ISBN' => 'required|numeric',
            'Value' => 'required|numeric',
        ]);
    
        $book = Books::create($data);
    
        return response()->json($book, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $book = BookS::findOrFail($id);
            return response()->json($book, 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    
    
    public function update(Request $request, $id)
    {
        try {
            $book = Books::findOrFail($id);
    
            $this->validate($request, [
                'Name' => 'required',
                'ISBN' => 'numeric',
                'Value' => 'numeric',
            ]);
    
            $book->Name = $request->input('Name');
            $book->ISBN = $request->input('ISBN');
            $book->Value = $request->input('Value');
    
            $book->save();
    
            return response()->json($book, 200);
        } catch (ValidationException $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $book = Books::findOrFail($id);
            
            $book->delete();
    
            return response()->json(['message' => 'Livro excluído com sucesso'], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }
    }
}
