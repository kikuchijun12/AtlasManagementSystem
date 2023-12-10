<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\PostSubCategory;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\main_categoryRequest;
use App\Http\Requests\subcategoryRequest;
use Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function show(Request $request)
    {
        $posts = Post::with('user', 'postComments')->get();
        $result = PostSubCategory::with('post_sub_categories')->get();
        //dd($result);
        $like = new Like;
        $categories = MainCategory::with('subCategories')->get();
        //11/28追加　投稿のサブカテゴリー表示
        $Sub_categories = SubCategory::get();
        //dd($Sub_categories);
        $post_comment = new Post;
        if (!empty($request->keyword)) {
            $posts = Post::with('user', 'postComments')
                ->where('post_title', 'like', '%' . $request->keyword . '%')
                ->orWhere('post', 'like', '%' . $request->keyword . '%')->get();
        } else if ($request->category_word) {
            $sub_category = $request->category_word;
            $posts = Post::with('user', 'postComments')->get();
        } else if ($request->like_posts) {
            $likes = Auth::user()->likePostId()->get('like_post_id');
            $posts = Post::with('user', 'postComments')
                ->whereIn('id', $likes)->get();
        } else if ($request->my_posts) {
            $posts = Post::with('user', 'postComments')
                ->where('user_id', Auth::id())->get();
        }
        //11/15　追記　カウント
        $posts->each(function ($post) use ($like) {
            //いいね数をeachで格納
            $post->likesCount = $like->likeCounts($post->id);
        });
        //コメント
        $posts->each(function ($post) use ($post_comment) {
            $post->commentCounts = $post_comment->commentCounts($post->id);
        });
        return view('authenticated.bulletinboard.posts', compact('posts', 'categories', 'Sub_categories', 'like', 'post_comment', 'result'));
    }

    public function postDetail($post_id)
    {
        $post = Post::with('user', 'postComments')->findOrFail($post_id);
        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }

    public function postInput()
    {
        $main_categories = MainCategory::get();
        $Sub_categories = SubCategory::get();
        //dd($main_categories);
        return view('authenticated.bulletinboard.post_create', compact('main_categories', 'Sub_categories'));
    }

    public function postCreate(PostFormRequest $request)
    {
        $sub_category = $request->sub_category_id;
        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body
        ]);
        $post->post_sub_categories()->attach($sub_category);
        return redirect()->route('post.show');
    }

    public function postEdit(Request $request)
    {
        $rules = [
            'post_title' => 'required|string|max:100',
            'post_body' => 'required|string|max:5000',
        ];

        $messages = [
            'post_title.required' => 'タイトルは必須です。',
            'post_title.max' => 'タイトルは:max文字以下で指定してください。',
            'post_body.required' => '投稿内容は必須です。',
            'post_body.max' => '投稿内容は:max文字以下で指定してください。',
        ];

        $validator = $this->validate($request, $rules, $messages);

        $post_id = $request->input('post_id');

        Post::where('id', $post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        return redirect()->route('post.detail', ['id' => $post_id]);
    }

    public function postDelete($id)
    {
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }
    public function mainCategoryCreate(main_categoryRequest $request)
    {
        MainCategory::create(['main_category' => $request->main_category_name]);
        return redirect()->route('post.input');
    }

    public function subCategoryCreate(subcategoryRequest $request)
    {
        //dd($request);
        SubCategory::create([
            'main_category_id' => $request->main_category_id,
            'sub_category' => $request->sub_category_name
        ]);
        return redirect()->route('post.input');
    }

    public function commentCreate(CommentRequest $request)
    {
        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function myBulletinBoard()
    {
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    public function likeBulletinBoard()
    {
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }

    public function postLike(Request $request)
    {
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        // いいね追加後、該当の投稿のいいね数を更新
        $post = Post::find($post_id);
        $post->like_count = $post->likes()->count();
        $post->save();

        return response()->json();
    }

    public function postUnLike(Request $request)
    {
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->where('like_user_id', $user_id)
            ->where('like_post_id', $post_id)
            ->delete();

        return response()->json();
    }
}
