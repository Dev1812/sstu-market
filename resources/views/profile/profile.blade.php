<?php
include SITE_ROOT.'/resources/views/tpl/head.blade.php';
include SITE_ROOT.'/resources/views/tpl/sidebar.blade.php';
?>
<style type="text/css">
.profile-main-page .gallery-container{padding:24px 0 0;}
.gallery-user__bar{text-align: center;width: 100%;}
.gallery-user__bar .gallery-photo{margin: 0 auto;width:25%;}
</style>

<style type="text/css">
.gallery-bottom{margin-top:14px}
.like-block__counter{
    position: relative;
    font-size: 13px;
    font-weight: bold;
    top: -2px;}
</style>

<script type="text/javascript">
function addLike(item_id) {
  $.ajax({
    url:'/photo/ajax_add_like?target_id='+item_id,
    method:'get',
    success: function(obj) {
      obj=JSON.parse(obj);
      $('#add_like_block_'+item_id).hide();
      $('#remove_like_block_'+item_id).show();
      $('#add_like_counter_'+item_id).text(obj.likes_counter);
      $('#remove_like_counter_'+item_id).text(obj.likes_counter);
    }
  })
}
function removeLike(item_id) {
  $.ajax({
    url:'/photo/ajax_remove_like?target_id='+item_id,
    method:'get',
    success: function(obj) {
      obj=JSON.parse(obj);
      $('#add_like_block_'+item_id).show();
      $('#remove_like_block_'+item_id).hide();
      $('#add_like_counter_'+item_id).text(obj.likes_counter);
      $('#remove_like_counter_'+item_id).text(obj.likes_counter);
    }
  })
}
</script>
<div class="profile-main-page">
	<?php
if(empty($owner_info)) {
echo '<div class="empty_or_not_found_block">Не найдено ни отного профиля</div>';

} else {
	?>

<div class="gallery-container">


<div class="gallery-block gallery-user__bar">
<div class="gallery-wrap">
<div class="gallery-photo__wrap">
<div class="gallery-photo photo_block" style=" background-image: url('//local.photo-upadte.io/<?php echo $owner_info[0]['400_photo'];?>');"></div>
</div>
<div class="gallery-info">
<div class="gallery-title"><?php echo $owner_info[0]['first_name'];?></div>
<div class="gallery-body">
</div>
<div class="gallery-bottom"></div>
</div>
</div>
</div>

<div class="nav">
<a href="" class="nav-item nav-item__active">Фото</a>
</div>
	
<?php
if(empty($photos)) {
echo '<div class="empty_or_not_found_block">Не найдено ни отной записи</div>';
} else {
foreach($photos as $v) {
?>
<div class="gallery-block">
<div class="gallery-wrap">
<div class="gallery-photo__wrap">
<div class="gallery-photo photo_block" style="background-image: url('//local.photo-upadte.io/<?php echo $v['data']['400_photo'];?>');"></div>
</div>
<div class="gallery-info">
<div class="gallery-title"><?php echo $v['data']['title'];?></div>
<div class="gallery-body">
	<i class="icon icon-repost"></i>
<span><?php echo $v['date_created'];?></span>
<span></span>
</div>


<div class="gallery-bottom">

<div class="like-block"<?php if(!$v['is_my_like']) echo 'style="display:none"';?> onClick="addLike(<?php echo $v['data']['id'];?>)" id="add_like_block_<?php echo $v['data']['id'];?>">
<i class="icon like-block__icon like-block__active"></i>
<span id="add_like_counter_<?php echo $v['data']['id'];?>" class="like-block__counter"><?php echo $v['likes_counter'];?></span>
</div>	
<div class="like-block"<?php if($v['is_my_like']) echo 'style="display:none"';?> onClick="removeLike(<?php echo $v['data']['id'];?>)" id="remove_like_block_<?php echo $v['data']['id'];?>">
<i class="icon like-block__icon like-block__in_active"></i>
<span id="remove_like_counter_<?php echo $v['data']['id'];?>" class="like-block__counter"><?php echo $v['likes_counter'];?></span>
</div>	

</div>


<div class="gallery-bottom"></div>
</div>
</div>
</div>
<?php
}
}
?>
</div>
<?php
}
?>
</div>
<?php
include SITE_ROOT.'/resources/views/tpl/other.blade.php';
include SITE_ROOT.'/resources/views/tpl/footer.blade.php';
?>