@extends('layout.main')
@section('title')
    Create Item
@endsection
@section('body')
    <div class="container-fluid border border-info" style="width: 60%;margin-top: 20px">
        <h1>Create Item</h1>
        <form method="post" action="{{url('/addItem')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputName4">Name</label>
                    <input type="text" class="form-control" id="inputName4" placeholder="Name" name="name">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPrice4">Price</label>
                    <input type="number" class="form-control" id="inputPrice4" placeholder="Price" name="price">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Description</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Description" name="description">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Quantity</label>
                    <input type="number" class="form-control" id="inputPassword4" placeholder="Quantity"
                           name="quantity">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Category</label>
                    <select id="inputState" class="form-control" name="category">
                        <option selected>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputState">Available Sizes</label>
                    <select id="inputState" class="form-control" name="size">
                        <option selected>S</option>
                        <option>M</option>
                        <option>L</option>
                        <option>XL</option>
                        <option>XXL</option>
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
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="model">
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
