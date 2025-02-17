<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    public function index(){
        $paramsData=[
            'title'=>'client',
            'clients' => Client::all()
        ];

        return view('backoffice.client.app', $paramsData);
    }

    public function create(){
        $paramsData=[
            'title'=>'Tambah client',
        ];

        return view('backoffice.client.create',$paramsData);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validateRequest($request);

        try {
            Client::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id) {

        $paramsData = [
            'title' => 'Edit Blog',
            'client' => Client::findOrFail($id),
        ];

        return view('backoffice.client.edit',$paramsData);
    }


    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $this->validateRequest($request);

        try {
            $client = Client::findOrFail($id);
            $client->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id): JsonResponse {
        try {
            client::findOrFail($id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);
    }
}
