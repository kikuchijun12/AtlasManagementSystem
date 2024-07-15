@extends('layouts.sidebar')

@section('content')
<div class="w-75 m-auto">
  <div class="abc w-100 vh-100 border p-5">
    <div class="confirmation w-100">
      <p class="confirmation-date">{{ $calendar->getTitle() }}</p>
      <p>{!! $calendar->render() !!}</p>
    </div>
  </div>
</div>
<div class="modal js-modal">
  <div class="modal__content">
    <form action="/delete/calendar" method="post">

  </div>
</div>
@endsection
