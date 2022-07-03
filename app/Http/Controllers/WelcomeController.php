<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Subcategories;
use App\Models\Product;
use App\Models\Order;
use App\Models\Orderhistory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Public/Index' ,[
            'categories' => Categories::orderBy('id','desc')
            ->paginate(5)
            ->through(fn ($categories) => [
                'id' => $categories->id,
                'name' => $categories->name,
                'photo' => $categories->image_path ? URL::route('image', ['path' => $categories->image_path, 'w' => 200, 'h' => 200, 'fit' => 'crop']) : null
           ]),
        ]);
    }

    public function publicsubcategories(Categories $categories)
    {
        return Inertia::render('Public/Categories' ,[
            'subcategories' => Subcategories::where('categories_id',$categories->id)
            ->paginate(5)
            ->through(fn ($subcategories) => [
                'id' => $subcategories->id,
                'name' => $subcategories->name,
                'photo' => $subcategories->image_path ? URL::route('image', ['path' => $subcategories->image_path, 'w' => 200, 'h' => 200, 'fit' => 'crop']) : null
           ]),
        ]);
    }

    public function publicproduct(Subcategories $subcategories)
    {
        return Inertia::render('Public/Product' ,[
            'products' => Product::where('subcategories_id',$subcategories->id)
            ->paginate(5)
            ->through(fn ($product) => [
                'id' => $product->id,
                'name' => $product->name,
                'sku' => $product->sku,
                'photo' => $product->image_path ? URL::route('image', ['path' => $product->image_path, 'w' => 200, 'h' => 200, 'fit' => 'crop']) : null
           ]),
        ]);
    }

    public function productdetail(Product $product)
    {
        return Inertia::render('Public/Productdetail' ,[
            'product' => ['id' => $product->id,
            'name' => $product->name,
            'detail' => $product->detail,
            'sku' => $product->sku,
            'amount' => 0,
            'price' => $product->price,
            'photo' => $product->image_path ? URL::route('image', ['path' => $product->image_path, 'w' => 200, 'h' => 200, 'fit' => 'crop']) : null]
        ]);
    }

    public function orderhistory()
    {
        return Inertia::render('Public/Orderhistory');
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Request::validate([
            'customer_name' => ['required', 'max:50'],
            'phone' => ['required'],
            'address' => ['required'],
        ]);
       $order_code=$this->maxordercode();
       $order = Order::create([
        'customer_name' => Request::get('customer_name'),
        'phone' => Request::get('phone'),
        'address' => Request::get('address'),
        'order_code' => $order_code,
        'status' => 1,
        'total' => 0,
       ]);
       $total=0;
       $error="";
        $order_histories=Request::get('cartItems');
        $id= $order->id;
        
        foreach($order_histories as $order_history) {
            $checkavaliable=$this->checkavaliable($order_history['product_id'],$order_history['amount']);
            if($checkavaliable)
            {
                $order = Orderhistory::create([
                    'product_id' => $order_history['product_id'],
                    'order_id' => $id,
                    'quantity' => $order_history['amount'],
                    'price' => $order_history['price'],
                   ]);
                $total=$total+($order_history['amount']*$order_history['price']);
            }
            else
            {
                $error=$error." ".$order_history->product_name." is out of stock";
            }
            $product=Product::find($order_history['product_id']);
            $sku=$product->sku-$order_history['amount'];
            $product->update(['sku' => $sku]);
        }
        $updateorder=Order::find($id);
        $updateorder->update(['total' => $total]);
        return Redirect::route('orderhistorysuccess')->with('error', $error,'success','Your Order Code Number -'.$order_code);
    }

    public function maxordercode()
    {
        $max=Order::max('order_code');
        if($max)
            return $max+1;
        else
            return 10000;
    }

    public function checkavaliable($product_id,$amount)
    {
        $product=Product::where('id',$product_id)
                    ->where('sku','>',$amount);
        if($product)
            return 1;
        else
            return 0;
    }

    public function orderhistorysuccess()
    {
        return Inertia::render('Public/Orderhistorysuccess');
    }
}
