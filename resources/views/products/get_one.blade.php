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
.head-item{display: inline-block;height: 54px;line-height: 54px}
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
</style>

<div class="wrap1">

<div class="head">
<div class="head-wrap">
<div class="head-right"><i class="icon cart-variant-custom"></i></div>
<div class="head-left"><a class="head-item">SSTU-market</a></div>
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















<style type="text/css">
.product-title{font-weight: bold;font-size:1.7em}
.products-page{
    width: 77%;
    margin: 17px auto;}
    .product-info__line{margin-bottom: 7px}
    .product-info__action{margin-top:9px;margin-bottom:9px}
</style>


<div class="photo-get-one">
  


<div class="photo-get-one__photo_wrap">
  <div  style="float: left;">
<div class="photo-get-one__photo" style="background-image:url('/image/bmw_csl_hommage_vid_sboku_105056_1680x1050.jpg');width:410px;height:373px;background-repeat: no-repeat;background-size: cover;background-position: center;">
  </div>
</div>
  
</div>


<div class="photo-get-one__info" style="margin-left: 450px;">
<div class="product-title">iPhone</div>

<div class="product-info__lin product-info__action">
  <button class="button">Купить</button>
</div>

<div class="product-info__line">
Место производства: Тайвань
</div>

<div class="product-info__line">
  Размер:XL
</div>


</div>



</div>





























<div style="clear: both;"></div>
<div class="comments">

<style type="text/css">
.comment-block{padding:17px 0}
.write-comment__block{padding:7px 0 7px}
.textarea{font-size:1.0em}
.comments_counter{font-size:1.3em;margin:7px 0 9px}
</style>

<div class="comments_counter">Комментарии (2)</div>

<div class="write-comment__block" >
<TEXTAREA class="text_field textarea" placeholder="Ваш комментарий" style="padding:9px 14px"></TEXTAREA>
  <div><input type="submit" class="button"></div>
</div>

<?php
for($i=0;$i<9;$i++) {
?>
<div class="comment-block">

<style type="text/css">
.comment-title{font-weight:bold}
.comment-date__created{color: #808080}
</style>
<div class="comment-body">
<div class="comment-title">Павел Дуров</div>
<div class="comment-text">
Очень классные ботинки, качество просто шикарное👍, носок широкий, мизинцы давить не будут, возврат по причине того что размер не подошёл, будем заказывать другой размер.
</div>
<div class="comment-date__created">24 dec at 11:40</div>
</div>


</div>
<?php
}
?>



</div>




</div>
	

</div>
<div class="footer"></div>

</div>

</body>
</html>