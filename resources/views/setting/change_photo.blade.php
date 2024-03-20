  <?php
  include SITE_ROOT.'/resources/views/tpl/head.blade.php';
  include SITE_ROOT.'/resources/views/tpl/sidebar.blade.php';
  ?>



  <div class="photo_content" style="width: 27%;margin:0 auto">

  <link rel="stylesheet" type="text/css" href="/css/photo.css?<?php echo rand();?>">







  <style type="text/css">
  .build_photo__user_bar{width: 100%!important;}
  .build_photo_image__user_bar{width: 100%;margin:0 auto;}

  </style>







  <div class="gallery__photo_wrap">

  <div class="form_content" style="width:100%">
  <div class="form_head">Сменить фото</div>


  <div class="nav" style="margin:14px 0 14px">
    
  <div class="nav_wrap">
    <a href="/setting/info" class="nav_item ">Инфо</a>
    <a href="/setting/change_photo" class="nav_item nav_item__active">Фото</a>
  </div>
  </div>


<div class="form_message form_message__error" id="change_photo_form_message_error" style="display: 
none;">
  <div class="form_message_title" id="change_photo_form_message_error_title"></div>
  <div class="form_message_body" id="change_photo_form_message_error_description"></div>
</div>
<div class="form_message form_message__success" id="change_photo_form_message_success" style="display: none;">
  <div class="form_message_title" id="change_photo_form_message_success_title"></div>
  <div class="form_message_body" id="change_photo_form_message_success_description"></div>
</div>

  <div class="form_body">

  <div class="gallery__photo photo_cover" id="photo_preview" style="background-image: url('<?php echo session('user_big_photo');?>');">
  </div>
  <div class="gallery__wrap">
    <div class="gallery__wrap_title">
    </div>
    <div class="gallery__wrap_body">

    </div>
    <div class="gallery__wrap_bottom"></div>

  </div>

  </div>









  <div class="build_photo build_photo__user_bar">
  <div class="build_photo_wrap">
  <div class="build_photo_image_wrap">


  <div class="gallery_block" style="width:100%">
  <div class="gallery_wrap">
  <div class="gallery_photo_wrap">
  <div class="gallery_photo photo_cover" id="photo_preview" style="background-image:url('<?php echo session('user_small_photo');?>');"></div>
  </div>

  <div class="gallery_content">

  </div>
  </div>
  </div>

  </div>

  <div class="build_photo_body">

  </div>
  <div class="build_photo_bottom">




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
          console.log(obj);
          obj = JSON.parse(obj);
        $('#photo_preview').css('background-image', 'url(//local.photo-upadte.io/'+obj.big_photo_path+')');
          $('#big_photo_path').val(obj.big_photo_path);
          $('#file_upload_section').hide();
      }

    });
  }

    
  function photoUpload() {
    $.ajax({
      method: 'get',
      url: '/photo/ajax_save_photo/?_token={{csrf_token()}}',
      data: {'title': $('#title').val(),
          "_token": "{{ csrf_token() }}", 'big_photo':$('#big_photo_path').val(), 'small_photo': $('#big_photo_path').val(),

          'is_anonim':$('input[name="is_anonim"]:checked').val(),
  '_token': '{{csrf_token()}}'},
      success: function(obj) {
  obj = JSON.parse(obj);
  if(obj.result.is_error==false) {
    if(obj.result.success.success_message.title) {
      
    console.log(obj);
      $('#change_photo_form_message_error').hide();
      $('#change_photo_form_message_success').show();

      $('#change_photo_form_message_success_title').text(obj.result.success.success_message.title);
      $('#change_photo_form_message_success_description').text(obj.result.success.success_message.description);
    }
   
      } else {
    if(obj.result.error.error_message.title) {
      $('#change_photo_form_message_error').show();
      $('#change_photo_form_message_success').hide();
      
      $('#change_photo_form_message_error_title').text(obj.result.error.error_message.title);
      $('#change_photo_form_message_error_description').text(obj.result.error.error_message.description);
    }

      }
    
  }
    });
  }

  </script>

  <?php
  /*
  var_dump($result);
  */
  ?>

  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
  <input type="hidden" name="" id="big_photo_path">




  <div class="big_form__body big_form__body_bottom_wrap" style="margin:14px 0">
    <div>
      <div class="big_form__input_input_wrap"><input type="file" name="reg_password" placeholder="Ваш пароль" class="input_file" onChange="selectPhoto(this.files[0]);"></div>
    </div>
  </div>


  <div class="big_form__body big_form__body_bottom_wrap">
    <div>

      <div class="big_form__input_input_wrap"><input type="submit" name="reg_submit" class="button" value="Загрузить фото" onClick="photoUpload()"></div>
    </div>
  </div>








  </div>

  </div>
  </div>














  </div></div></div>
  <?php
  include SITE_ROOT.'/resources/views/tpl/other.blade.php';
  include SITE_ROOT.'/resources/views/tpl/footer.blade.php';
  ?>





