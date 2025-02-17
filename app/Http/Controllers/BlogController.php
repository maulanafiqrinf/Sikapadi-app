<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    public function index(){

        $paramsData = [
            'title' => 'Blog',
            'blogs' => Blog::all(),
        ];
        return view('backoffice.blog.app', $paramsData);
    }

    public function create(){

        $paramsData = [
            'title' => 'Tambah Blog',
        ];

        return view('backoffice.blog.create', $paramsData);
    }

    // public function store(Request $request): JsonResponse {
    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'content' => 'nullable|string',
    //         'image' => 'nullable|string|max:255',
    //         'status' => 'required|in:draft,published',
    //     ]);

    //     try {
    //         Blog::create($validated);
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data berhasil disimpan.'
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function store(Request $request): JsonResponse
    {
        $validated = $this->validateRequest($request);

        try {
            Blog::create($validated);
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
            'blog' => Blog::findOrFail($id),
        ];

        return view('backoffice.blog.edit',$paramsData);
    }


    // public function update(Request $request, $id): JsonResponse {
    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'content' => 'nullable|string',
    //         'image' => 'nullable|string|max:255',
    //         'status' => 'required|in:draft,published',
    //     ]);

    //     try {
    //         $blog = Blog::findOrFail($id);
    //         $blog->update($validated);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data berhasil diperbarui.'
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $this->validateRequest($request);

        try {
            $blog = Blog::findOrFail($id);
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
            Blog::findOrFail($id)->delete();
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
            'image' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
        ]);
    }
}
