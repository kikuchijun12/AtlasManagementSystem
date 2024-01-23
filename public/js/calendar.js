$(function () {
  // 確認モーダルが表示される前に、対象の日付と部を取得
  $('.delete_date').on('click', function () {
    var reserveDate = $(this).data('reserve-date');
    var reservePart = $(this).data('reserve-part');

    // モーダル内の削除ボタンにデータを設定
    $('#confirmDelete').data('reserve-date', reserveDate);
    $('#confirmDelete').data('reserve-part', reservePart);
  });

  // 削除ボタンがクリックされたとき
  $('#confirmDelete').on('click', function () {
    var reserveDate = $(this).data('reserve-date');
    var reservePart = $(this).data('reserve-part');

    // Ajaxリクエストで予約を削除
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/delete/reserve",
      data: {
        reserveDate: reserveDate,
        reservePart: reservePart
      },
    }).done(function (res) {
      // 成功時の処理（リダイレクトなど）
      console.log(res);
      window.location.reload(); // 例: ページをリロード
    }).fail(function (res) {
      // 失敗時の処理
      console.log('fail');
    });

    // モーダルを閉じる
    $('#deleteModal').modal('hide');
  });
});
