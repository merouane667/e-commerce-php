<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\OutOfStockProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\OutOfStockNotification;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{

    public function index()
    {
        // Retrieve all products that have a stock value of zero
        $outOfStockProducts = Product::where('stock', 0)->get();

        // Loop through each out of stock product
        foreach ($outOfStockProducts as $product) {
            // Check if the product is already in the out of stock products table
            $existingOutOfStockProduct = OutOfStockProduct::where('product_id', $product->id)->first();

            // Create a new out of stock product if the product is not already in the table
            if (!$existingOutOfStockProduct) {
                $product->outOfStock()->create();
                //sending email
                Mail::to('admin@admin.com')->send(new OutOfStockNotification());
            }
        }













        if (request()->categorie) {

            $products = Product::with('categories')->whereHas('categories', function ($query)
            {
                $query->where('slug', request()->categorie);
            })->orderBy('created_at','DESC')->paginate(6);
        } else {
            $products = Product::with('categories')->orderBy('created_at','DESC')->paginate(6);
        }

        if(Auth::check()){
            return view('products.index')->with('products', $products);
        }else{
            return redirect("/")->withSuccess('You are not allowed to access');
        }



        
    }


    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $stock = $product->stock === 0 ? 'Unavailable' : 'Available';

        return view('products.show', [
            'product' => $product,
            'stock' => $stock
        ]);
    }

    public function getPage()
    {
        $categories = Category::all();
        return view('products.create')->with('categories', $categories);
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|file|image|mimes:jpeg,jpg,png,gif,webp,svg|max:2048',
        ]);



        $product = new Product;
        $product->title = $request->title;
        $product->slug = $request->title;
        $product->subtitle = $request->subtitle;
        $product->description = $request->description;
        $product->price = $request->price;
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            // $image->move($destinationPath, $name);
            $image->storeAs('images', $name, ['disk' => 'root']);
            $product->image = $name;
        }

        $product->save();  

        $category = Category::find($request->category_id);
        $product->categories()->attach($category);




        return redirect("/boutique")->with('product', "Product created successfully.");

    }

    public function search()
    {
        request()->validate([
            'q' => 'required|min:3'
        ]);

        $q = request()->input('q');

        $products = Product::where('title', 'like', "%$q%")
                ->orWhere('description', 'like', "%$q%")
                ->paginate(6);

        return view('products.search')->with('products', $products);
    }


}
 