@extends('layouts.backoffice.main')

@section('title',$title)

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h5>Edit client</h5>
        </div>
        <div class="card-body">
            <form id="meForm" action="{{ route('client.update', $client->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Konten</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4">{{ $client->deskripsi }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <input type="text" class="form-control" id="image" name="image" value="{{ $client->image }}">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="draft" {{ $client->status->value == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ $client->status->value == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('client.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@include('backoffice.client.script')
@endsection
