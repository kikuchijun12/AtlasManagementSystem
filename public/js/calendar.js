$(function () {
  $('.delete_date').on('click', function () {
    var id = $(this).data('id');
    var setting_reserve = $(this).attr('data-setting_reserve');
    var setting_part = $(this).data('setting_part');

    //受け取った値をinput type="hidden"に設定
    $('.reserve_part').val(setting_part); //追加
    $('.reserve_date').val(setting_reserve); //追加

    //モーダルに予約情報を表示
    $('.modal-inner-body span.reserve').html('予約日: ' + setting_reserve + '<br>時間: リモ' + setting_part + '部<br>上記の予約をキャンセルしてもよろしいですか? ');
    $('#deleteForm input[name="delete-id"]').val(id);
    $('.js-modal').fadeIn();
  });

  // $(function () {
  //   $('.cancel').on('click', function (e) {
  //     e.preventDefault(); // デフォルトのフォーム送信を防止

  //     var part = $(this).data('setting_part');
  //     var date = $(this).data('setting_reserve');

  //     // フォームの隠しフィールドに値を設定
  //     $('form#deleteParts input[name="getPart"]').val(part);
  //     $('form#deleteParts input[name="getData"]').val(date);

  //     // フォームを送信
  //     $('form#deleteParts').submit();
  //   });
  // });

});
