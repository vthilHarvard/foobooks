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
        $book_to_update->title = "TestCase";
        $book_to_update->save();

        $books = Book::orderBy('id', 'DESC')->get();
        dump($books);
    }

    function getExample7()
    {
        /*$book = new Book();
        $results = $book->where('published', '>', 1950)->get();
        foreach($results as $result)
        {
            echo $result->title.'<br/>';
        }
        echo 'Number found is '.count($results).'<br/>';
        return 'example7';*/
        $author = new \App\Author;
        $author->first_name = 'J.K';
        $author->last_name = 'Rowling';
        $author->bio_url = 'https://en.wikipedia.org/wiki/J._K._Rowling';
        $author->birth_year = '1965';
        $author->save();
        dump($author->toArray());

        $book = new \App\Book;
        $book->title = "Harry Potter and the Philosopher's Stone";
        $book->published = 1997;
        $book->cover = 'http://prodimage.images-bn.com/pimages/9781582348254_p0_v1_s118x184.jpg';
        $book->purchase_link = 'http://www.barnesandnoble.com/w/harrius-potter-et-philosophi-lapis-j-k-rowling/1102662272?ean=9781582348254';
        $book->author()->associate($author); # <--- Associate the author with this book
        $book->save();
        dump($book->toArray());

        return 'Example 7';
    }

    function getExample8()
    {
        $book = \App\Book::orderBy('id', 'DESC')->first();
        dump($book->toArray());
        echo 'The book title is'.$book->title.'<br/>';
        $book = \App\Book::first();
        $author = $book->author;
        echo $book->title.' was written by '.$author->first_name.' '.$author->last_name;
        dump($book->toArray());
        return 'Example 8';
    }
}
