<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Category;

class BookStoreController extends Controller
{
    public function index(Request $request)
    {
        // dd(session('cart'));
        $cartItems = null;
        if(session('cart'))
        {
           $cart = collect(session('cart'));
           $cartItems = $cart->sum('quant');
        }
        $selectedCategory = $request->input('category') && $request->input('category') != 'all' ? Category::find($request->input('category')) : null;
        $categories = Category::all(); 
        $books = Book::orderBy('title', 'desc')->paginate(15);
        if($selectedCategory)
        {
            $books = $selectedCategory->books()->paginate(15);
        }
      
        return view('bookstore', compact('books', 'selectedCategory', 'categories', 'cartItems'));
    }
    public function addToCart(Request $request, Book $book)
    {
        // The purpose of this functon is just to add books to the session. Which we'll reference later.
        $number = $request->input('quanity');
        // check for the existence of items in the cart and if they are there add the new item to it.
        $oldcart = session('cart');
        if($oldcart)
        {
            $oldcart[] = [ 'item' => Book::find($book->id),
                            'quant' => $number
                        ];
            $newcart = $oldcart;
        }
        else
        {
            $newcart = [[ 'item' => Book::find($book->id),
            'quant' => $number
        ]];
        }
        // Replace the cart
        session(['cart' => $newcart ]);
        return redirect()->back();
    }

    public function cart(Request $request)
    {
        if(!session('cart'))
        {
            return redirect('/bookstore');
        }
        else
        {
            // Transfer all of the items in the session cart to actual books
            $cartItems = collect(session('cart'));
            $total = 0;
            foreach($cartItems as $item)
            {
                $cost = $item['item']->cost * $item['quant'];
                $total = $total + $cost; 
            }
            
            return view('cart', compact('cartItems', 'total'));
        }
    }
    public function cartRemove(Request $request, $id)
    {
        $cartItems = collect(session('cart'));
        $newcart = $cartItems->filter(function($value, $key) use ($id){
            return $value['item']->id != $id;
        });
        session(['cart' => $newcart ]);
        return redirect()->back();
    }
    public function cartUpdate(Request $request, $id)
    {
        $cartItems = collect(session('cart'));
        $i = Book::find($id);
        $cartItems->transform(function($item, $key) use ($i, $request) {
            if($item['item'] == $i)
            {
               $item['item'] == $i;
               $item['quant'] = $request->input('quantity');
               return $item;
            }
            else 
            {
                return $item;
            }
        });

        session(['cart' => $cartItems ]);
        return redirect()->back();
    }
    public function checkout(Request $request)
    {
        $cartItems = null;
        if(session('cart'))
        {
           $cart = collect(session('cart'));
           $cartItems = $cart->sum('quant');
        }
        $cartI = collect(session('cart'));
        $total = 0;
        foreach($cartI as $item)
        {
            $cost = $item['item']->cost * $item['quant'];
            $total = $total + $cost; 
        }
        $total = $total * 100;
        return view('checkout', compact('cartItems', 'total'));
    }
}
