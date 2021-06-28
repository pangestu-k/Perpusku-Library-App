@extends('layouts.app')

@section('content')
    <div class="grid-padding text-center">

        @if (session()->get('illegal'))
            <div class="alert alert-success">
                {{ session()->get('illegal') }}
            </div>
        @endif

        <div class="mb-5">
            <h4 class="d-inline">Daftar Buku</h4>
        </div>

        @foreach ($books as $book)
            <div class="card col-md-4 d-inline-block m-3">
                <div class="card-body">
                    <div class="card-img">
                        <img src="{{ Storage::url($book->photo) }}" class="img img-rounded-pill" width="100px" height="100px" alt="">
                    </div>

                    <div class="card-title mb-2">
                        {{ Str::limit($book->title,15,'...') }}
                    </div>
                    <br>

                    <caption><b>{{ $book->pengarang }}</b></caption>
                    <br>
                    <i>~{{ $book->jenis_buku }}~</i>
                </div>
                <div class="card-footer">
                    <form action="{{route('perpusku.borrow.index')}}" method="POST">
                        @csrf
                        <input type="hidden" class="form-control mb-4" name="user_id" value="{{ old('user_id', auth()->id()) }}">
                        <input type="hidden" class="form-control mb-4"  name="book_id" value="{{ old('user_id', $book->id) }}">
                        <input type="hidden" class="form-control mb-4"  name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) ) }}">
                        <input type="hidden" class="form-control mb-4" placeholder="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali', date('Y-m-d', strtotime(Carbon\Carbon::today()->addDays(5)->toDateString())) ) }}">

                        @if ($book->stok == 0)
                            <button type="button" class="btn btn-secondary btn-sm" disabled>tidak tersedia</button>
                        @elseif (in_array(auth()->id(),App\Models\Borrow::pluck('user_id')->toArray()) && in_array($book->id,App\Models\Borrow::pluck('book_id')->toArray()) && $book->borrow->status == 'pinjam')
                            <button type="button" class="btn btn-secondary btn-sm" disabled>sudah pinjam</button>
                        @else
                            <button type="submit" class="btn btn-primary btn-sm">Pinjam</button>
                        @endif
                    </form>
                </div>
            </div>
        @endforeach

    </div>

@endsection
