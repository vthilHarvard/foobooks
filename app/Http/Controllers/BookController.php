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
}
