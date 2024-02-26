@extends('layouts.sidebar')

@section('content')

<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto border" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>

<!-- モーダル本体 -->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <div class="w-100">
      <div class="modal-inner-title w-50 m-auto">
        <input type="text" name="setting_reserve" placeholder="日" class="w-100">
        <input type="submit" class="btn btn-primary d-block" value="編集">
      </div>
      <div class="modal-inner-title w-50 m-auto">
        <input type="text" name="setting_part" placeholder="タイトル" class="w-100">
      </div>
      <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
        <textarea placeholder="部数" name="setting_part" class="w-100"></textarea>
      </div>
      <!--@if(isset($reserve_settings))-->
      <div class="w-50 m-auto edit-modal-btn d-flex">
        <form action="{{ route('deleteParts', $reserveSettings->id) }}">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="edit-modal-hidden" name="id" value="">
          <button type="submit">削除</button>
        </form>
      </div>
      <!--@endif-->
    </div>
    {{ csrf_field() }}
  </div>
</div>
@endsection
