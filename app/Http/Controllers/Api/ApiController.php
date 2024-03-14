<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 60
        ]);
    }

    public function me()
    {
        return response()->json([
            'message' => 'User Information',
            auth()->user()
        ]);
    }

    public function register(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits_between:7,11',
            'password' => 'required',
            'confirm-password' => 'required|same:password'
        ]);
        if (!$validator) {
            return response()->json([
                'message' => 'Data validation failed'
            ]);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'message' => 'Registration successful'
        ]);
    }

    public function categories()
    {
        $categories = Category::get()->load('subcategory');
        return response()->json([
            'message' => 'All categories',
            'categories' => $categories
        ]);
    }

    public function subcategories($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->get();
        return response()->json([
            'message' => 'All subcategories ' . $id,
            'subcategories' => $subcategories
        ]);
    }

    public function tags()
    {
        $tags = Tag::all();
        return response()->json([
            'message' => 'All tags',
            'tags' => $tags
        ]);
    }

    public function products(Request $request)
    {
        $products = Product::simplePaginate(2);
        return response()->json([
            'message' => 'All Products',
            'products' => $products
        ]);
    }

    public function getProductByCategoryId(Request $request, $id)
    {
        $products = Product::where('category_id', $id)->simplePaginate(2);
        return response()->json([
            'message' => 'Paginated Category Product',
            'products' => $products
        ]);
    }
    public function getProductBySubCategoryId(Request $request, $id)
    {
        $products = Product::where('subcategory_id', $id)->simplePaginate(2);
        return response()->json([
            'message' => 'Paginated SubCategory Product',
            'products' => $products
        ]);
    }
    public function getProductByTagId(Request $request, $id)
    {
        $products = Product::where('tag_id', $id)->simplePaginate(2);
        return response()->json([
            'message' => 'Paginated Tags Product',
            'products' => $products
        ]);
    }

    public function setOrder(Request $request)
    {
        $orders = $request->orders;
        $orderId = $this->saveOrder($orders);

        foreach ($orders as $productOrder) {

            $product = Product::find($productOrder['id']);

            $orderItem = new OrderItem();
            $orderItem->order_id = $orderId;
            $orderItem->user_id = auth()->user()->id;
            $orderItem->category_id = $product->category_id;
            $orderItem->subcategory_id = $product->subcategory_id;
            $orderItem->tag_id = $product->tag_id;
            $orderItem->name = $product->name;
            $orderItem->price = $product->price;
            $orderItem->images = $product->images;
            $orderItem->color = $product->colors;
            $orderItem->size = $product->sizes;
            $orderItem->count = $productOrder['count'];
            $orderItem->total = $product->price * $productOrder['count'];

            $orderItem->save();
        }
        return response()->json([
            'message' => 'Order Saved Success',
        ]);
    }

    public function saveOrder($orders)
    {
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->count = count($orders);
        $order->status = false;

        $total = 0;
        foreach ($orders as $productOrder) {
            $product = Product::find($productOrder['id']);
            $total += $product->price * $productOrder['count'];
        }
        $order->total = $total;

        $order->save();

        return $order->id;
    }

    public function myOrder(Request $request)
    {
        $orders = Order::where('id', auth()->user()->id)->get()->load('orderItems');
        return response()->json([
            'message' => 'All Orders',
            'orders' => $orders
        ]);
    }

    public function myOrderItems(Request $request,$id){
        $ordersItems = OrderItem::where('order_id',$id)->get();
        return response()->json([
            'message' => 'My Order Items',
            'ordersItems' => $ordersItems
        ]);

    }
}
