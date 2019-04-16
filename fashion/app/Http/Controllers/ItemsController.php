<?php

namespace App\Http\Controllers;

use App\Items;
use Carbon\Carbon;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ItemsController extends Controller
{
    public function index()
    {
        return view('CreateItem');
    }

    public function postItem(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:20',
            'description'=>'required|max:30',
            'price'=>'required|max:4',
            'picture'=>'mimes:jpeg,jpg,png|required|max:10000',
            'model'=>['required', 'max:20000', new Uppercase],
            'size'=>'required',
            'quantity'=>'required|max:3',
            'category'=>'required',
        ]);

        $currentTime = Carbon::now()->timestamp;


        $image = $request->file('picture');
        $pic_name = $currentTime . '.' . $image->getClientOriginalExtension();
        $path_pic = '/public/' . $currentTime . '/picture';
        $upload_pic = Storage::putFileAs($path_pic, $image, $pic_name);
        $picture_url = asset('storage/' . $currentTime . '/picture/' . $pic_name);

        $model = $request->file('model');
        $model_name = $currentTime . '.' . $model->getClientOriginalExtension();
        $path_model = '/public/' . $currentTime . '/model';
        $upload_model = Storage::putFileAs($path_model, $model, $model_name);
        $model_url = asset('storage/' . $currentTime . '/model/' . $model_name);


        $getType = $model->getClientOriginalExtension();
        if ($getType == "mp4") {
            $model_type = "video";
        } elseif ($getType == "and") {
            $model_type = "model";
        }
        $item = new Items();
        $item->name = $request->input('name');
        $item->type = $model_type;
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->picture = $picture_url;
        $item->model = $model_url;
        $item->size = $request->input('size');
        $item->quantity = $request->input('quantity');
        $item->category = $request->input('category');
        $item->save();
        //return response()->json(['message' => $item], 201);
        return redirect('/');

    }

    public function getItem()
    {
        $allItems = Items::all();
        return view('welcome', ['allItems' => $allItems]);
        //return response()->json(['allItems'=>$allItems],200);
    }

    public function getOneItem($id)
    {
        $Item = Items::find($id);
        return view('UpdateItem', ['Item' => $Item]);
        //return response()->json(['Item' => $Item],200);
    }

    public function deleteItem($id)
    {

        $item = Items::find($id);
        if (!$item) {
            return response()->json(['message' => "data not found"], 404);
        }
        $item->delete();
        return back()->withInput();
        //return response()->json(['message' => "data delete successfully"], 201);
    }

    public function editItem(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|max:20',
            'description'=>'required|max:30',
            'price'=>'required|max:30',
            'picture'=>'mimes:jpeg,jpg,png|max:10000',
            'model'=>['max:20000', new Uppercase],
            'size'=>'required',
            'quantity'=>'required',
            'category'=>'required',
        ]);
        $currentTime = Carbon::now()->timestamp;


        $image = $request->file('picture');
        $model = $request->file('model');

        $item = Items::find($id);
        if (!$item) {
            return response()->json(['message' => "data not found"], 404);
        }

        if($image!=null){
            $pic_name = $currentTime . '.' . $image->getClientOriginalExtension();
            $path_pic = '/public/' . $currentTime . '/picture';
            $upload_pic = Storage::putFileAs($path_pic, $image, $pic_name);
            $picture_url = asset('storage/' . $currentTime . '/picture/' . $pic_name);


        }else{
            $picture_url=$item->picture;

        }
        if ($model!=null){
            $model_name = $currentTime . '.' . $model->getClientOriginalExtension();
            $path_model = '/public/' . $currentTime . '/model';
            $upload_model = Storage::putFileAs($path_model, $model, $model_name);
            $model_url = asset('storage/' . $currentTime . '/model/' . $model_name);

            $getType = $model->getClientOriginalExtension();
            if ($getType == "mp4") {
                $model_type = "video";
            } elseif ($getType == "and") {
                $model_type = "model";
            }
        }else{
            $model_type=$item->type;
            $model_url=$item->model;
        }

        $item->name = $request->input('name');
        $item->type = $model_type;
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->picture = $picture_url;
        $item->model = $model_url;
        $item->size = $request->input('size');
        $item->quantity = $request->input('quantity');
        $item->category = $request->input('category');
        $item->save();
        //return response()->json(['message' => $item], 200);
        return redirect('/');
    }
    public function publishItem()
    {
        $specific_ladies= Items::where('category', 'Female')->get();
        $specific_gens= Items::where('category', 'Male')->get();

        Storage::put('/public/project/manifest.json', json_encode(['frok'=>$specific_ladies,'shirt'=>$specific_gens],JSON_UNESCAPED_SLASHES));
        return back()->withInput();
        //return DB::table('items')->get();

    }
    public function manifest(){
        $storeData= DB::table('storedata')->get();
        return (json_encode($storeData ,JSON_UNESCAPED_SLASHES));

    }
}
