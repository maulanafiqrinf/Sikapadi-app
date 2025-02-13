<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimoni;
use Illuminate\Http\JsonResponse;

class TestimoniController extends Controller
{
    public function index(){

        $paramsData = [
            'title' => 'Testimoni',
            'testimonis' => Testimoni::all(),
        ];
        return view('backoffice.testimoni.app', $paramsData);
    }

    public function create(){
        $paramsData = [
            'title' => 'Tambah Testimoni',
        ];

        return view('backoffice.testimoni.create',$paramsData);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validateRequest($request);

        try {
            Testimoni::create($validated);
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

    public function edit($id){
        $paramsData = [
            'title' => 'Tambah Testimoni',
            'testimonis'=> Testimoni::findOrFail($id),
        ];

        return view('backoffice.testimoni.edit',$paramsData);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $this->validateRequest($request);

        try {
            $blog = Testimoni::findOrFail($id);
            $blog->update($validated);

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
            Testimoni::findOrFail($id)->delete();
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
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);
    }
}
