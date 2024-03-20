<?php
include SITE_ROOT.'/resources/views/tpl/head.blade.php';
include SITE_ROOT.'/resources/views/tpl/sidebar.blade.php';
?>
<div class="page" style="width: 80%;margin:0 auto">


	<script type="text/javascript">
function test() {
  $.ajax({
    url: '/photo/ajax_preview/2',
    method:'get',
    success:function(obj) {
      var ff = JSON.parse(obj);
      console.log(ff.photo_html);
    }
  });
}
var global_item_id = 0;
function showPhotoView(item_id) {
  global_item_id = item_id;
  $.ajax({
    url: '/photo/ajax_preview/'+item_id,
    method: 'get',
    success: function(obj) {
      var obj = JSON.parse(obj);
      console.log(obj);
     // $('#popup_box_content').html('<div class="photo_covered" style="background-image: url(); background-image: url('.obj.photo_path.');width: 100%;height: 540px;"></div>');

var ff = obj.photo_path;

    $('#popup_box_head').hide();

      $('#popup_box_wrap').css('width','55%');

    $('#popup_box_content').html('<div style="background-color:#000;width:31px;height:31px;position:absolute;top:0;right:0;text-align:center;padding-top:7px;border-radius:14px" onClick="PopUpBox.hide()"><i class="icon" style="width:17px;height:17px;background-image:url(/image/icon/close_small_white.png)"></i></div><div class="photo_covered" style="background-image: url(); background-image: url('+ff+');width: 100%;height: 540px;"></div><div  onClick="PopUpBox.hide()" style="margin: 25px 25px;\
    position: fixed;\
    top: 0;\
    right: 0;\
    width: 49px;\
    height: 49px;\
    background: #898989;text-align:center;\
    padding-top: 14px;border-radius:14px;\
}"><i class="icon" style="width:17px;height:17px;background-image:url(/image/icon/close_small_white.png)"></i></div>');
$('#popup_box_wrap').show();
   //   hide(''); 
    $('#popup_box_bottom').hide();

    $('#popup_box_fly_block').show(); 
      $('#popup_box_block').show(); 
      setTimeout(function() {
$('#popup_box_comments_block').html(obj.comments);

}, 100);

    }
  });
}
function removeLike(item_id) {
  var counter = $('#gallery_mark_counter_'+item_id).val();
  counter = parseInt(++counter);
  $('#dis_like_counter_'+item_id).text(counter);
  $('#add_like_counter_'+item_id).text(counter);

  $('#dis_like_block_'+item_id).hide();
  $('#add_like_block_'+item_id).show();
$('#gallery_mark_counter_'+item_id).val(counter);
  $.ajax({
  	url: '/photo/ajax_add_like?item_id='+item_id,
  	method: 'get',
  	success: function(obj) {
  	  console.log(obj);
  	}

  });

}
function  addLike(item_id) {
  var counter = $('#gallery_mark_counter_'+item_id).val();
  counter = parseInt(--counter);
if(counter<1) {
	counter=0;
}
  $('#dis_like_counter_'+item_id).text(counter);
  $('#add_like_counter_'+item_id).text(counter);


  $('#dis_like_block_'+item_id).show();
  $('#add_like_block_'+item_id).hide();

$('#gallery_mark_counter_'+item_id).val(counter);
  $.ajax({
  	url: '/photo/ajax_remove_like?item_id='+item_id,
  	method: 'get',
  	success: function(obj) {
  	  console.log(obj);
  	}

  });

}


function restorePhoto(item_id) {
$.ajax({
  url: '/photo/ajax_restore?item_id='+item_id,
  method: 'get',
  success:function(obj) {
      $('#photo_delete_block_'+item_id).hide();
      $('#gallery_photo_action_cover_gray_'+item_id).hide();
  }
});
}
function deletePhoto(item_id) {
$.ajax({
  url: '/photo/ajax_delete?item_id='+item_id,
  method: 'get',
  success:function(obj) {
    $('#photo_delete_block_'+item_id).show();
    $('#gallery_photo_action_cover_gray_'+item_id).show();

  }
});
}
function addComment(item_id) {
  var comment_write = $('#comment_write').val();
  $.ajax({
    url: '/photo/ajax_add_comment?item_id='+global_item_id+'&comment_write='+comment_write,
    method: 'get',
    success: function(obj) {
      alert(obj);
obj = JSON.parse(obj);
      var new_el = document.createElement("div");
      new_el.innerHTML=obj.html;

ge('comments_body').insertBefore(new_el, ge('comments_body').firstElementChild);
    }

  });
}

	</script>


	<div class="page_head">
	  <div class="page_title" style="text-align: center;">@<?php  echo $owner_info[0]['login'];?></div>
	</div>


















<div class="gallery_block" style="width: 100%;text-align: center;">
<div class="gallery_block_wrap">
<div class="gallery_photo_wrap">
<div class="gallery_photo photo_covered photo_gray" style="width: 25%;margin:0 auto; background-image: url('<?php echo $owner_info[0]['big_photo'];?>');"></div>
	
</div>
<div class="gallery_wrap">
	<div class="gallery_title"><?php  echo $owner_info[0]['first_name'].' '.$owner_info[0]['last_name'];?></div>
  <div class="gallery_bio" style="margin-top:9px"><?php  echo $owner_info[0]['bio'];?></div>
	<div class="gallery_info">
    <?php
if($owner_info[0]['id'] == session('user_id')) {
  echo '    <div style="margin-top:9px;"><a href="/setting/change_photo"><span style="border-bottom: 1px dashed blue"> Сменить фото</span></a></div>
';
}
    ?>
	</div>
</div>
</div>
</div>



<div class="nav">
	<a href="" class="nav_item nav_item_active">фото</a>
</div>







<style type="text/css">
.gallery_delete_action{
    background: transparent;
    /* content: close-quote; */
    color: #FFF;
    border: 1px solid #FFF;
    padding: 3px 9px 3px 9px;
    border-radius: 3px;cursor:pointer;transition: all 0.14s ease}
    .gallery_delete_action:hover{
    background: #FFF;
    color: #000!important;}
    .gallery_deleted_block_close{cursor:pointer;}
    .gallery_deleted_block_close:hover{background-color: #DDD}
</style>



	<div class="clear"></div>
<?php
if(empty($photos)) {
echo '<div class="block_empty_or_not_found">Не найдено ни отдного фото</div>';
} else {
foreach($photos as $v) {
?>
<input type="hidden" name="gallery_mark_counter_<?php echo $v['id'];?>" id="gallery_mark_counter_<?php echo $v['id'];?>" value="<?php echo $v['likes_counter'];?>">
<div class="gallery_block">
<div class="gallery_block_wrap">

















<div class="gallery_photo_wrap" style="position: relative;">
<div id="gallery_photo_action_cover_gray_<?php echo $v['id'];?>" style="position: absolute;top:0;left:0;right:0;bottom:0;background-color:#000;opacity: .5;display: none;">


</div>

<?php
if(session('user_id')==$v['owner_id']) {
  echo '
<div style="position: absolute;top:0;left: 0;right: 0;bottom:9;"><div class="gallery_deleted_block_close" style="width: 25px;height: 25px;position: absolute;top:0;right: 0;background-color: #FBFBFB;border-radius: 9px;text-align: center; " onClick="deletePhoto('.$v['id'].');"><i class="icon" style="
    top: 3px;background-image: url(/image/icon/close_small_black_0.png);width: 19px;height: 19px"></i>

  </div></div>';
}
?>


<div id="photo_delete_block_<?php echo $v['id'];?>" style="position: absolute;top:0;left:0;right:0;bottom:0;text-align:center;display: none; " >

  <div style="color: #fff;padding:24% 0">
    <div style="
    font-size: 19px;
    margin-bottom: 9px;">Фото удалено</div>
    <div><button class="gallery_delete_action" onClick="restorePhoto(<?php echo $v['id'];?>);">Восстановить</button></div>
  </div>
</div>
<!--
<div class="gallery_photo gallery_photo_image photo_covered" style=" background-image: url('<?php echo $v['big_photo'];?>');" onClick="showPhotoView(<?php echo $v['id'];?>);"></div><!--</a>-->

    
<div class="gallery_photo photo_covered" onClick="showPhotoView(<?php echo $v['id'];?>);" style=" background-image: url('<?php echo $v['big_photo'];?>');"></div>
  
</div>













  <style type="text/css">
.gallery_mark{
    background-color: #EEE;
    display: inline-block;
    padding: 5px 7px 3px 7px;border-radius:9px;cursor: pointer;}
.gallery_mark:hover{background-color: #CCC}
.gallery_mark_counter{
    font-size: 13px;
    font-weight: bold;
    position: relative;
    top: -2px;}
.gallery_marks{
    margin-top: 14px;}

.gallery_icon_mark{width: 17px;height: 17px}
    .icon_dis_like{background-image: url('/image/icon/like_in_active_green_small.png');}
.icon_like{background-image: url('/image/icon/like_active_green_small.png');}
</style>

<div class="gallery_wrap">
	<div class="gallery_title"><?php  echo $v['title'];?></div>
	<div class="gallery_info">
		<span class="gallery_date_created"><?php echo $v['date_created'];?></span>
	</div>



	<div class="gallery_marks">
		<div <?php if($v['is_my_like'])echo ' style="display:none"';?> onClick="removeLike(<?php echo $v['id'];?>);" class="gallery_mark gallery_mark_dis_like" id="dis_like_block_<?php echo $v['id'];?>">
			<i class="icon gallery_icon_mark icon_dis_like"></i>
			<span class="gallery_mark_counter" id="dis_like_counter_<?php echo $v['id'];?>"><?php echo $v['likes_counter'];?></span>
		</div>
		<div <?php if(!$v['is_my_like'])echo ' style="display:none"';?> onClick="addLike(<?php echo $v['id'];?>);" class="gallery_mark gallery_mark_like" id="add_like_block_<?php echo $v['id'];?>">
			<i class="icon gallery_icon_mark icon_like"></i>
			<span class="gallery_mark_counter" id="add_like_counter_<?php echo $v['id'];?>"><?php echo $v['likes_counter'];?></span>
		</div>
	</div>


</div>
</div>
</div>
<?php
}
}
?>
<div class="clear"></div>
</div>
<?php
include SITE_ROOT.'/resources/views/tpl/other.blade.php';
include SITE_ROOT.'/resources/views/tpl/footer.blade.php';
?>