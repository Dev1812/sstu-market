<?php
include SITE_ROOT.'/resources/views/tpl/head.blade.php';
include SITE_ROOT.'/resources/views/tpl/sidebar.blade.php';
?>
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
<div class="photo-main-page">
<div class="gallery-container">
<?php
foreach($photos as $v) {
?>
<div class="gallery-block">
<div class="gallery-wrap">
<div class="gallery-photo__wrap">
<div class="gallery-photo" style="background-image: url('//local.photo-upadte.io/<?php echo $v['data']['400_photo'];?>');"></div>
</div>
<div class="gallery-info">
<div class="gallery-title"><?php echo $v['data']['title'];?></div>
<div class="gallery-body">
<a href="/id<?php echo $v['owner_info'][0]['id'];?>">
<i class="icon gallery-small_photo photo_block" style="background-image:url('//local.photo-upadte.io/<?php echo $v['owner_info'][0]['400_photo'];?>');"></i>
<?php echo $v['owner_info'][0]['first_name'];?>
    
</a>
<span>|</span>
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
</div>
</div>
</div>
<?php
}
?>
</div>
</div>
<?php
include SITE_ROOT.'/resources/views/tpl/other.blade.php';
include SITE_ROOT.'/resources/views/tpl/footer.blade.php';
?>