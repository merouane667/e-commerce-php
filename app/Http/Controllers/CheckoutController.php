<?php

namespace App\Http\Controllers;

use DateTime;
use App\Order;
use App\Product;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Cart::count() <= 0){
            return redirect()->route('products.index');
        }

        Stripe::setApiKey('sk_test_51H816tBhaPjF6h1oONHYUlXbbT3wNJHKFR4tCLNdpaV3JL57BDwwtfMbzSGkVDFw2p6Q88Aogu8iosEqLLseBhH900SLx7wJMf');

        $intent = PaymentIntent::create([
            'amount' => round(Cart::total()),
            'currency' => 'eur',

          ]);

          $clientSecret = Arr::get($intent, 'client_secret') ;


       return view('checkout.index', [
           'clientSecret' => $clientSecret
       ]);
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
      $data = $request->json()->all();

      $order = new Order();

      $order->payment_intent_id = $data['paymentIntent']['id'];
      $order->amount = $data['paymentIntent']['amount'];

      $order->payment_created_at  = (new DateTime())
            ->setTimestamp($data['paymentIntent']['created'])
            ->format('Y-m-d H:i:s');


      $products = [];
      $i = 0;

      foreach (Cart::content() as $product){
          $products['product_' . $i][] = $product->model->title;
          $products['product_' . $i][] = $product->model->price;
          $products['product_' . $i][] = $product->qty;
          $products['product_' . $i][] = $product->model->description;
          $i++;
      }

      $order->products = json_encode($products);
      $order->user_id = auth()->id();
      $order->save();

      if($data['paymentIntent']['status'] === 'succeeded') {
        $this->updateStock();
        Cart::destroy();
        Session::flash('success', 'Your item has been ordered successfully!');
        return response()->json(['success' => 'Payment Intent Succeeded']);
      }else{
        return response()->json(['error' => 'Payment Intent Not Succeeded']);
      }
    }

    public function thankyou()
    {
        return Session::has('success') ? view('checkout.thankyou') : redirect()->route('products.index');
    }

    public function list(){
        $userId = auth()->id();
        $orders = Order::where('user_id', $userId)->get();

        if ($orders->isEmpty()) {
            return view("Order.list")->with('Orderedproducts', []);
        } else {
            $Orderedproducts = Order::where('user_id', $userId)->pluck('products')->toArray();
            return view("Order.list")->with('Orderedproducts', $Orderedproducts);
        }
        
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function updateStock()
    {
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);
            $product->update(['stock' => $product->stock - $item->qty]);
        }
    }

}
