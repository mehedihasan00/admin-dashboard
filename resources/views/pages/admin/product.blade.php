@extends('layouts.admin-master', ['pageName'=> 'product', 'title' => 'Add Product'])

{{-- @section('title') Add Product @endsection --}}

@push('admin-css')
    <link href="{{ asset('summernote/summernote-bs4.min.css') }}" rel="stylesheet">  
@endpush

@section('admin-content')


<main>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        @if(@isset($productData))
                        <i class="fas fa-edit mr-1"></i>Update Product
                        @else
                        <i class="fas fa-plus mr-1"></i>Add Product
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ (@$productData) ? route('admin.product.update', $productData->id) : route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <input type="hidden" name="old_image" value="{{ @$productData->image }}">
                            <div class="row">
                                <div class="col-md-7 mb-2">
                                    <label for="name" class="mb-2"> Product Name <span class="text-danger">*</span> </label>
                                    <input type="text" name="name" value="{{ @$productData->name }}" class="form-control mb-2" id="name" placeholder="Enter Category name">
                                    @error('name') <span style="color: red">{{$message}}</span> @enderror


                                    <label for="name" class="mb-2"> Product Description <span class="text-danger">*</span> </label>
                                    <textarea name="description" id="description" rows="4" class="form-control">{{ @$productData->description }}</textarea>
                                    @error('description') <span style="color: red">{{$message}}</span> @enderror
                                </div>

                                <div class="col-md-5 mb-2">
                                    <label for="name" class="mb-2"> Category <span class="text-danger">*</span> </label>
                                    <select name="category_id" class="form-control mb-2">
                                        <option value="">Select Category Option</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == @$productData->category_id ? 'selected' : '' }} >{{ $item->name }}</option>
                                        @endforeach
                                        
                                    </select>
                                    @error('category_id') <span style="color: red">{{$message}}</span> @enderror

                                    <label for="name" class="mb-2"> Subcategory <span class="text-danger">*</span> </label>
                                    <select name="subcategory_id" class="form-control mb-2">
                                        <option value="">Select Subcategory Option</option>
                                        
                                        
                                    </select>
                                    @error('category_id') <span style="color: red">{{$message}}</span> @enderror

                                    <label for="about_image" class="mb-2">Product Image</label>
                                    <input class="form-control" id="image" type="file" name="image" onchange="mainThambUrl(this)">
                                    <div class="form-group mt-2">
                                        <img class="form-controlo img-thumbnail" src="{{(@$productData) ? asset($productData->image) : asset('uploads/no.png') }}" id="mainThmb" style="width: 150px;height: 120px;">
                                    </div>
                                        @error('category_id') <span style="color: red">{{$message}}</span> @enderror
                                </div>
                            </div>

                            <div class="clearfix border-top">
                                <div class="float-md-right mt-2">
                                    <button type="reset" class="btn btn-dark">Reset</button>
                                    <button type="submit" class="btn btn-info">{{(@$productData)?'Update':'Create'}}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>

        </div>

        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="card my-3">
                    <div class="card-header">
                        <i class="fas fa-list mr-1"></i>
                        Product List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td><img src="{{ asset($item->image) }}" width="30" height="30" alt=""></td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ $item->subcategory->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.product.edit', $item->id) }}" class="btn-sm btn btn-info"><i class="fas fa-user-edit"></i></a>
                                            <a href="{{ route('admin.product.delete', $item->id) }}" onclick="confirm('Are you sure to Delete?')" class="btn-sm btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
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

<script>
    $(document).ready(function(){
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/product/subcategory/get') }}/"+category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    },
                });
            }else{
                alert('danger');
            }
        });
        
    });
</script>

<script>
    function mainThambUrl(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e){
            $('#mainThmb').attr('src',e.target.result).width(150)
                  .height(120);
        };
        reader.readAsDataURL(input.files[0]);


      }
    }
</script>

@endpush
