$(function () {
  $('.delete_date').on('click', function () {
    var id = $(this).data('id');
    var setting_reserve = $(this).data('setting_reserve');
    var setting_part = $(this).data('setting_part');

    $('.modal-inner-body span.reserve').html('予約日: ' + setting_reserve + '<br>時間: ' + setting_part + '<br>上記の予約をキャンセルしてもよろしいですか? ');
    $('.edit-modal-hidden').val(id);
    // モーダルを表示するなど、適切な処理を行う
    $('.js-modal').fadeIn();
  });


  // モーダルを閉じる処理
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
});
// モーダルを閉じる処理
$('.js-modal-close').on('click', function () {
  $('.js-modal').fadeOut();
  return false;
});
