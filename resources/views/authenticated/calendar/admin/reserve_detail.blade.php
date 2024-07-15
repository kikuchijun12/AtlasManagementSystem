@extends('layouts.sidebar')

@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="reserve_detail w-75 m-auto h-75">
    @foreach ($reservePersons as $reservePersons)
    <p><span>{{ \Carbon\Carbon::parse($reservePersons->setting_reserve)->format('Y年m月d日') }}</span>
      <span class="ml-3">
        {{ $reservePersons->setting_part }}部
      </span>
    </p>
    <div class="reserve_detail-main h-75 border">
      <table class="table-styled">
        <tr class="reserve_text-center">
          <th class="w-25">ID </th>
          <th class="w-25">名前 </th>
          <th class="w-25">場所 </th>
        </tr>
        @foreach ($reservePersons->users as $user)
        <tr class="rs_text-center">
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
