<?php
include SITE_ROOT.'/resources/views/tpl/head.blade.php';
include SITE_ROOT.'/resources/views/tpl/sidebar.blade.php';
?>
<style type="text/css">
.content{width:350px;}
</style>
<div class="content">
<div class="create-question-container">


  
<div class="form-block">
<div class="form-title">Информация</div>
  <FORM action="" method="POST">
    
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
<div class="form-body">

  
  <?php
if(!empty($result)) {
if($result['is_error']=='true') {
  ?>

<div class="form-message form-message__error">
  
<div class="form-message__title">
<?php
if(!empty($result['error']['error_message']['title'])) {
echo $result['error']['error_message']['title'];
}
?>
  </div>
<div class="form-message__body">
<?php
if(!empty($result['error']['error_message']['description'])) {
echo $result['error']['error_message']['description'];
}
?>
  </div>
</div>

  <?php
}
}
  ?>
  

<div class="form-big-element">
<span class="form-big-element__title">
  Имя
</span>
<input type="text" name="si_first_name" class="form-big-element__text_field text_field" placeholder="Ваше имя">
</div>

<div class="form-big-element">
<span class="form-big-element__title">
  Ваша фамилия
</span>
<input type="text" name="si_last_name" class="form-big-element__text_field text_field" placeholder="Ваша фамилия">
</div>


<div class="form-big-element">
<span class="form-big-element__title">
  Email
</span>
<input type="text" name="si_email" class="form-big-element__text_field text_field" placeholder="Ваш email">
</div>

<div class="form-big-element">
<span class="form-big-element__title">
  Логин
</span>
<input type="text" name="si_login" class="form-big-element__text_field text_field" placeholder="Ваш логин">
</div>
  

<div class="form-big-element">
<span class="form-big-element__title">
  Биография
</span>
<TEXTAREA type="text" name="si_password" class="form-big-element__text_field text_field" placeholder="Ваша биография" style="height:95px;"></TEXTAREA>
</div>

<div class="form-block" style="margin-top:14px;">
<div class="form-body">
<div class="form-big-element">
  <input type="submit" name="si_submit" class="button" value="Зарегестрироваться">
</div>
</div>
</div>  
</div>
</FORM>

</div>
</div>
</div>

<?php
include SITE_ROOT.'/resources/views/tpl/sidebar.blade.php';
include SITE_ROOT.'/resources/views/tpl/footer.blade.php';
?>  