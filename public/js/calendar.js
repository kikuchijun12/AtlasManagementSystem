$(function () {
  $('.delete_date').on('click', function () {
    var id = $(this).data('id');
    var setting_reserve = $(this).data('setting_reserve');
    var setting_part = $(this).data('setting_part');

    $('.modal-inner-body span.reserve').html('予約日: ' + setting_reserve + '<br>時間: リモ' + setting_part + '部<br>上記の予約をキャンセルしてもよろしいですか? ');
    $('.edit-modal-hidden').val(id);
    $('.js-modal').fadeIn();
  });
});
