<?php

namespace App\Http\Controllers;
use App\Models\products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function getAllproducts()
    {
        $posts= products::paginate(10);
        return ProductResource::collection($posts);
    }
    
    public function store(Request $request)
    {
        $post = new products();
        $post->name = $request->name;
       
        $post->description = $request->description;
        $post->image = $request->image;
       
        if($post->save()){
            return new ProductResource($post);
        }
    }



    public function show($id)
    {
        $posts= products::findOrFail($id);
        return new ProductResource ($posts);
        
    }



    public function update(Request $request, $id)
    {
        //$post = post::find($id);
        ///$post->update($request->all());

        ///  return $post;
        $posts= products::findOrFail($id);
        $post->name = $request->name;
       
        $post->description = $request->description;
        $post->image = $request->image;
       
        if($post->save()){
            return new ProductResource($post);
        }
    }




    public function destroy($id)
    {
        $posts= products::findOrFail($id);
        if($post->delete()){
            return new ProductResource($post);
        }
    }
}
