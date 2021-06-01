<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('author')->orderByDesc('featured')->orderByDesc('date')->get()->toJson();
        return response($posts,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $imageName = time().'.'.$request->image->extension();
        $request->image->storeAs('public/images', $imageName);

        $post = new Post($request->all());
        $post->author_id = \Auth::id();
        $post->slug = Post::returnSlug($post->title);
        $post->image = '/images/'.$imageName;
        if (!$request->has('date') || $request->get('date') === 'undefined'){
           $post->date = Carbon::now();
        }
        $post->save();

        return response([$post],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return response(Post::whereSlug($slug)->first(),200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePostRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $fields = $request->all();
        $post = Post::find($id);

        if ($request->hasFile('image') && strlen($request->image) > 1){
            if ($post->image && file_exists(storage_path('app/public/'.$post->image))){
                unlink(storage_path('app/public/'.$post->image));
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('public/images', $imageName);

            $post->image = '/images/'.$imageName;
        }
        unset($fields['image']);

        $post->fill($fields)->save();

        return response($post,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $product = Post::find($id);
        $product->delete();

        return response()->json('Product deleted!');
    }
}
