<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __constructor(){
        return $this->middleware('auth');
    }

    public function index() {
        $users = User::where('role', 'cashier')->get();
        return view('user', compact('users'));
    }

    public function get($id) {
        $user = User::where('id', $id)->first();
        return response()->json($user);
    }

    public function update(Request $request) {
        $rules = [
            'name' => 'required',
            'email' => 'required|email:dns',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);
        }
   
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->contact = $request->contact;
        $user->save();

        return response()->json([
            'fail' => false
        ]);
    }

    public function create(Request $request) {
        $rules = [
            'name' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required|min:6'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);
        }
   
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->contact = $request->contact;
        $user->role = 'cashier';
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'fail' => false
        ]);
    }

    public function delete(Request $request) {
        $user = User::find($request->id);
        $user->delete();
        return response()->json([
            'fail' => false
        ]);
    }
}
