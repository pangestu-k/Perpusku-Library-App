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
            if(in_array(request('user_id'),Borrow::pluck('user_id')->toArray()) && in_array(request('book_id'),Borrow::pluck('book_id')->toArray()) && !in_array(Borrow::where('user_id',request('user_id'))->where('book_id', request('book_id'))->latest()->first()->status,['kembali','booking'])){
                session()->flash('illegal','dia sudah meminjam buku ini');
                return back();
            }
        }else{
            // dd(!in_array('pinjam',['kembali','booking']));
            // dd(!in_array(Borrow::where('user_id',request('user_id'))->where('book_id', request('book_id'))->latest()->first()->status,['kembali','booking']));
            if(in_array(auth()->id(),Borrow::pluck('user_id')->toArray()) && in_array(request('book_id'),Borrow::pluck('book_id')->toArray())){
                $statusChecked = Borrow::where('user_id',request('user_id'))->where('book_id', request('book_id'))->pluck('status')->toArray();
                if(in_array('pinjam',$statusChecked)){
                    session()->flash('illegal','anda sudah meminjam buku ini');
                    return back();
                }elseif(in_array('booking',$statusChecked)){
                    session()->flash('illegal','buku sedang anda booking');
                    return back();
                }
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
        return back();
    }

    public function denda($id)
    {
        $dendaBuku = Borrow::find($id);
        $dendaBuku->update(['keterangan' => 'cepat kembalikan buku !!!, anda diberi denda']);
        $dendaBuku->user->update([
            'denda' => $dendaBuku->user->denda + 500,
        ]);
        session()->flash('success', 'Pemberian denda berhasil');
        return back();
    }

    public function konfirmasi($id)
    {
        $konfiBuku =  Borrow::find($id);

        if(Book::find($konfiBuku->book_id)->stok <= 0){
            $konfiBuku->update([
                'keterangan' => 'Buku terakhir sudah dipinjam user lain, silakan pinjam buku lain',
            ]);
            session()->flash('illegal','Buku terakhir sudah dipinjam user lain, silakan pinjam buku lain');
            return back();
        }

        $konfiBuku->update([
            'status' => 'pinjam',
            'keterangan' => 'Buku masih dipinjam',
        ]);

        $konfiBuku->book->where('id', $konfiBuku->book_id)
        ->update([ 'stok' => ($konfiBuku->book->stok - 1)]);

        return back();
    }

    public function destroy($id)
    {
        $borrowHapus = Borrow::find($id);
        if($borrowHapus->status == 'kembali' || $borrowHapus->status == 'booking' ){
            $borrowHapus->delete();
        }else{
            $bookStok = Book::find($borrowHapus->book_id);
            $bookStok->stok = $bookStok->stok + 1;
            $bookStok->save();
            $borrowHapus->delete();
        }

        session()->flash('success', 'Berhasil dihapus');
        return back();
    }

    public function print()
    {
        $borrows = Borrow::latest()->paginate(15);
        return view('perpus.borrows.print', compact('borrows'));
    }
}
