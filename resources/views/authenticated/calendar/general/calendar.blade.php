@extends('layouts.sidebar')

@section('content')

<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="calendar-body w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="custom-width" style="border-radius:5px;">
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
    <form action="{{ route('deleteParts') }}" method="post">
      @csrf
      <div class="w-100">
        <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
          <span class="reserve" name="setting_reserve">
            <span class="reserve2" name="setting_part">
        </div>
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-primary d-inline-block" href="#">閉じる</a>
          <input type="hidden" class="edit-modal-hidden" name="id" value="">
          <input type="submit" class="cancel btn btn-danger" name="getPart[]" value="キャンセル">
        </div>
      </div>
      {{-- 送信用 --}}
      <input type="hidden" name="reserve_date" class="reserve_date" value="">{{-- 追加 --}}
      <input type="hidden" name="reserve_part" class="reserve_part" value="">{{-- 追加 --}}
    </form>
  </div>
</div>
@endsection
