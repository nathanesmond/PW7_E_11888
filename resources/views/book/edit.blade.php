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
                <h1 class="m-0">Edit Book</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">BOOKS</a>
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
            <form action="{{ route('book.update', $book->id) }}" method="post" enctype="multipart/form-data"
                style="margin:12px 12px;">
                @csrf
                @method("PUT")
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image" aria-describedby="imageHelp">
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" placeholder="Masukkan Title" class="form-control" id="title" name="title">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row2 mb-1 mx-1" style="display:flex; width:100%; gap:47%;">
                    <label for="author" class="form-label">Author</label>
                    <label for="pages" class="form-label">Pages</label>
                </div>

                <div class="row1 mb-3" style="display:flex; width:100%;">
                    <input type="text" placeholder="Masukkan Author" class="form-control mr-4" id="author"
                        name="author">
                    <br>
                    @error('author')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <input type="text" placeholder="Masukkan Pages" class="form-control" id="pages" name="pages">
                    <hr>
                    @error('pages')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
</div>

@endsection