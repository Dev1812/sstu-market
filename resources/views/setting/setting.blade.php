<?php
include SITE_ROOT.'/resources/views/tpl/head.blade.php';
include SITE_ROOT.'/resources/views/tpl/sidebar.blade.php';
?>  

<style type="text/css">
.big_form__title{font-size: 29px}
.big_form__block{width: 25%;margin:0 auto}
.setting_main_content{margin:95px 0 54px 0 ;text-align: center;}
.big_form__body{margin:14px 0}
.link_hovered:hover{border-bottom: 2px solid blue}
</style>

<div class="setting_main_content">
<div class="big_form__block">
<div class="big_form__title">Регистрация</div>
<FORM action="" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<?php

if(!empty($result)) {
  var_dump($result);
}

?>
<div class="big_form__body">
  <div>
    <div class="big_form__input_title"><a class="link_hovered" href="/setting/info">Инфо</a></div>

  </div>
</div>
<div class="big_form__body">
  <div>
    <div class="big_form__input_title"><a class="link_hovered" href="/setting/change_photo">Фото</a></div>

  </div>
</div>

</div>
</div>
<?php
include SITE_ROOT.'/resources/views/tpl/other.blade.php';
include SITE_ROOT.'/resources/views/tpl/footer.blade.php';
?>