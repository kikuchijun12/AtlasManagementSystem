@extends('layouts.sidebar')

@section('content')
<div class="w-75 m-auto">
  <div class="w-100">
    <p>{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
  </div>
</div>
<div class="modal js-modal">
  <div class="modal__content">
    <form action="/delete/calendar" method="post">

  </div>
</div>
@endsection
