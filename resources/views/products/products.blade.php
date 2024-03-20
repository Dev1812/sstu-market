<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

<style type="text/css">

@font-face{font-family:Myriad_set_pro_Thin;src:local(Myriad_set_pro_Thin),url(../fonts/myriad-set-pro_text.woff)}
html,body{margin:0;font-size:1.1em;margin:0;padding:0}
*{box-sizing:border-box;font-family:-apple-system ,BlinkMacSystemFont ,'Segoe UI',"Myriad_set_pro_Thin","SF Pro Text","Myriad Set Pro","SF Pro Icons","Apple Legacy Chevron","Helvetica Neue","Helvetica","Arial",sans-serif}

.head-right{float: right}
.head-center{position: absolute;top:0;left:0;right:0;text-align: center;}
.head{height:54px;border-bottom: 1px solid #CCC;background-color: #673ab7;color: #FFF;}
.html, body{}
.head-item{display: inline-block;height: 54px;line-height: 54px;color:#FFF}
.text_field{width: 100%;border-radius:7px;padding:0 11px}
.big_text_field{height:34px;}
.head-center{width: 59%;margin:0 auto;padding-top:9px}
.head-wrap{margin: 0 19px}
.cart-variant-custom{background-image: url('/image/icon/cart-variant-custom.png');width: 24px;
    background-position: center;
    height: 49px;
    background-repeat: no-repeat;
    width: 38px;




}
.icon{position: relative;display: inline-block;}
a{text-decoration: none;}
</style>

<div class="wrap1">

<div class="head">
<div class="head-wrap">
	<?php

if(isUserAuth()) {
	?>

<div class="head-right">
	<i class="icon cart-variant-custom" style="float:left;margin-right:7px;"></i>
	<span class="head-item"><?php echo session('user_first_name');?></span>




</div>
	<?php
} else {

	?>


<div class="head-right">
	<i class="icon cart-variant-custom" style="float:right"></i>




	<a href="/login" class="head-item">вход</a>
	<a href="/reg" class="head-item">регистрация</a>





</div>
	<?php
}

	?>
<div class="head-left"><a class="head-item" href="/feed">SSTU-market</a></div>
<div class="head-center"><input type="text" class="text_field big_text_field" placeholder="Поиск"></div>
</div>
</div>
<div class="content">


<div class="products-page">
<style type="text/css">
.product-block{width:20%;display: inline-block;margin:-3px}
.product-block__photo{width: 100%;height: 240px}
.product-block__wrap{padding:9px}
.product-block__photo{background-size: cover;background-position: center}
.product-block__title{font-size: 1.3em}
.button{
    background-color: #673AB7;
    color: #FFF;
    padding: 0 11px;
    font-size: .9em;
    border-radius: 9px;
    height: 33px;
    line-height: 28px;cursor: pointer;}
    .product-block__action{margin-top:9px}
</style>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script type="text/javascript">
function addToCart(product_id) {
  $.ajax({
  	url: '/products/ajax_add_to_cart?product_id='+product_id,
  	method: 'get',
  	success: function(obj) {
alert(obj);
  	}
  });
}
</script>

<?php
foreach($products as $v) {
?>

<div class="product-block">
<div class="product-block__wrap">
	<a href="/products/get_one/14">
<div class="product-block__photo__wrap">
<div class="product-block__photo" style="background-image:url('<?php echo $v['photo_big'];?>');">
</div>
</div></a>

<div class="product-block__body">
	<div class="product-block__title"><?php echo $v['title'];?></div>
	<div class="product-block__action"><button class="button" onClick="addToCart(<?php echo $v['id'];?>);">в корзину</button></div>
</div>


</div>
</div>

<?php
}
?>

</div>
	

</div>
<div class="footer"></div>

</div>

</body>
</html>