$(function () {
  $('.main_categories').click(function () {
    var category_id = $(this).attr('category_id'); // 'category_id'を取得

    // サブカテゴリの要素を取得
    var $subCategories = $('.category_num' + category_id).find('.sub_categories');

    // サブカテゴリのスライドトグル
<<<<<<< HEAD
    $subCategories.slideToggle();
    var $label = $(this).find('.label');


    $label.toggleClass('active');

    // 'active' クラスがある場合とない場合のスタイルを設定
=======
    $subCategories.toggleClass('show');

    // 矢印の回転部分（クリックされたメインカテゴリの矢印のみ操作）
    var $arrow = $(this).find('.arrow');
    $arrow.toggleClass('active');
>>>>>>> ad55749 (cssに関する部分を修正しました。)
  });
});

$(document).on('click', '.like_btn', function (e) {
  e.preventDefault();
  $(this).addClass('un_like_btn');//クラスを付与したい要素を対象
  $(this).removeClass('like_btn');// like_btn
  var post_id = $(this).attr('post_id');
  var count = $('.like_counts' + post_id).text();
  var countInt = Number(count);
  $.ajax({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    method: "post",
    url: "/like/post/" + post_id,
    data: {
      //post_idというキーに
      post_id: $(this).attr('post_id'),
    },
  }).done(function (res) {
    console.log(res);
    $('.like_counts' + post_id).text(countInt + 1);
  }).fail(function (res) {
    console.log('fail');
  });
});

$(document).on('click', '.un_like_btn', function (e) {
  e.preventDefault();
  $(this).removeClass('un_like_btn');
  $(this).addClass('like_btn');
  var post_id = $(this).attr('post_id');
  var count = $('.like_counts' + post_id).text();
  var countInt = Number(count);

  $.ajax({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    method: "post",
    url: "/unlike/post/" + post_id,
    data: {
      post_id: $(this).attr('post_id'),
    },
  }).done(function (res) {
    $('.like_counts' + post_id).text(countInt - 1);
  }).fail(function () {

  });
});

$('.edit-modal-open').on('click', function () {
  $('.js-modal').fadeIn();
  var post_title = $(this).attr('post_title');
  var post_body = $(this).attr('post_body');
  var post_id = $(this).attr('post_id');
  $('.modal-inner-title input').val(post_title);
  $('.modal-inner-body textarea').text(post_body);
  $('.edit-modal-hidden').val(post_id);
  return false;
});
$('.js-modal-close').on('click', function () {
  $('.js-modal').fadeOut();
  return false;
});
