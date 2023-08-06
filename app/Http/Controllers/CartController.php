<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\If_;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
      

        $duplicata = Cart::search(function ($cartItem, $rowId)  use ($request) {
            return $cartItem->id == $request->product_id;
        });

        if ($duplicata->isNotEmpty()) {
            return redirect()->route('products.index')->with('success', 'le produit a deja ete ajoute.');
        }

        $product =  Product::find($request->product_id);

        Cart::add($product->id, $product->title, 1, $product->price)
            ->associate('App\Product');
            
            return redirect()->route('products.index')->with('success', 'le produit a bien ete ajoute.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rowId)
    {
        $data = $request->json()->all();


        $validator = Validator::make($request->all(), [
            'qty' => 'required|numeric|between:1,6'
        ]);

        if($validator->fails()) {
            Session::flash('danger', "The quantity can't be more than 6.");
            return response()->json(['error' => 'Cart Quantity Has Not Been Updated']);
        }

        if ($data['qty'] > $data['stock']) {
            Session::flash('error', 'The choosen quantity of this product is not available.');
            return response()->json(['error' => 'Product Quantity Not Available']);
        }

        Cart::update($rowId, $data['qty']);

        Session::flash('success', 'The quantity changed to ' . $data['qty'] . '.');

        return response()->json(['success' => 'Cart Quantity Has Been Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        Cart::remove($rowId);

        return back()->with('success', 'the product was deleted');
    }
}
