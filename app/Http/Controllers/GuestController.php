<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // GET /api/guests
    public function index()
    {
        $guests = Guest::orderBy('id', 'desc')->get();

        return response()->json([
            'status' => true,
            'message' => 'Data guests berhasil diambil',
            'data' => $guests
        ]);
    }

    // GET /api/guests/{id}
    public function show($id)
    {
        $guest = Guest::find($id);

        if (!$guest) {
            return response()->json([
                'status' => false,
                'message' => 'Guest tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data guest berhasil diambil',
            'data' => $guest
        ]);
    }

    // POST /api/guests
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'purpose' => 'nullable|string',
            'face_descriptor' => 'nullable|string',
        ]);

        $guest = Guest::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'purpose' => $request->purpose,
            'face_descriptor' => $request->face_descriptor,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Guest berhasil dibuat',
            'data' => $guest
        ], 201);
    }

    // PUT /api/guests/{id}
    public function update(Request $request, $id)
    {
        $guest = Guest::find($id);

        if (!$guest) {
            return response()->json([
                'status' => false,
                'message' => 'Guest tidak ditemukan'
            ], 404);
        }

        $this->validate($request, [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'purpose' => 'nullable|string',
            'face_descriptor' => 'nullable|string',
        ]);

        $guest->update($request->only([
            'name',
            'email',
            'phone',
            'company',
            'purpose',
            'face_descriptor',
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Guest berhasil diperbarui',
            'data' => $guest
        ]);
    }

    // DELETE /api/guests/{id}
    public function destroy($id)
    {
        $guest = Guest::find($id);

        if (!$guest) {
            return response()->json([
                'status' => false,
                'message' => 'Guest tidak ditemukan'
            ], 404);
        }

        $guest->delete();

        return response()->json([
            'status' => true,
            'message' => 'Guest berhasil dihapus'
        ]);
    }
}