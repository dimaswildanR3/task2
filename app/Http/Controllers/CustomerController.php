<?php

// app/Http/Controllers/CustomerController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return response()->json(['customers' => $customers]);
    }

    public function show($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found.'], 404);
        }

        return response()->json(['customer' => $customer]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string',
        ]);

        $customer = Customer::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return response()->json(['customer' => $customer], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email,' . $id,
            'password' => 'required|string',
        ]);

        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found.'], 404);
        }

        $customer->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return response()->json(['customer' => $customer]);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found.'], 404);
        }

        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully']);
    }
}
