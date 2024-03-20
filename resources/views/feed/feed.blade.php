<?php
include SITE_ROOT.'/resources/views/tpl/head.blade.php';
include SITE_ROOT.'/resources/views/tpl/sidebar.blade.php';
?>
<div class="content">
<div class="questions-container">


<?php
foreach($questions as $v) {
?>

<div class="question-block">

<a class="question-title" href="/get_question/<?php echo $v['data']['id'];?>">
<?php echo $v['data']['title'];?>
</a>
<div class="question-body">
<script type="text/javascript">
function function_name(s) {

	document.getElementById('wr_'+s).style.display='none';
	document.getElementById('full_text_'+s).style.display='block';
}
</script>
<?php echo cutStr($v['data']['text'], 300);?>

<?php if(mb_strlen($v['data']['text'])>300) echo '<div><span style="color:blue" id="wr_'.$v['data']['id'].'" onClick="function_name('.$v['data']['id'].')">развернуть...</span>


<div style="display:none" id="full_text_'.$v['data']['id'].'">'.$v['data']['text'].'</div>


</div>';?>
</div>
<div class="question-bottom">
<a href="#"><?php echo $v['owner_info'][0]['first_name'];?></a>
<span class="divider">|</span>
<span><?php echo $v['date_created'];?></span>
<span class="divider">|</span>
<a href="/reply_to_question/<?php echo $v['data']['id'];?>">ответить</a>
</div>

</div>
<?php
}
?>

</div></div>
<?php
include SITE_ROOT.'/resources/views/tpl/sidebar.blade.php';
include SITE_ROOT.'/resources/views/tpl/footer.blade.php';
?>  