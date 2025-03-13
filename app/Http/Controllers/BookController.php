<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB

class BookController extends Controller
{
    // Fetch all books
    public function index()
    {
        $books = DB::table('books')->get();
        return response()->json($books);
    }

    // Store a new book
    public function store(Request $request)
    {
        $bookId = DB::table('books')->insertGetId([
            'name' => $request->input('name'),
            'author' => $request->input('author'),
            'status' => $request->input('status'),
            'publish_date' => $request->input('publish_date'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['id' => $bookId, 'message' => 'Book created successfully'], 201);
    }

    // Show a single book by ID
    public function show($id)
    {
        $book = DB::table('books')->where('id', $id)->first();
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book);
    }

    // Update a book
    public function update(Request $request, $id)
    {
        $book = DB::table('books')->where('id', $id)->first();
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        DB::table('books')->where('id', $id)->update([
            'name' => $request->input('name'),
            'author' => $request->input('author'),
            'status' => $request->input('status'),
            'publish_date' => $request->input('publish_date'),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Book updated successfully']);
    }

    // Delete a book
    public function destroy($id)
    {
        $book = DB::table('books')->where('id', $id)->first();
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        DB::table('books')->where('id', $id)->delete();
        return response()->json(['message' => 'Book deleted successfully']);
    }
}
