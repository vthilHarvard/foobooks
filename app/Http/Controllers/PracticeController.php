<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Book;

class PracticeController extends Controller
{
    function getBooksWithQueryBuilder()
    {
        $books = \DB::table('books')->get();
        foreach ($books as $book)
        {
            echo $book->title.'<br/>';
        }
        return 'getBooksWithQueryBuilder';
    }

    function getCreateNewBookWithQueryBuilder()
    {
        // Use the QueryBuilder to insert a new row into the books table
        // i.e. create a new book
        \DB::table('books')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'published' => 1925,
            'cover' => 'http://img2.imagesbn.com/p/9780743273565_p0_v4_s114x166.JPG',
            'purchase_link' => 'http://www.barnesandnoble.com/w/the-great-gatsby-francis-scott-fitzgerald/1116668135?ean=9780743273565',
        ]);
    }

    function getBookWithEloquent()
    {
        $books = new Book();
        foreach($books->all() as $book)
        {
            echo $book->title.'<br/>';
        }
        return 'getBookWithEloquent';
    }

    function getExample4()
    {
        //CREATE
        $book = new Book();
        $book->title = 'Harry Potter';
        $book->author = 'J.K.Rowling';
        $book->save();
        return 'example 4';
    }

    function getExample5()
    {
        //DELETE
        $book = new Book();
        $harry_potter = Book::where('author', '=', 'J.K.Rowling')->first();
        if ($harry_potter != null)
        {
            $harry_potter->delete();
            echo 'deleted Harry Potter';
        }

        return 'example5';
    }

    function getExample6()
    {
        //UPDATE
        $book = new Book();
        $book_to_update = $book->find(1);
        $book_to_update->title = "Green Eggs and Ham";
        $book_to_update->save();
    }

    function getExample7()
    {
        $book = new Book();
        $results = $book->where('published', '>', 1950)->get();
        foreach($results as $result)
        {
            echo $result->title.'<br/>';
        }
        echo 'Number found is '.count($results).'<br/>';
        return 'example7';
    }
}
