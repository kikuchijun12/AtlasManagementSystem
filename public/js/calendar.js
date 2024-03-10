$(function () {
  $('.delete_date').on('click', function () {
    var id = $(this).attr('id');
    console.log(id);
    var setting_reserve = $(this).attr('setting_reserve');
    var setting_part = $(this).attr('setting_part');
    // Ajaxリクエストを使用して、IDに基づいてデータを取得する
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: 'GET',
      url: "/getReserve/calendar/" + id,
      data: {
        id: id,
        setting_reserve: setting_reserve,
        setting_part: setting_part
      },
    }).done(function (res) {
      console.log(res);
      $('.modal-inner-body span.reserve').html('予約日: ' + res.setting_reserve + '<br>時間: ' + res.setting_part + '<br>上記の予約をキャンセルしてもよろしいですか? ');
      $('.edit-modal-hidden').val(res.id);
      // モーダルを表示するなど、適切な処理を行う
      $('.js-modal').fadeIn();
    }).fail(function (res) {
      console.log('fail');
    });
  });


  // モーダルを閉じる処理
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
});
