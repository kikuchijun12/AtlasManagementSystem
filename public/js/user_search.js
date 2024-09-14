$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
  });

  $(document).ready(function () {

    $('.subject_edit_btn').click(function () {
      $('.subject_inner').slideToggle();
<<<<<<< HEAD
=======
      $(this).siblings('.arrow').toggleClass('active');
>>>>>>> ad55749 (cssに関する部分を修正しました。)
    });
  });
});
