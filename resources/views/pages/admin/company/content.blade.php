@extends('layouts.admin-master', ['pageName'=> 'content', 'title' => 'Add Content'])
{{-- @section('title', 'Company Information') --}}
@push('admin-css')
    <link href="{{ asset('summernote/summernote-bs4.min.css') }}" rel="stylesheet">  
@endpush    
@section('admin-content')
<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="form-area">
                    <h4 class="heading"><i class="fa fa-address-card"></i> Update Company Information</h4>
                    <form action="{{ route('company.update', $company) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="name">Company Name <span class="text-danger">*</span> </label>
                                <input type="text" name="name" value="{{ $company->name }}" class="form-control shadow-none @error('name') is-invalid @enderror" id="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="phone">Company Phone <span class="text-danger">*</span> </label>
                                <input type="text" name="phone" value="{{ $company->phone }}" class="form-control shadow-none @error('phone') is-invalid @enderror" id="phone">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="email">E-Mail Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="{{ $company->email }}" class="form-control shadow-none @error('email') is-invalid @enderror" id="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="address">Company Address <span class="text-danger">*</span></label>
                                <input type="text" name="address" value="{{ $company->address }}" class="form-control shadow-none @error('address') is-invalid @enderror" id="address">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="facebook">Company Facebook</label>
                                <input type="url" name="facebook" value="{{ $company->facebook }}" class="form-control shadow-none @error('facebook') is-invalid @enderror" id="facebook">
                                @error('facebook')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="twitter">Company Twitter</label>
                                <input type="url" name="twitter" value="{{ $company->twitter }}" class="form-control shadow-none @error('twitter') is-invalid @enderror" id="twitter">
                                @error('twitter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="linkedin">Company Linkedin</label>
                                <input type="url" name="linkedin" value="{{ $company->linkedin }}" class="form-control shadow-none @error('linkedin') is-invalid @enderror" id="linkedin">
                                @error('linkedin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="logo" class="mt-2">Company Logo</label>
                                <input class="form-control" id="logo" type="file" name="logo" onchange="readURL(this);">
                                <div class="form-group my-2">
                                    <img class="form-controlo img-thumbnail" src="#" id="previewImage" style="width: 150px;height: 70px;">
                                </div>
                                <label for="about_image">About Image</label>
                                <input class="form-control" id="about_image" type="file" name="about_image" onchange="readAboutURL(this);">
                                <div class="form-group mt-2">
                                    <img class="form-controlo img-thumbnail" src="#" id="previewAboutImage" style="width: 150px;height: 120px;">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="instagram">Company Instagram</label>
                                <input type="url" name="instagram" value="{{ $company->instagram }}" class="form-control shadow-none @error('instagram') is-invalid @enderror" id="instagram">
                                @error('instagram')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="bg_image">Background Image</label>
                                <input class="form-control" id="bg_image" type="file" name="bg_image" onchange="readBgURL(this);">
                                <div class="form-group mt-2">
                                    <img class="form-controlo img-thumbnail" src="#" id="previewBgImage" style="width: 150px;height: 120px;">
                                </div>

                                <label for="about" class="mt-2">Company About</label>
                                <textarea class="form-control" name="about" id="about_description" cols="4" rows="4">{{ $company->about }}</textarea>
                                @error('about')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr class="mt-0">
                        <div class="clearfix mt-1">
                            <div class="float-md-right">
                                <button type="reset" class="btn btn-dark">Reset</button>
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
    $('#about_description').summernote({
        tabsize: 2,
        height: 220
    });
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#previewImage')
                    .attr('src', e.target.result)
                    .width(120)
                    .height(70);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    document.getElementById("previewImage").src="{{ $company->logo }}";

    function readAboutURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#previewAboutImage')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(120);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    document.getElementById("previewAboutImage").src="{{ $company->about_image }}";

    function readBgURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#previewBgImage')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(120);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    document.getElementById("previewBgImage").src="{{ $company->bg_image }}";
</script>
@endpush