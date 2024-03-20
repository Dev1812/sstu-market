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
<div class="form-title">Регистрация</div>
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
  Название товара
</span>
<input type="text" name="product_title" class="form-big-element__text_field text_field" placeholder="Ваше имя">
</div>


<div class="form-big-element">
<span class="form-big-element__title">
  Описание товара
</span>
<TEXTAREA type="text" name="product_description" class="form-big-element__text_field text_field" placeholder="Ваш пароль"></TEXTAREA>
</div>


<div class="form-big-element">
<span class="form-big-element__title">
  Wtyf
</span>
<input type="text" name="product_cost" class="form-big-element__text_field text_field" placeholder="Ваш пароль">
</div>

<div class="form-block" style="margin-top:14px;">
<div class="form-body">
<div class="form-big-element">
  <input type="submit" name="product_submit" class="button" value="Зарегестрироваться">
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