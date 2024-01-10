<?php

// app/Http/Controllers/VoucherController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\Invoice;

class VoucherController extends Controller
{
    public function redeem(Request $request)
    {
        $request->validate([
            'voucher_code' => 'required|string',
            'invoice_id' => 'required|exists:invoices,id',
        ]);

        $voucher = Voucher::where('code', $request->input('voucher_code'))
            ->where('expired_at', '>', now())
            ->where('is_used', false)
            ->first();

        if (!$voucher) {
            return response()->json(['error' => 'Invalid voucher or expired.'], 400);
        }

        $invoice = Invoice::find($request->input('invoice_id'));

        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found.'], 404);
        }

        if ($voucher->amount <= $invoice->total_amount) {
            $invoice->total_amount -= $voucher->amount;
            $invoice->save();

            $voucher->is_used = true;
            $voucher->used_at = now();
            $voucher->save();

            return response()->json(['message' => 'Voucher redeemed successfully.']);
        } else {
            return response()->json(['error' => 'Voucher amount exceeds the invoice total.'], 400);
        }
    }
}
