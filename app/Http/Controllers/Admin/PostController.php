<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    private $postValidation = [
        'title' => 'required|max:255',
        'content' => 'required',
        'category_id' => 'nullable|exists:categories,id',
        'tags' => 'exists:tags,id'
    ];

    private function generateSlug($data) {
        $slug = Str::slug($data["title"], '-');

        $existingSlug = Post::where('slug', $slug)->first();

        $slugBase = $slug;
        $counter = 1;

        while($existingSlug) {
            $slug = $slugBase . "-" . $counter;
            $existingSlug = Post::where('slug', $slug)->first();
            $counter++;
        }

        return $slug;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $request->validate($this->postValidation);

        
        $newPost = new Post();

        $slug = $this->generateSlug($data);

        $data['slug'] = $slug;
        $newPost->fill($data); // aggiungiamo $fillable nel Model (Post)

        $newPost->save();

        if(array_key_exists('tags', $data)) {
            $newPost->tags()->attach($data["tags"]);
        }

        return redirect()
            ->route('admin.posts.show', $newPost->id)
            ->with('created', $newPost->title);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();
        
        $request->validate($this->postValidation);

        if($post->title != $data["title"]) {
            $slug = $this->generateSlug($data);

            $data["slug"] = $slug;
        }

        $post->update($data);

        if(array_key_exists('tags', $data)) {
            $post->tags()->sync($data["tags"]);
        } else {
            $post->tags()->detach();
        }

        return redirect()
            ->route('admin.posts.show', $post->id)
            ->with('edited', $post->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

       return redirect()
            ->route('admin.posts.index')
            ->with('deleted', $post->title);
    }
}
