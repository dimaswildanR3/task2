<?php

// app/Http/Controllers/InvoiceController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return response()->json(['invoices' => $invoices]);
    }

    public function show($id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found.'], 404);
        }

        return response()->json(['invoice' => $invoice]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'total_amount' => 'required|numeric',
            // Add other validation rules as needed
        ]);

        $invoice = Invoice::create([
            'total_amount' => $request->input('total_amount'),
            // Add other fields as needed
        ]);

        return response()->json(['invoice' => $invoice], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'total_amount' => 'required|numeric',
            // Add other validation rules as needed
        ]);

        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found.'], 404);
        }

        $invoice->update([
            'total_amount' => $request->input('total_amount'),
            // Update other fields as needed
        ]);

        return response()->json(['invoice' => $invoice]);
    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found.'], 404);
        }

        $invoice->delete();

        return response()->json(['message' => 'Invoice deleted successfully']);
    }
}
