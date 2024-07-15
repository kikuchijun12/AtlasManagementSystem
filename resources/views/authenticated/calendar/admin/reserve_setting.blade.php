@extends('layouts.sidebar')
@section('content')

<div class="w-100 vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="main-visual border w-75 m-auto pt-5 pb-5" style=" border-radius:5px; background:#ECF1F6;">
    <div class="register-calendar-outer w-100 border p-5" style=" border-radius:5px; background:#fff;">
      <div class="inner-content">
        {!! $calendar->render() !!}
        <div class="adjust-table-btn m-auto text-right">
          <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
