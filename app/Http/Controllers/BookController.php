<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
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
              ['title' => 'required|min:5',
              ]
          );

          // Code here to enter book into the database

          // Confirm book was entered:
          return 'Process adding new book: '.$request->input('title');
     }
}
