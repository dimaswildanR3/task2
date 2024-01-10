<?php

// app/Http/Controllers/TenantController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::all();
        return response()->json(['tenants' => $tenants]);
    }

    public function show($id)
    {
        $tenant = Tenant::find($id);

        if (!$tenant) {
            return response()->json(['error' => 'Tenant not found.'], 404);
        }

        return response()->json(['tenant' => $tenant]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $tenant = Tenant::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return response()->json(['tenant' => $tenant], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $tenant = Tenant::find($id);

        if (!$tenant) {
            return response()->json(['error' => 'Tenant not found.'], 404);
        }

        $tenant->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return response()->json(['tenant' => $tenant]);
    }

    public function destroy($id)
    {
        $tenant = Tenant::find($id);

        if (!$tenant) {
            return response()->json(['error' => 'Tenant not found.'], 404);
        }

        $tenant->delete();

        return response()->json(['message' => 'Tenant deleted successfully']);
    }
}
