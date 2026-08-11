<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Guest;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    // GET /api/visits
    public function index()
    {
        $visits = Visit::with('guest')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Data visits berhasil diambil',
            'data' => $visits
        ]);
    }

    // GET /api/visits/{id}
    public function show($id)
    {
        $visit = Visit::with('guest')->find($id);

        if (!$visit) {
            return response()->json([
                'status' => false,
                'message' => 'Visit tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data visit berhasil diambil',
            'data' => $visit
        ]);
    }

    // POST /api/visits
    public function store(Request $request)
    {
        $this->validate($request, [
            'guest_id' => 'required|integer|exists:guests,id',
            'check_in' => 'required|date',
            'check_out' => 'nullable|date|after_or_equal:check_in',
        ]);

        $visit = Visit::create([
            'guest_id' => $request->guest_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Visit berhasil dibuat',
            'data' => $visit->load('guest')
        ], 201);
    }

    // PUT /api/visits/{id}
    public function update(Request $request, $id)
    {
        $visit = Visit::find($id);

        if (!$visit) {
            return response()->json([
                'status' => false,
                'message' => 'Visit tidak ditemukan'
            ], 404);
        }

        $this->validate($request, [
            'guest_id' => 'sometimes|required|integer|exists:guests,id',
            'check_in' => 'sometimes|required|date',
            'check_out' => 'nullable|date|after_or_equal:check_in',
        ]);

        $visit->update($request->only([
            'guest_id',
            'check_in',
            'check_out',
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Visit berhasil diperbarui',
            'data' => $visit->load('guest')
        ]);
    }

    // DELETE /api/visits/{id}
    public function destroy($id)
    {
        $visit = Visit::find($id);

        if (!$visit) {
            return response()->json([
                'status' => false,
                'message' => 'Visit tidak ditemukan'
            ], 404);
        }

        $visit->delete();

        return response()->json([
            'status' => true,
            'message' => 'Visit berhasil dihapus'
        ]);
    }
}