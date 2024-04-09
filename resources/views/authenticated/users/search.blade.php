@extends('layouts.sidebar')

@section('content')
<div class="search_content w-100 border d-flex">
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class="border one_person">
      <div class="one_person-text">
        <div class="one_person-detail">
          <span class="users-type">ID : </span><span>{{ $user->id }}</span>
        </div>
        <div class="one_person-detail"><span class="users-type">名前 : </span>
          <a href="{{ route('user.profile', ['id' => $user->id]) }}">
            <span>{{ $user->over_name }}</span>
            <span>{{ $user->under_name }}</span>
          </a>
        </div>
        <div class="one_person-detail">
          <span class="users-type">カナ : </span>
          <span>({{ $user->over_name_kana }}</span>
          <span>{{ $user->under_name_kana }})</span>
        </div>
        <div class="one_person-detail">
          @if($user->sex == 1)
          <span class="users-type">性別 : </span><span>男</span>
          @elseif($user->sex == 2)
          <span class="users-type">性別 : </span><span>女</span>
          @else
          <span class="users-type">性別 : </span><span>その他</span>
          @endif
        </div>
        <div class="one_person-detail">
          <span class="users-type">生年月日 : </span><span>{{ $user->birth_day }}</span>
        </div>
        <div class="one_person-detail">
          @if($user->role == 1)
          <span class="users-type">役職 : </span><span>教師(国語)</span>
          @elseif($user->role == 2)
          <span class="users-type">役職 : </span><span>教師(数学)</span>
          @elseif($user->role == 3)
          <span class="users-type">役職 : </span><span>講師(英語)</span>
          @else
          <span class="users-type">役職 : </span><span>生徒</span>
          @endif
        </div>
        <div class="one_person-detail">
          @if($user->role == 4)
          <span class="users-type">選択科目 :</span>
          @foreach($user->subjects as $subject)
          <span>{{ $subject->subject }}</span>
          @endforeach
          @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="search_area w-25 border">
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest">
      <div class="">
        <div class="search-type">
          <lavel>検索</lavel>
          <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
        </div>
        <div class="search-type">
          <lavel>カテゴリ</lavel>
          <select form="userSearchRequest" name="category" class="common-search">
            <option value="name">名前</option>
            <option value="id">社員ID</option>
          </select>
        </div>
        <div class="search-type">
          <label>並び替え</label>
          <select name="updown" form="userSearchRequest" class="common-search">
            <option value="ASC">昇順</option>
            <option value="DESC">降順</option>
          </select>
        </div>
        <div class="">
          <p class="m-10 search_conditions"><span>検索条件の追加</span></p>
          <div class="search_conditions_inner">
            <div class="search-type">
              <label>性別</label>
              <div class="search-jender">
                <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
                <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
                <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
              </div>
            </div>
            <div class="search-sub">
              <label>権限</label>
              <select name="role" form="userSearchRequest" class="common-search engineer">
                <option selected disabled>----</option>
                <option value="1">教師(国語)</option>
                <option value="2">教師(数学)</option>
                <option value="3">教師(英語)</option>
                <option value="4" class="">生徒</option>
              </select>
            </div>
            <div class="selected_engineer">
              <label>選択科目</label>
              <div class="search-jender">
                <span>国語</span><input type="checkbox" name="subject[]" value="1" form="userSearchRequest">
                <span>数学</span><input type="checkbox" name="subject[]" value="2" form="userSearchRequest">
                <span>英語</span><input type="checkbox" name="subject[]" value="3" form="userSearchRequest">
              </div>
            </div>
          </div>
        </div>
        <div class="search-btn">
          <input type="submit" name="search_btn" value="検索" form="userSearchRequest">
          </div=post-btn>
        </div>
        <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
        <div class="text-center">
          <input type="reset" value="リセット" form="userSearchRequest">
        </div>
    </form>
  </div>
</div>
@endsection
