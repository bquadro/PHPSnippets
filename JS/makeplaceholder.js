
var MSIE = navigator.userAgent.indexOf("MSIE") !=-1; 

$(document).ready(function(){
  $('.form .form-item.form-type-textfield, .form .form-item.form-type-password, .form .form-item.form-type-textarea, .form .webform-component-textfield .form-item, .form .webform-component-textarea, .form .webform-component-email .form-item').each(function(){
      var $this = $(this);
      var v = $this.find('label').text();
      v = v.replace(/\s?\*$/,'');
      v = v.replace(/\:\s??$/,'');
      $('input, textarea', $this).attr('placeholder', v);
      //console.log(MSIE);
      if(MSIE){
        $('input[name!="captcha_response"], textarea', $this)
        .val(v)
        .keyup(function(){
          var v = $(this).attr('placeholder');
          if($(this).val() == v){
            $('input, textarea', $this).val('');
          }
          if($(this).val() == ''){
            $('input, textarea', $this).val(v);
          }
        });
      }
      $this.find('label').hide();
  });
});