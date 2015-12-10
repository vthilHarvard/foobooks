<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
        public function getIndex(Request $request) {
        $books = \App\Book::orderBy('id','DESC')->get();
        dump($books->toArray());
        return view('books.index')->with('books',$books);
    }
      /**
       * Responds to requests to GET /books/show/{title}
       */
    /*  public function getShow($title) {
      return 'Show book: '.$title;
  } */
      /**
     * Responds to requests to GET /books/show/{id}
     */
      public function getShow($title=null) {
          return view('books.show')->with('title', $title);
      }
      /**
       * Responds to requests to GET /books/create
       */
       public function getCreate() {
              /* $view = '<form method="POST" action="/books/create">';
               $view .= csrf_field();
               $view .= '<input type="text" name="title">';
               $view .= '<input type="submit">';
               $view .= '<form>';

               return $view; */
               return view('books.create');
             }

        public function postCreate(Request $request) {

            $this->validate(
                $request,
                [
                    'title' => 'required|min:5',
                    'author' => 'required|min:5',
                    'cover' => 'required|url',
                    'published' => 'required|min:4',
                  ]
            );
            // Code here to enter book into the database
            $book = new \App\Book();
            $book->title = $request->title;
            $book->author = $request->author;
            $book->cover = $request->cover;
            $book->published = $request->published;
            $book->purchase_link = $request->purchase_link;
            $book->save();
            // Confirm book was entered:
            //return 'Process adding new book: '.$request->input('title');
            //return view()
            \Session::flash('flash_message','Your book was added!');
            return redirect('/books/create');

        }
        /**
        * Responds to requests to GET /books/edit/{$id}
        */
        public function getEdit($id = null) {
            $book = \App\Book::find($id);
            if(is_null($book)) {
                \Session::flash('flash_message','Book not found.');
                return redirect('\books');
            }
            return view('books.edit')->with('book',$book);
        }
        /**
        * Responds to requests to POST /books/edit
        */
        public function postEdit(Request $request) {
            // Validation
            $book = \App\Book::find($request->id);
            $book->title = $request->title;
            $book->author = $request->author;
            $book->author_id = 1;
            $book->cover = $request->cover;
            $book->published = $request->published;
            $book->purchase_link = $request->purchase_link;
            $book->save();
            \Session::flash('flash_message','Your book was updated.');
            return redirect('/books/edit/'.$request->id);
        }

}
