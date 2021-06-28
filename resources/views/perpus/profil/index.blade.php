@extends('layouts.app')

@section('content')
    <div class="grid-padding text-center">

        @if (session()->get('bayar'))
            <div class="alert p-2">
                {{ session()->get('bayar') }} !
            </div>
        @endif

        @if (request('ubah'))
            <div class="container mb-4">
                <div class="card" style="position: relative">
                    <a href="{{ route('perpusku.profil.index') }}" class="close" style="position: absolute;top:0px;right:0px;">
                        <span>
                            &times;
                        </span>
                    </a>
                    <div class="card-header">
                        <div class="card-title alert alert-primary">
                            P r o f i l
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('perpusku.profil.update', $user) }}" method="POST">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control mb-4" placeholder="Nama" name="name" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="text-danger text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control mb-4" placeholder="Email" name="email" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="text-danger text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Password (isi jika ingin mengganti)</label>
                                <input type="password" class="form-control mb-4" placeholder="password" name="password" value="">
                                @error('password')
                                    <div class="text-danger text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Ubah Profil</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="mb-5">
                <img class="rounded" src="https://ui-avatars.com/api/?name={{ $user->email }}&background=random" alt="">
                <h4 class="d-inline">{{ auth()->user()->name }}</h4>

                <form action="{{ route('perpusku.profil.index') }}" class="d-inline" method="GET">
                    <input type="hidden" name="ubah" value="ubah">
                    <button type="submit"  class="btn btn-sm btn-primary rounded-pill">Ubah</button>
                </form>
            </div>

            <ul>
                <hr>
                <li class="decoration-none text-muted" style="list-style: none"><p>Email : {{ $user->email }}</p></li>
                <hr>
                <li class="decoration-none text-muted" style="list-style: none"><p>Role : {{ $user->role == 'petugas' ? 'admin' : $user->role }}</p></li>
                <hr>
                @if($user->role == 'member')
                    <li class="decoration-none text-muted" style="list-style: none"><p>Denda : <b>Rp. </b> {{ number_format($user->denda) }}, 00</p></li>
                    <hr>
                @endif
            </ul>
            <br>
        @endif

        @if (auth()->user()->role !== 'member')
            @if (request('id'))
                <div class="container">
                    <div class="card" style="position: relative">
                        <a href="{{ route('perpusku.profil.index') }}" class="close" style="position: absolute;top:0px;right:0px;">
                            <span>
                                &times;
                            </span>
                        </a>
                        <div class="card-header alert alert-success">
                            <div class="card-title">
                                Pembayaran Denda
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('perpusku.profil.bayar',request('id')) }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <input type="number" name="bayar" value="" class="form-control" placeholder="Masukan uang" >

                                    @error('bayar')
                                        <div class="text text-sm text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Bayar Denda &dollar;</button>
                                </div>
                            </form>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Data Peminjam
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach (App\Models\User::where('role','member')->get() as $user)
                            <div class="card-text p2 alert alert-secondary" style="position: relative">
                                Nama : {{ $user->name }} |
                                Denda : <b>Rp. </b>{{ number_format($user->denda) }}
                                @if ($user->denda !== 0)
                                    <form action="{{ route('perpusku.profil.index') }}" method="GET">
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-success btn-sm" style="position: absolute;right:0px; top:20px;">Bayar Denda !</button>
                                    </form>
                                @else
                                    <button type="button" disabled class="btn btn-secondary btn-sm" style="position: absolute;right:0px;">Tidak ada Denda !</button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif



    </div>
@endsection
