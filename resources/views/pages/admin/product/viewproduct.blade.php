@extends('layouts.default')
@section('content')


<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">product</a></li> 
    / <li class="">view product</li>
  </ol>
</nav>

<div>
    <a href="{{route('sync.product')}}"><button class="btn btn-primary btn-sm">sync product</button></a>
</div>

<div class="row">

        <div
            class="table-responsive border"
        >
            <table
                class="table"
            >
                <thead>
                    <tr class="text-canter">
                        <th scope="col">name</th>
                        <th scope="col">description</th>
                        <th scope="col">price</th>
                        <th scope="col">image</th>
                        <th scope="col">status</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product as $row)
                    <tr class="text-canter">
                        <td scope="row"><a>{{$loop->iteration}}.) {{$row->name}}</a></td>
                        <td> <a class="opencontact"  data-route="{{route('opencontact',[$row->product_id])}}" data-para="contact" style="cursor:pointer;">description</a></td>
                        <td> {{$row->price}}</td>
                         <td><img src="{{$row->image_url}}" width="150" height="150"></td>
                        <td>
                                @if($row->status ==1)
                                            <a href="{{route('product.chngestatus',[$row->product_id])}}" onclick="return confirm('Are you sure you want to change the status?')" ><span class="text-success">Active</span></a>
                                @else
                                              <a href="{{route('product.chngestatus',[$row->product_id])}}" onclick="return confirm('Are you sure you want to change the status?')" ><span class="text-danger">deactive</span></a>
                                @endif
                        </td>
                        <td>
                                <a href="{{route('edit.product',[$row->product_id])}}"><i class="link-icon" data-lucide="pencil"></i></a>
                                <a href="{{route('delete.product',[$row->product_id])}}" onclick="return confirm('Are you sure you want to delete this product?')" ><i class="link-icon" data-lucide="trash"></i></a>    

                        </td>
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>
        </div>
        

</div>


@stop