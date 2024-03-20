<?php
include SITE_ROOT.'/resources/views/tpl/head.blade.php';
include SITE_ROOT.'/resources/views/tpl/sidebar.blade.php';
?>




















<style type="text/css">
.form_content{padding:114px 0 0}
</style>







<div class="form_content">
<div class="form_head">Восстановиление пароля</div>
<div class="form_body">


<?php
if(!empty($result)) {
  echo '
<div class="form_message form_message__error">
<div class="form_message_title">'.$result['error']['error_message']['title'].'  </div>
<div class="form_message_text">'.$result['error']['error_message']['description'].'</div>
</div>

';          
}
?>

<FORM action="" method="GET">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  

  
<div class="form_big_section">
<div class="form_big_section_title">
<span class="form_big_section_title2">Email</span>
</div>
<div class="form_big_section_body">
<input type="text" class="text_field text_field_big" placeholder="Ваш email" name="restore_email">
</div>
</div>
  


  


  
<div class="form_big_section form_big_section_wrapper">
<div class="form_big_section_body">
<input type="submit" class="button" name="restore_submit" value="Восстановить">
</div>
</div>
</FORM>

</div>
</div>













<?php
include SITE_ROOT.'/resources/views/tpl/other.blade.php';
include SITE_ROOT.'/resources/views/tpl/footer.blade.php';
?>