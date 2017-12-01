$(function () {
  'use strict';
// Switch between login & signup
$('.login-page h1 span').click(function () {
  $(this).addClass('selected').siblings().removeClass('selected');
  $('.login-page form').hide();
  $('.' + $(this).data('class')).fadeIn(100);
});

   // tigger selectboxit
  $("select").selectBoxIt({
  autoWidth: false
  });

  // hide placeholder on form focus
  $('[placeholder]').focus(function () {
    $(this).attr('data-text', $(this).attr('placeholder'));
    $(this).attr('placeholder', '');
  }).blur(function () {
    $(this).attr('placeholder', $(this).attr('data-text'));
  });

  // Add asterisk on required field
  $('.inputs').each(function (){
    if ($(this).attr('required') === 'required'){
      $(this).after('<span class="asterisk">*</span>');
    }
  });

  // confirmation message on button
  $('.confirm').click(function(){
    return confirm('Are You Sure ?');

    // show add live items
  });
$('.live').keyup(function () {
  $($(this).data('class')).text($(this).val());
});


}); // document.ready
