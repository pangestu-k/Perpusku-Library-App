<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('perpus.profil.index', compact('user'));
    }

    public function update(User $id)
    {
        $password = request('password') == '' ? $id->password : Hash::make(request('password')) ;

        $id->update([
            'name' => request('name'),
            'email' => request('email'),
            'password' => $password
        ]);

        return redirect()->route('perpusku.profil.index');
    }

    public function bayar($id)
    {
        $this->validate(request(),[
            'bayar' => 'required|numeric|alpha_num'
        ]);

        $user = User::find($id);

        if($user->denda > request('bayar')){
            session()->flash('bayar', 'Uang Kurang');
            return back();
        }elseif($user->denda == request('bayar')){
            $bayar = $user->denda - request('bayar');
            session()->put('kembalian',0);
        }else{
            $bayar = request('bayar') - $user->denda;
            session()->put('kembalian',$bayar);
            $bayar = 0;
        }

        User::where('id', $user->id)->update([
            'denda' => $bayar,
        ]);

        session()->flash('bayar', 'pembayaran berhasil kembalian : Rp. ' . session()->get('kembalian'));
        return redirect()->route('perpusku.profil.index');

    }
}
