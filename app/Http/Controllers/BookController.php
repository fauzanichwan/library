<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Book;
use App\BookTransaction;

class BookController extends Controller {

  public function index() {
    $books = Book::orderBy('id', 'DESC')->paginate(5);
    return view('book.index', compact('books'));
  }

  public function create() {
    return view('book.create');
  }

  public function store(Request $request) {
    $this->validate($request, [
      'title'   => 'required|min:5',
      'author'  => 'required:min:4',
      'publish' => 'required',
      'stock'   => 'required|min:1'
    ]);
    
    if (Auth::user()->id == 1) {
      Book::create([
        'user_id' => Auth::user()->id,
        'title'   => $request->title,
        'author'  => $request->author,
        'publish' => $request->publish,
        'stock'   => $request->stock
      ]);

      return redirect('/book')->with('msg', 'Successfully added book');
    } else {
      abort(403);
    }


  }

  public function edit($id) {
    $book = Book::findOrFail($id);
    return view('book.edit', compact('book'));
  }

  public function update(Request $request, $id) {
    $this->validate($request, [
      'title'   => 'required|min:5',
      'author'  => 'required:min:4',
      'publish' => 'required',
      'stock'   => 'required|min:1'
    ]);
    
    $book = Book::findOrFail($id);

    $book->update([
      'title'   => $request->title,
      'author'  => $request->author,
      'publish' => $request->publish,
      'stock'   => $request->stock
    ]);

    return redirect('/book')->with('msg', 'Successfully edited book');
  }

  public function destroy($id) {
    $book = Book::findOrFail($id);
    $book->delete();
    return redirect('/book')->with('msg', 'Successfully deleted book');
  }

  public function loan(Request $request) {
    $this->validate($request, [
      'book_id'    => 'required',
      'start_date' => 'required',
      'end_date'   => 'required',
    ]);
    
    if ($request->start_date > $request->end_date) {
      return redirect('/book')->with('msgAlert', 'Start Date must be greater than End Date');
    } else {
      if (BookTransaction::where('user_id', Auth::user()->id)->where('book_id', $request->book_id)->where('status', 0)->first()) {
        return redirect('/book')->with('msgAlert', 'The request for the book is still process, please wait until approved');
      } else {
        $checkStock = Book::findOrFail($request->book_id);
        if ($checkStock->stock < 1) {
          return redirect('/book')->with('msgAlert', 'Not available');
        } else {
          BookTransaction::create([
            'user_id'    => Auth::user()->id,
            'book_id'    => $request->book_id,
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'status'     => 0
          ]);
    
          return redirect('/book/status')->with('msg', 'Successfully to proccess, please check status');
        }
      }
    }
  }

}
