@extends('layouts.default')
@section('content')


<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">product</a></li> 
    / <li class="">Add product</li>
  </ol>
</nav>

<form method="post" id="myForm" action="{{$route}}">
    @csrf

        <input type="hidden" name="cid" value="{{isset($product) ? $product->product_id:' '}}">

    <div class="row">


            
                    <div class="mb-3 col-md-12">
                        <label for="exampleInputUsername1" class="form-label">Product Name</label>
                        <input type="text" name="name" value="{{isset($product) ? $product->name :'' }}" class="form-control" required>
                    </div>
                  

                    <div class="mb-3 col-md-12">
                        <label for="exampleInputPassword1" class="form-label">description</label>
                        <textarea class="form-control" name="description" id="" rows="3" >{{isset($product) ? $product->description :'' }}</textarea>
                    </div>

                   

                    <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">price</label>
                        <input type="number" name="price" value="{{isset($product) ? $product->price :'' }}" class="form-control" >
                    </div>

                     <div class="mb-3 col-md-6">
                        <label for="exampleInputPassword1" class="form-label">image url</label>
                        <input type="text" name="image_url" value="{{isset($product) ? $product->image_url :'' }}" class="form-control" >
                    </div>


                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                    
                    </div>
                


    </div>
</form>





@stop