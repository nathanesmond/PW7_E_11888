@extends('dashboard')
@section('content')

<style>
    .text-danger {
        color: red;
        font-size: 0.9em;
    }
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Bookings</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Bookings</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-main">
    <div class="content mx-5">
        <div class="container-fluid"
            style="background-color:white; border-style:solid;border-color:black;border-width:1px;border-radius:8px;border-color:#B2BEB5;">
            <form action="{{ route('bookings.update') }}" method="post" enctype="multipart/form-data"
                style="margin:12px 12px;">
                @csrf
                @method("PUT")

                <div class="row2 mb-1 mx-1" style="display:flex; width:100%; gap:48%;">
                    <label for="Class" class="form-label">Class</label>
                    <label for="Price" class="form-label">Price</label>
                </div>

                <div class="row1 mb-3" style="display:flex; width:100%;">
                    <input type="text" placeholder="Masukkan Nama Ticket" class="form-control mr-4" id="class"
                        name="class">
                    @error('class')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <input type="text" placeholder="Masukkan Price" class="form-control" id="price" name="price">
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Book</label>
                    <select name="id_book" class="form-control @error('id_book') is-invalid @enderror"
                        style="width: 40%;">
                        <option selected disabled>Pilih buku</option>
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection