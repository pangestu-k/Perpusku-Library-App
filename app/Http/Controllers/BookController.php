<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        if(auth()->user()->role !== 'member'){
            $books = Book::latest()->paginate(15);
            return view('perpus.books.index', compact('books'));
        }else{
            $books = Book::latest()->paginate(15);
            return view('perpus.books.indexUser', compact('books'));
        }

    }

    public function store()
    {
        $attr = $this->bookValidate();
        $attr['photo'] = request()->hasFile('photo') ? request()->file('photo')->storeAs('public/perpusku', request()->file('photo')->hashName()) : 'null';

        Book::create($attr);
        session()->flash('success', 'Buku berhasil ditambahakan');
        return redirect()->route('perpusku.book.index');
    }

    public function edit($id)
    {
        $book = Book::find($id);
        return view('perpus.books.edit', compact('book'));
    }

    public function update($id)
    {
        $bookUpdate = Book::find($id);
        $attr = $this->bookValidate();

        if(request()->hasFile('photo')){
            $attr['photo'] = request()->file('photo')->storeAs('public/perpusku', request()->file('photo')->hashName());
            Storage::delete($bookUpdate->photo);
        }else{
            $attr['photo'] = $bookUpdate->photo;
        }

        $bookUpdate->update($attr);
        session()->flash('success', 'Buku berhasil diubah');
        return redirect()->route('perpusku.book.index');
    }

    public function destroy($id)
    {
        $bookHapus = Book::find($id);

        $bookHapus->delete();
        session()->flash('success', 'Buku berhasil dihapus');
        return redirect()->route('perpusku.book.index');
    }

    public function bookValidate()
    {
        return request()->validate([
            'title' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required|numeric',
            'jenis_buku' => 'required',
            'photo' => 'image',
            'stok' => 'required',
            'deskripsi' => 'required',
        ]);
    }
}
