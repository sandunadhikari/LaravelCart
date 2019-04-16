@extends('layout.main')
@section('title')
    welcome
@endsection

@section('body')
    <div class="container">
        <h1>Items</h1>
        <div class="row">
            <div>
                <a class="btn btn-outline-info btn-lg" href="{{url('Create')}}" style="margin: 10px">Create</a>
            </div>
            <div>
                <a class="btn btn-outline-info btn-lg" href="{{url('publish')}}" style="margin: 10px">Publish Changes</a>
            </div>
        </div>
        <div id="products" class="row view-group">
            @foreach($allItems as $value)
                <div class="item col-xs-4 col-lg-4" style="margin-bottom: 50px">
                    <div class="thumbnail card">
                        <div class="img-event">
                            <img class="group list-group-image img-fluid"
                                 style="height:250px;display: block;margin-left: auto;margin-right: auto"
                                 src="{{$value->picture}}"
                                 alt=""/>
                        </div>
                        <div class="caption card-body">
                            <h4 class="group card-title inner list-group-item-heading" style="text-align: center">
                                {{$value->name}}</h4>
                            <p class="group inner list-group-item-text">
                                {{$value->description}}</p>
                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <p class="lead">
                                        Rs.{{$value->price}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p class="lead" style="font-size: 18px">
                                        Size:{{$value->size}}</p>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p class="lead" style="font-size: 16px">
                                        Quantity:{{$value->quantity}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <a class="btn btn-success" href="{{ url('/getOneItem/' . $value->id) }}"
                                       id="{{$value->id}}">Update</a>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <a class="btn btn-success" href="{{ url('/deleteItem/' . $value->id) }}"
                                       id="{{$value->id}}">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
@endsection

