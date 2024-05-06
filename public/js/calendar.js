$(function () {
  $('.delete_date').on('click', function () {
    var id = $(this).data('id');
    console.log(id);
    var setting_reserve = $(this).data('setting_reserve');
    console.log(setting_reserve);
    var setting_part = $(this).data('setting_part');
    //モーダルに予約情報を表示
    $('.modal-inner-body span.reserve').html('予約日: ' + setting_reserve + '<br>時間: リモ' + setting_part + '部<br>上記の予約をキャンセルしてもよろしいですか? ');
    $('#deleteForm input[name="delete-id"]').val(id);
    $('.js-modal').fadeIn();
  });

  $('.btn-danger').on('click', function () {
    var formId = $(this).closest('form').attr('id').replace('deleteForm-', '');
    submitForm(formId);
  });

  function submitForm(dateId) {
    $('#deleteForm-' + dateId).submit();
  }
});
