@extends('layout.main')
@section('title')
    Edit Item
@endsection
@section('body')
    <div class="container-fluid border border-info" style="width: 60%;margin-top: 20px">
        <h1>Edit Item</h1>
        <form method="post" action="{{url('/editItem/'.$Item->id)}}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputName4">Name</label>
                    <input type="text" class="form-control" id="inputName4" placeholder="Name" name="name"
                           value="{{$Item->name}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPrice4">Price</label>
                    <input type="number" class="form-control" id="inputPrice4" placeholder="Price" name="price"
                           value="{{$Item->price}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Description</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Description" name="description"
                       value="{{$Item->description}}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Quantity</label>
                    <input type="number" class="form-control" id="inputPassword4" placeholder="Quantity" name="quantity"
                           value="{{$Item->quantity}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Category</label>
                    <select id="inputState" class="form-control" name="category">
                        <option @if ($Item->category == "Male")selected="selected" @endif>Male</option>
                        <option @if ($Item->category == "Female")selected="selected" @endif>Female</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputState">Available Sizes</label>
                    <select id="inputState" class="form-control" name="size">
                        <option @if ($Item->size == "S")selected="selected" @endif>S</option>
                        <option @if ($Item->size == "M")selected="selected" @endif>M</option>
                        <option @if ($Item->size == "L")selected="selected" @endif>L</option>
                        <option @if ($Item->size == "XL")selected="selected" @endif>XL</option>
                        <option @if ($Item->size == "XXL")selected="selected" @endif>XXL</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group form-group col-md-4 border border-secondary"
                     style="margin-left: 10%;padding: 5px">
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="picture">
                    <label for="exampleFormControlFile1">Upload item picture</label>
                </div>
                <div class="form-group form-group col-md-4 border border-secondary"
                     style="margin-left: 10%;padding: 5px">
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="model"
                           value="{{$Item->model}}">
                    <label for="exampleFormControlFile1">Upload item model or video</label>
                </div>
            </div>
            <hr>

            <div class="form-row" style="margin-left: 40%">
                <div>
                    <a class="btn btn-primary" href="{{url('/')}}" style="margin:5px">CANCEL</a>
                </div>
                <button type="submit" class="btn btn-primary" style="margin:5px">SUBMIT</button>
            </div>
        </form>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
