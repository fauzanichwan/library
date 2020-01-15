@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3 justify-content-center">
        <div class="col-md-5">
            <div class="card bg-light mb-3">
                <div class="card-header">
                    <b>Edit Book</b>
                </div>
                <div class="card-body">
                    <form action="/book/{{ $book->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') ? old('title') : $book->title }}">
                            @if ($errors->has('title'))
                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                    {{ $errors->first('title') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Author</label>
                            <input type="text" name="author" class="form-control" value="{{ old('author') ? old('author') : $book->author }}">
                            @if ($errors->has('author'))
                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                    {{ $errors->first('author') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Publish</label>
                            <input type="date" name="publish" class="form-control" value="{{ old('publish') ? old('publish') : $book->publish->format('Y-m-d') }}">
                            @if ($errors->has('publish'))
                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                    {{ $errors->first('publish') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" name="stock" class="form-control" min="1" value="{{ old('stock') ? old('stock') : $book->stock }}">
                            @if ($errors->has('stock'))
                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                    {{ $errors->first('stock') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection