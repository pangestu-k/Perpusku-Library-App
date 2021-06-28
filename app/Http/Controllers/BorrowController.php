<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index()
    {
        if(auth()->user()->role == 'member'){
            $borrows = Borrow::latest()->where('user_id', auth()->id())->paginate(15);
        }else{
            $borrows = Borrow::latest()->paginate(15);
        }

        $users = User::all();
        $books = Book::where('stok', '>', 0)->get();
        return view('perpus.borrows.index', compact('borrows', 'users', 'books'));
    }

    public function create()
    {
        return view('perpus.borrow.create');
    }

    public function store()
    {
        if(auth()->user()->role !== 'member'){
            if(in_array(request('user_id'),Borrow::pluck('user_id')->toArray()) && in_array(request('book_id'),Borrow::pluck('book_id')->toArray())){
                session()->flash('illegal','dia sudah meminjam buku ini');
                return back();
            }
        }else{
            if(in_array(auth()->id(),Borrow::pluck('user_id')->toArray()) && in_array(request('book_id'),Borrow::pluck('book_id')->toArray())){
                session()->flash('illegal','anda sudah meminjam buku ini');
                return back();
            }
        }


        $this->validate(request(), [
            'user_id' => 'required',
            'book_id' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
        ]);

        $data = request()->except([]);

        if(auth()->user()->role == 'member'){
            $data['status'] = 'booking';
            $data['keterangan'] = 'menunggu konfirmasi petugas';
        }else{
            $data['status'] = 'pinjam';
            $data['keterangan'] = 'buku masih dipinjam';
        }

        $borrow = Borrow::create($data);

        $borrow->book->where('id', $data['book_id'])
        ->update([ 'stok' => ($borrow->book->stok - 1)]);

        session()->flash('success', 'Buku berhasi dipinjam');
        return redirect()->route('perpusku.borrow.index');
    }

    public function kembali($id)
    {
        $kembaliBuku = Borrow::find($id);
        $kembaliBuku->update([
            'status' => 'kembali',
            'keterangan' => 'Buku Sudah kembali',
        ]);

        $kembaliBuku->book->where('id', $kembaliBuku->book_id)->update(['stok' => $kembaliBuku->book->stok + 1]);
        $kembaliBuku->delete();
        return back();
    }

    public function denda($id)
    {
        $dendaBuku = Borrow::find($id);
        $dendaBuku->update(['keterangan' => 'cepat kembalikan buku !!!, anda diberi denda']);
        $dendaBuku->user->update([
            'denda' => $dendaBuku->user->denda + 3000,
        ]);
        session()->flash('success', 'Pemberian denda berhasil');
        return back();
    }

    public function konfirmasi($id)
    {
        $konfiBuku =  Borrow::find($id);
        $konfiBuku->update([
            'status' => 'pinjam',
            'keterangan' => 'Buku masih dipinjam',
        ]);

        return back();
    }

    public function destroy($id)
    {
        $borrowHapus = Borrow::find($id)->delete();
        session()->flash('success', 'Berhasil dihapus');
        return back();
    }

    public function print()
    {
        $borrows = Borrow::latest()->paginate(15);
        return view('perpus.borrows.print', compact('borrows'));
    }
}
