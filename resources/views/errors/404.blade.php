<?php
include SITE_ROOT.'/resources/views/tpl/head.blade.php';
include SITE_ROOT.'/resources/views/tpl/sidebar.blade.php';
?>
<style type="text/css">
.page_not_found{text-align: center;padding:74px 0}
.not_found_title{font-size: 29px}
.not_found_body{font-size: 21px;margin:34px 0}
.not_found_to_main{font-size: 21px;}
.not_found_to_main_link:hover{border-bottom: 2px solid blue}
</style>
<div class="page">
<div class="page_not_found">

<div class="not_found_title">Не найдено</div>

<div class="not_found_body">По Вашему запросу ничего не найдено</div>

<div class="not_found_to_main"><a href="/" class="not_found_to_main_link">На главную<i class="icon" style="background-image: url('/image/icon/chevron-right-custom (1).png');width: 17px;height: 17px;"></i></a></div>

</div>
</div>
<?php
include SITE_ROOT.'/resources/views/tpl/other.blade.php';
include SITE_ROOT.'/resources/views/tpl/footer.blade.php';
?>