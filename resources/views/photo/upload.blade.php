<?php
include SITE_ROOT.'/resources/views/tpl/head.blade.php';
include SITE_ROOT.'/resources/views/tpl/sidebar.blade.php';
?>
<style type="text/css">
.content{width:350px;}
</style>
<script type="text/javascript">



function selectPhoto(file) {
  var form_data = new FormData();
  form_data.append('file', file);
  $.ajax({
    url:'//local.photo-upadte.io/photo_upload.php?_token={{csrf_token()}}',
    data: form_data,
    method: 'post',
    processData: false,
    contentType: false,
    success: function(obj) {
        console.log(obj);//background-image: url('//local.photo-upadte.io/q/14895.jpg');
        obj = JSON.parse(obj);
        $('#photo_preview').css('background-image', 'url(//local.photo-upadte.io/'+obj.big_photo_path+')');
        $('#big_photo_path').val(obj.big_photo_path);
        $('#file_upload_section').hide();
    }

  });
}

  
function photoUpload() {
  $.ajax({
    method: 'post',
    url: '/photo/save_photo/?_token={{csrf_token()}}',
    data: {'title': $('#title').val(),
        "_token": "{{ csrf_token() }}", 'big_photo':$('#big_photo_path').val(), 'small_photo': $('#big_photo_path').val(),

        'is_anonim':$('input[name="is_anonim"]:checked').val(),
'_token': '{{csrf_token()}}'},
    success: function(obj) {
    }
  });
}

</script>
</script>
<div class="content">
<div class="create-question-container">

<input type="hidden" name="big_photo_path" id="big_photo_path">
  
<div class="form-block">
<div class="form-title">Загрузка фото</div>
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
  



  


<div class="gallery-block" style="width: 100%;">
<div class="gallery-wrap">
<div class="gallery-photo__wrap">
<div class="gallery-photo photo_block" id="photo_preview" style="background-image: url();"></div>
</div>
<div class="gallery-info">
<div class="gallery-body">
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
<div class="form-big-element">
<span class="form-big-element__title">
  Загрузка фото
</span>
<input type="file" name="l_email" class="form-big-element__text_field text_field" placeholder="Ваш email" onChange="selectPhoto(this.files[0]);">
</div>	


<div class="form-big-element">
<span class="form-big-element__title">
  Название
</span>
<input type="text" name="title" id="title" class="form-big-element__text_field text_field" placeholder="Название фото">
</div>


<div class="form-big-element">
  <div style="font-weight:bold;margin:7px 0">Об авторе</div>

  <div>
    <input type="radio" id="is_anonim" name="is_anonim" value="owner_public" checked />
    <label for="owner_public">Публично</label>
  </div>

  <div>
    <input type="radio" id="is_anonim" name="is_anonim" value="anonim" />
    <label for="owner_anonim">Анонимно</label>
  </div>






<div class="form-big-element" style="margin-top:11px;">
<input type="submit" name="l_email" class="button" onClick="event.preventDefault();photoUpload();" placeholder="Название фото">
</div>


</div>
<div class="gallery-bottom"></div>
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