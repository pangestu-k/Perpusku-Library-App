@extends('layouts.app')

@section('content')

<div class="grid-padding text-left col-md-8 mx-auto">
    <form action="{{ route('perpusku.book.edit', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="">Judul</label>
            <input type="text" class="form-control mb-4" placeholder="Judul" name="title" value="{{ old('title', $book->title) }}">
            @error('title')
                <div class="text-danger text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group ">
            <label for="">Pengarang</label>
            <input type="text" class="form-control mb-4" placeholder="Pengaran" name="pengarang" value="{{ old('pengarang', $book->pengarang) }}">
            @error('pengarang')
                <div class="text-danger text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group ">
            <label for="">Tahun terbit</label>
            <input type="number" class="form-control mb-4" placeholder="tahun terbit contoh 2020" name="tahun_terbit" value="{{ old('tahun_terbit', $book->tahun_terbit) }}">
            @error('tahun_terbit')
                <div class="text-danger text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group ">
            <label for="">Stok Buku</label>
            <input type="number" class="form-control mb-4" placeholder="Stok Buku" name="stok" value="{{ old('stok', $book->stok) }}">
            @error('stok')
                <div class="text-danger text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group ">
            <label for="">Jenis Buku</label>
            <select name="jenis_buku" id="jenis_buku" class="form-control mb-4">
                <option disabled selected>Pilih</option>
                @foreach (App\Models\Book::JENIS as $jenis)
                    <option value="{{ $jenis }}" {{ $book->jenis_buku == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                @endforeach
            </select>

            @error('jenis_buku')
                <div class="text-danger text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group p-5">
            <label for="">Photo Buku</label>
            <br>
            <img src="{{ Storage::url($book->photo) }}" class="img rounded p-4  " height="150px" width="150px" alt="photo {$book->name}">
            <button class="btn btn-primary rounded-pill" style="cursor: default;">Mau ganti gambar ? isi kembali</button>
            <input class="form-control" type="file" name="photo">

            @error('photo')
                <div class="text-danger text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Sinopsis</label>
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control">{{ old('deskripsi', $book->deskripsi) }}</textarea>

            @error('deskripsi')
                <div class="text-danger text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-primary rounded-pill mt-3">Ubah data Buku</button>
        </div>
    </form>
</div>

@endsection
