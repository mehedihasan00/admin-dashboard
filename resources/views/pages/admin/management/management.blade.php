@extends('layouts.admin-master', ['pageName'=> 'management', 'title' => @isset($managementData) ? 'Update Management' : 'Management'])
{{-- @section('title', 'gallery') --}}
@push('admin-css')
@endpush
@section('admin-content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-area">
                    <h4 class="heading">
                        @if(@isset($managementData))
                            <i class="fas fa-edit"></i>
                            <span>Update Management</span>
                        @else
                            <i class="fas fa-plus"></i>
                            <span>Add Management</span>
                        @endif
                    </h4>
                    <form action="{{ (@$managementData) ? route('management.update', $managementData->id) : route('management.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="name"> Name <span class="text-danger">*</span> </label>
                                <input type="text" name="name" class="form-control shadow-none @error('name') is-invalid @enderror" value="{{ @$managementData->name }}" id="name" placeholder="Enter a Name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="designation"> Designation <span class="text-danger">*</span> </label>
                                <input type="text" name="designation" class="form-control shadow-none  @error('designation') is-invalid @enderror" value="{{ @$managementData->designation }}" id="designation" placeholder="Enter a Designation">
                                @error('designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="facebook"> Facebook <span class="text-danger">*</span> </label>
                                <input type="url" name="facebook" class="form-control shadow-none  @error('facebook') is-invalid @enderror" value="{{ @$managementData->facebook }}" id="facebook" placeholder="Facebook Link">
                                @error('facebook')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="twitter"> Twitter <span class="text-danger">*</span> </label>
                                <input type="text" name="twitter" class="form-control shadow-none  @error('twitter') is-invalid @enderror" value="{{ @$managementData->twitter }}" id="twitter" placeholder="Twitter Link">
                                @error('twitter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="instagram"> Instagram <span class="text-danger">*</span> </label>
                                <input type="text" name="instagram" class="form-control shadow-none  @error('instagram') is-invalid @enderror" value="{{ @$managementData->instagram }}" id="designation" placeholder="Enter a Designation">
                                @error('instagram')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="image">Image</label>
                                <input class="form-control" id="image" type="file" name="image" onchange="readURL(this);">
                                <div class="form-group mt-2">
                                    <img class="form-controlo img-thumbnail" src="#" id="previewImage" style="width: 100px;height: 80px; background: #3f4a49;">
                                </div>
                            </div>
                        </div>
                        <div class="clearfix border-top">
                            <div class="float-md-right mt-2">
                                <button type="reset" class="btn btn-dark">Reset</button>
                                <button type="submit" class="btn btn-info">{{(@$managementData)?'Update':'Create'}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card my-3">
            <div class="card-header">
                <i class="fas fa-list"></i>
                All Member List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($management as $key=>$item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->name }}</td>                                    
                                    <td><img class="border" style="height: 40px; width:50px;" src="{{ asset('uploads/management/'.$item->image) }}" alt=""></td>
                                    <td>
                                        <a href="{{ route('management.edit', $item->id) }}" type="submit" class="d-inline btn btn-primary btn-sm b-btn mr-2"><i class="fas fa-user-edit"></i></button>
                                        <a href="{{ route('management.delete', $item->id) }}" type="submit" class="d-inline btn btn-danger btn-sm b-btn" onclick="return confirmDel()"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td rowspan="5">Data Not Found</td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('admin-js')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#previewImage')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(80);
            };

            reader.readAsDataURL(input.files[0]);
        }
    } 
    @if(isset($managementData->image))
    document.getElementById("previewImage").src="/uploads/management/{{ $managementData->image }}";
    @else
    document.getElementById("previewImage").src="/uploads/no.png";
    @endif   

</script>
@endpush