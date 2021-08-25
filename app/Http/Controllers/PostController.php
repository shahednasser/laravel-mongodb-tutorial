<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function home() {
        $posts = Post::with(['user'])->get();

        return view('home', ['posts' => $posts->toArray()]);
    }

    public function createForm() {
        return view('post_form');
    }

    public function save(Request $request) {
        Validator::validate($request->all(), [
            'id' => 'nullable|exists:posts,_id',
            'title' => 'required|min:1',
            'content' => 'required|min:1'
        ]);

        /** @var User $user */
        $user = Auth::user();
        $id = $request->get('id');

        if ($id) {
            $post = Post::query()->find($id);
            if ($post->user->_id !== $user->_id) {
                return redirect()->route('home');
            }
        } else {
            $post = new Post();
            $post->user()->associate($user);
        }
        
        $post->title = $request->get('title');
        $post->content = $request->get('content');

        $post->save();

        return redirect()->route('home');
    }

    public function delete(Request $request) {
        Validator::validate($request->all(), [
            'id' => 'exists:posts,_id'
        ]);

        $post = Post::query()->find($request->get('id'));
        $post->delete();

        return redirect()->route('home');
    }

    public function editForm(Request $request, $id) {
        $post = Post::query()->find($id);
        if (!$post) {
            return redirect()->route('home');
        }
        return view('post_form', ['post' => $post]);
    }
}
