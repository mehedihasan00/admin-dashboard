@extends('layouts.admin-master', ['pageName'=> 'service', 'title' => 'Add Service'])
{{-- @section('title', 'Service') --}}

@push('admin-css')
    <link href="{{ asset('summernote/summernote-bs4.min.css') }}" rel="stylesheet">  
@endpush

@section('admin-content')

<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-plus"></i>
                        Add a Service
                    </div>

                    <div class="card-body">
                        <form action="{{ route('store.service') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="name"> Name <span class="text-danger">*</span> </label>
                                    <input type="text" name="name" class="form-control shadow-none @error('name') is-invalid @enderror" id="name" placeholder="Enter Service Name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="icon"> Icon <span class="text-danger">*</span> </label>
                                    <input type="text" name="icon" class="form-control shadow-none @error('icon') is-invalid @enderror" id="icon" placeholder="Enter an Icon">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix border-top">
                                <div class="float-md-right mt-2">
                                    <button type="reset" class="btn btn-dark">Reset</button>
                                    <button type="submit" class="btn btn-info">{{(@$subcategoryData)?'Update':'Create'}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-list"></i>
                        Service List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>name</th>
                                        <th>Icon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($services as $key=>$item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{!! $item->icon !!}</td>                      
                                            <td>
                                                <a href="{{ route('edit.service', $item->id) }}" type="submit" class="d-inline btn btn-primary btn-sm b-btn mr-2"><i class="fas fa-user-edit"></i></button>
                                                <a href="{{ route('delete.service', $item->id) }}" type="submit" class="d-inline btn btn-danger btn-sm b-btn" onclick="return confirm('Are you sure you want to delete?');"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Data Not Found</td>
                                        </tr>
                                    @endforelse
                                    
                                </tbody>
                            </table>
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
    // $('#description').summernote({
    //     tabsize: 2,
    //     height: 160
    // });
    $('#description').summernote({
        tabsize: 2,
        height: 160,
    });
</script>
@endpush
