@extends('layouts.app')

@section('content')
<div class="container">
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
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
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
                            <td>{{ $book->book->title }}</td>
                            <td>{{ $book->start_date->format('d M Y') }}</td>
                            <td>{{ $book->end_date->format('d M Y') }}</td>
                            <td>
                                @if ($book->status == 0)
                                    Waiting
                                @elseif ($book->status == 1)
                                    Approved
                                @elseif ($book->status == 2)
                                    Returned
                                @else
                                    Rejected
                                @endif
                            </td>
                            <td>{{ $book->created_at->diffForHumans() }}</td>
                            <td>
                                @if ($book->status != 0)
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
                                @else
                                    <a href="/bookLoan/{{ $book->id }}/edit" class="badge badge-success">Edit</a>
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
                                @endif
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
</div>
@endsection