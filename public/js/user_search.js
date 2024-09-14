$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
  });

  $(document).ready(function () {

    $('.subject_edit_btn').click(function () {
      $('.subject_inner').slideToggle();
      $(this).siblings('.arrow').toggleClass('active');
    });
  });
});
