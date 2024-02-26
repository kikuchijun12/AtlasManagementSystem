$(function () {
  // 確認モーダルが表示される前に、対象の日付と部を取得
  $('.delete_date').on('click', function () {
    // モーダルの中身表示
    $('.js-modal').fadeIn();
    // 予約した日付と部数を取得
    var reserveDate = $(this).attr('setting_reserve');
    var reservePart = $(this).attr('setting_part');
    var id = $(this).attr('id');
    $('.modal-inner-title input').val(reserveDate);
    $('.modal-inner-body textarea').text(reservePart);
    $('.edit-modal-hidden').val(id);

    // 取得した日付・部をモーダルの中身へ表示
    $('.js-modal').html('<p>予約日付: ' + reserveDate + '</p><p>予約部数: ' + reservePart + '</p>');

    return false;
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });

});
