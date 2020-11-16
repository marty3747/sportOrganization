<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $posts = Post::join('users', 'author_id', '=', 'users.id')
                ->where('title', 'like', '%'.$request->search.'%')
                ->orWhere('descr', 'like', '%'.$request->search.'%')
                ->orWhere('name','like','%'.$request->search)
                -> orwhere ('category', 'like', '%'.$request->search.'%')
                ->orderBy('posts.created_at', 'desc')
                ->get();
            return view ('posts.index', compact('posts'));

        }

        $posts = Post::join('users', 'author_id', '=', 'users.id') // связь двух таблиц. вначала таблица, потом по каким полям
                ->orderBy('posts.created_at', 'desc') // сортировка по полям
                ->paginate(4);
        return view ('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request) // запись в базу данных
    {
        $post = new Post();
        $post->title = $request -> title;
        $post->short_title = Str::length($request->title)>30? Str::substr($request->title,0,30) . '...' : $request->title;
        $post->descr = $request -> descr;
        $post->actual = $request->actual;
        $post->category = $request->category;
        $post->author_id = \Auth::user()->id;

        if($request->file('img')) {
            $path = Storage::putFile('public', $request->file('img'));
            $url = Storage::url($path);
            $post->img = $url;
        }

        $post->save(); // сохраняет

        return redirect()->route('post.index')->with('success', 'Мероприятие успешно создано!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // смотрим конкретный пост
    {
        $post = Post::join('users', 'author_id', '=', 'users.id')
                ->find($id); // связь двух таблиц. вначала таблица, потом по каким полям

        if (!$post) {
            return redirect()->route('post.index')->withErrors('Страницы не существует');
        }

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('post.index')->withErrors('Страницы не существует');
        }

        if ($post->author_id != \Auth::user()->id) {
            return redirect()->route('post.index')->withErrors('Вы не можете редактировать данный пост');
        }
        return view('posts.edit', compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('post.index')->withErrors('Страницы не существует');
        }

        if ($post->author_id != \Auth::user()->id) {
            return redirect()->route('post.index')->withErrors('Вы не можете редактировать данный пост');
        }
        $post->title = $request->title;
        $post->short_title = Str::length($request->title)>30? Str::substr($request->title,0,30) . '...' : $request->title;
        $post->descr = $request -> descr;
        $post->actual = $request->actual;
        $post->category = $request->category;
        $post->author_id = \Auth::user()->id;

        if($request->file('img')) {
            $path = Storage::putFile('public', $request->file('img'));
            $url = Storage::url($path);
            $post->img = $url;
        }

        $post->update(); // обновляет
        $id = $post->post_id;
        return redirect()->route('post.show', compact('id'))->with('success', 'Мероприятие успешно отредактировано!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('post.index')->withErrors('Страницы не существует');
        }

        if ($post->author_id != \Auth::user()->id) {
            return redirect()->route('post.index')->withErrors('Вы не можете редактировать данный пост');
        }

        $post->delete();
        return redirect()->route('post.index', compact('id'))->with('success', 'Мероприятие успешно удалено!');
    }
}
