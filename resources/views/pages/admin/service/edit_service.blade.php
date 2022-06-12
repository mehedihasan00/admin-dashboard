@extends('layouts.admin-master', ['pageName'=> 'service', 'title' => 'Edit Service'])
{{-- @section('title', 'Update Service') --}}
@push('admin-css')
    <link href="{{ asset('summernote/summernote-bs4.min.css') }}" rel="stylesheet">  
@endpush
@section('admin-content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-area">
                    <h4 class="heading"><i class="fas fa-edit"></i> Edit Service</h4>
                    <form action="{{ route('update.service', $service->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="name"> Name <span class="text-danger">*</span> </label>
                                <input type="text" name="name" class="form-control shadow-none @error('name') is-invalid @enderror" id="name" placeholder="Enter Service Name" value="{{ $service->name }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="icon"> Icon <span class="text-danger">*</span> </label>
                                <input type="text" name="icon" class="form-control shadow-none @error('icon') is-invalid @enderror" id="icon" placeholder="Enter an Icon" value="{{ $service->icon }}">
                                @error('icon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" rows="3">{{ $service->description }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="clearfix border-top">
                            <div class="float-md-left mt-2">
                                <a href="{{ route('service') }}" class="btn btn-dark">Prev</a>
                            </div>
                            <div class="float-md-right mt-2">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('admin-js')
<script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
<script>
    $('#description').summernote({
        tabsize: 2,
        height: 160
    });
</script>
@endpush
