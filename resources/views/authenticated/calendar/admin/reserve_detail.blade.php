@extends('layouts.sidebar')

@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="reserve_detail w-75 m-auto h-75">
    @foreach ($reservePersons as $reservePersons)
    <p><span>{{ $reservePersons->setting_reserve}}日</span><span class="ml-3">
        {{ $reservePersons->setting_part }}部
      </span></p>
    <div class="h-75 border">
      <table class="">
        <tr class="text-center">
          <th class="w-25">ID </th>
          <th class="w-25">名前 </th>
          <th class="w-25">場所 </th>
        </tr>
        @foreach ($reservePersons->users as $user)
        <tr class="text-center">
          <td class="w-25">{{ $user->id }}</td>
          <td class="w-25">
            <p>{{ $user->over_name }}{{ $user->under_name }}</p>
          </td>
          <td class="w-25">
            <p>リモート</p>
          </td>
        </tr>
        @endforeach
        @endforeach
        </tr>
      </table>
    </div>
  </div>
</div>
@endsection
