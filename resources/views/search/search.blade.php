<?php
include SITE_ROOT.'/resources/views/tpl/head.blade.php';
include SITE_ROOT.'/resources/views/tpl/sidebar.blade.php';
?>  
<div class="photo_main_content">


<script>
function follow(item_id) {
  $.ajax({
    url:'/profile/ajax_follow?item_id='+item_id,
    method:'get',
    success: function(obj) {
      $('#follow_block_'+item_id).hide();
      $('#un_follow_block_'+item_id).show();
    }
  });
}
function unFollow(item_id) {
  $.ajax({
    url:'/profile/ajax_un_follow?item_id='+item_id,
    method:'get',
    success: function(obj) {
      $('#follow_block_'+item_id).show();
      $('#un_follow_block_'+item_id).hide();
    }
  });
}

</script>
<style>

    .photo_main_content{margin-top:54px} 
</style>
<?php
if(empty($users)) {
echo '<div class="block_empty_or_not_found">Не найдено ни отдного человека</div>';
} else {
foreach($users as $v) {
?>





















<div class="gallery">

<div class="gallery__photo_wrap">
<a href="/id<?php echo $v['data']['id'];?>">
<div class="gallery__photo photo_cover" style="background-image: url('<?php echo $v['data']['big_photo'];?>');">
</div>
</a>
<div class="gallery__wrap">
  <div class="gallery__wrap_title"><?php echo $v['first_name'];?>		</div>
  <div class="gallery__wrap_body"> 	
<?php echo $v['photos_counter'] ;?> Фото
  </div>

  <div class="gallery__wrap_bottom">
<button id="follow_block_<?php echo $v['id'];?>" class="button"<?php echo $v['is_i_follow']?'style="display:none"':'';?> onClick="follow(<?php echo $v['id'];?>)">Подписаться</button>
<button id="un_follow_block_<?php echo $v['id'];?>" class="button button_gray"<?php echo !$v['is_i_follow']?'style="display:none"':'';?> onClick="unFollow(<?php echo $v['id'];?>)">Отписаться</button>

    </div>

</div>

</div>
</div>















<?php
}
}
?>
</div>
<?php
include SITE_ROOT.'/resources/views/tpl/other.blade.php';
include SITE_ROOT.'/resources/views/tpl/footer.blade.php';
?>