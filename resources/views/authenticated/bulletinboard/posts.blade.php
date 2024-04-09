@extends('layouts.sidebar')

@section('content')
test
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto">投稿一覧</p>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p><span class="bold-text">{{ $post->user->over_name }}</span><span class="ml-3 bold-text">{{ $post->user->under_name }}</span>さん</p>
      <p class="bold-text"><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      <div class="subCategory-detile">
        @if($post->subCategories->isNotEmpty())
        <a>{{ $post->subCategories->first()->sub_category }}</a>
        @endif
      </div>
      </li>

      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">
          <div class="mr-5">
            <i class="fa fa-comment"></i><span class="">{{ $post->postComments->count() }}</span>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><a href="{{ route('post.show', ['id' => $post->id]) }}"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i></a><span class="like_counts{{ $post->id }}">{{ $post->likesCount }}</span></p>
            @else
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $post->likesCount }}</span></p>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area border w-25 mr-5">
    <div class="border m-4">
      <div class="post-btn"><a href="{{ route('post.input') }}">投稿</a></div>
      <div class="post-search-box">
        <input type="text" class="post-input" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
        <input type="submit" class="post-search-btn" value="検索" form="postSearchRequest">
      </div>
      <input type="submit" name="like_posts" class="category_btn like_posts_btn" value="いいねした投稿" form="postSearchRequest">
      <input type="submit" name="my_posts" class="category_btn my_posts_btn" value="自分の投稿" form="postSearchRequest">
      <p class="category-text">カテゴリー検索</p>
      <ul>
        @foreach($categories as $category)
        <li class="main_categories" category_id="{{ $category->id }}"><span>{{ $category->main_category }}<span>
              <span class="category_num{{ $category->id }}">
                <ul class="sub_categories" style="display: none;"> @foreach($category->subCategories as $subCategory)
                  <span><input type="submit" name="category_word" class="category_btn" value="{{ $subCategory->sub_category }}" form="postSearchRequest">
                    @endforeach
                </ul>
              </span>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
@endsection
