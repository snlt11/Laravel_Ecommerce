<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
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
        $categories = Category::all();
        return response()->json([
            'message' => 'All categories',
            'category' => $categories
        ]);
    }

    public function subcategories($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->get();
        return response()->json([
            'message' => 'All subcategories '.$id,
            'subcategory' => $subcategories
        ]);
    }

    public function me()
    {
        return response()->json([
            'message' => 'User Information',
            auth()->user()
        ]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 60
        ]);
    }
}
