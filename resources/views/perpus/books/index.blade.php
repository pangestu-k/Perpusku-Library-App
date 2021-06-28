@extends('layouts.app')

@section('content')
    <div class="grid-padding text-center">
        <div class="mb-5">
            <h4 class="d-inline">Data Buku</h4>

            <button type="button" class="btn btn-sm btn-primary rounded-pill" data-toggle="modal" data-target="#exampleModal">
                Tambah
            </button>
        </div>

        <table class="table table-stripped rounded-pill">
            <thead style="background-color:#0ec8f8;" class="text-light">
                <th class="p-4">#</th>
                <th class="p-4">Photo</th>
                <th class="p-4">Judul</th>
                <th class="p-4">Pengarang</th>
                <th class="p-4">Tahun Terbit Buku</th>
                <th class="p-4">Jenis Buku</th>
                <th class="p-4">Stok</th>
                <th class="p-4">Action</th>
            </thead>

            <tbody>

                @php
                    $no = 0;
                @endphp

                @forelse ($books as $book)
                    <tr class="justify-item-center">
                        <td class="p-4">{{ ++$no }}</td>
                        <td class="p-4"><img src="{{ Storage::url($book->photo) }}" class="img rounded" height="100px" width="100px"></td>
                        <td class="p-4">{{ $book->title }}</td>
                        <td class="p-4">{{ $book->pengarang }}</td>
                        <td class="p-4">{{ $book->tahun_terbit }}</td>
                        <td class="p-4">{{ $book->jenis_buku }}</td>
                        <td class="p-4">{{ $book->stok }}</td>
                        <td class="p-4">
                            <form action="{{ route('perpusku.book.destroy', $book) }}" method="POST"  onsubmit="return confirm('Apakah anda ingin mengahapus buku : {{ $book->title }}'); false">
                                @csrf
                                @method('delete')

                                <a href="{{ route('perpusku.book.edit', $book) }}" class="btn btn-warning btn-sm mb-2">Ubah</a>
                                <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    @empty
                        <tr>
                            <td class="bg-danger text-light" colspan="8">Belum ada buku</td>
                        </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade rounded" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: lightblue">
            <h5 class="modal-title text-secondary text-light" id="exampleModalLabel">Tambahkan Buku</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('perpusku.book.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Judul</label>
                        <input type="text" class="form-control mb-4" placeholder="Judul" name="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Pengarang</label>
                        <input type="text" class="form-control mb-4" placeholder="Pengarang" name="pengarang" value="{{ old('pengarang') }}">
                        @error('pengarang')
                            <div class="text-danger text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Tahun terbit</label>
                        <input type="number" class="form-control mb-4" placeholder="tahun terbit contoh 2020" name="tahun_terbit" value="{{ old('tahun_terbit') }}">
                        @error('tahun_terbit')
                            <div class="text-danger text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Jenis Buku</label>
                        <select name="jenis_buku" id="jenis_buku" class="form-control mb-4">
                            <option disabled selected>Pilih</option>
                            @foreach (App\Models\Book::JENIS as $jenis)
                                <option value="{{ $jenis }}">{{ $jenis }}</option>
                            @endforeach
                        </select>

                        @error('jenis_buku')
                            <div class="text-danger text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Photo Buku</label>
                        <input class="form-control" type="file" name="photo" class="form-control">

                        @error('photo')
                            <div class="text-danger text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Stok Buku</label>
                        <input class="form-control" type="number" name="stok" class="form-control" placeholder="stok buku" value="{{ old('stok') }}">

                        @error('stok')
                            <div class="text-danger text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Sinopsis</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control" placeholder="tulis sinopsi buku">{{ old('deskripsi') }}</textarea>

                        @error('deskripsi')
                            <div class="text-danger text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Buku</button>
                </form>
            </div>
        </div>
        </div>
    </div>
@endsection
