<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\BookTransaction;
use App\Book;
use App\User;

class BookTransactionController extends Controller {

  public function status() {
    $books = BookTransaction::orderBy('id', 'DESC')->where('user_id', '=', Auth::user()->id)->paginate(5);
    return view('book.status', compact('books'));
  }

  public function index() {
    $books = BookTransaction::orderBy('id', 'DESC')->paginate(5);
    return view('book.approval', compact('books')); 
  }

  public function approve($id) {
    $trans = BookTransaction::findOrFail($id);
    $book  = Book::findOrFail($trans->book_id);

    $trans->update([
      'status' => 1
    ]);
    
    $book->decrement('stock', 1);
    
    return redirect('/book/approval')->with('msg', 'Successfully to approve this book');
  }

  public function return($id) {
    $trans = BookTransaction::findOrFail($id);
    $book  = Book::findOrFail($trans->book_id);

    $trans->update([
      'status' => 2
    ]);

    $book->increment('stock', 1);

    return redirect('/book/approval')->with('msg', 'The book is returned');
  }

  public function reject($id) {
    $trans = BookTransaction::findOrFail($id);

    $trans->update([
      'status' => 3
    ]);

    return redirect('/book/approval')->with('msg', 'The request was rejected');
  }

}
