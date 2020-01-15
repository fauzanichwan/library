@extends('layouts.app')

@section('content')
<div class="container">
    @if (Auth::user()->role_id == 1)
        <div class="row">
            <div class="col-md-12">
                <a href="/book/create" class="btn btn-primary">Add</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-2">
                @if (session('msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('msg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publish</th>
                            <th>Stock</th>
                            <th>Created at</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    @php
                        $no = 1;
                    @endphp
                    @if (count($books))
                        <tbody>
                            @foreach ($books as $book)
                            <tr>
                                <td>{{ $no++ }}#</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->publish->format('d M Y') }}</td>
                                <td>{{ $book->stock }}</td>
                                <td>{{ $book->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="/book/{{ $book->id }}/edit" class="badge badge-success">Edit</a>
                                    <a href="" class="badge badge-danger" data-toggle="modal" data-target="#modal{{ $book->id }}">Delete</a>
                                    <div class="modal fade" id="modal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal{{ $book->id }}Title">Delete</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Do you want to delete this book?
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                    <a href="/book/{{ $book->id }}/delete"><button class="btn btn-primary">Yes</button></a>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    @else
                        <tbody>
                            <tr>
                                <td colspan="7"><b>No Data!</b></td>
                            </tr>
                        </tbody>
                    @endif
                </table>
                {{ $books->links() }}
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if (session('msgAlert'))
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                    {{ session('msgAlert') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>
        </div>
        <div class="row mt-3 justify-content-center">
            <div class="col-md-6">
                <div class="card bg-light mb-3">
                    <div class="card-header">
                        <b>Request Book</b>
                    </div>
                    <div class="card-body">
                        <form action="/book/loan" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Book Title</label>
                                <select name="book_id" class="custom-select">
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->title }} ({{ $book->stock }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" class="form-control" name="start_date">
                                @if ($errors->has('start_date'))
                                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                        {{ $errors->first('start_date') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date" class="form-control" name="end_date">
                                @if ($errors->has('end_date'))
                                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                        {{ $errors->first('end_date') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Proccess</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection