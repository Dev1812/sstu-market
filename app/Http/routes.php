<?php
use Illuminate\Http\Request;

define('SHORT_FIRST_NAME_LENGTH', 3);    
define('LONG_FIRST_NAME_LENGTH', 70);

define('SHORT_LAST_NAME_LENGTH', 3);    
define('LONG_LAST_NAME_LENGTH', 70);   

define('SHORT_LOGIN_LENGTH', 3);    
define('LONG_LOGIN_LENGTH', 70);   

define('SHORT_EMAIL_LENGTH', 3);    
define('LONG_EMAIL_LENGTH', 70);   

define('SHORT_PASSWORD_LENGTH', 3);    
define('LONG_PASSWORD_LENGTH', 70);       

define('SITE_NAME', 'SSTU-market');
define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');

include_once SITE_ROOT.'/common.php';

Route::match(['get', 'post'], '/feed', function() {
  //SELECT `id`, `owner_id`, `title`, `time_created`, `cost`, `description`, `id_deleted` FROM `likes` WHERE 1
    $products = DB::table('products')->orderBy('id', 'DESC')->get();
    $products = json_decode(json_encode($products), true);
    return view('products.products', ['products'=>$products]);

})
;


Route::match(['get', 'post'], '/products/ajax_add_to_cart', function() {
  //SELECT `id`, `owner_id`, `title`, `time_created`, `cost`, `description`, `id_deleted` FROM `likes` WHERE 1
    /*$is_login_registered = DB::table('products')->orderBy('id', 'DESC')->get();
    $is_login_registered = json_decode(json_encode($is_login_registered), true);
    return view('products.products', ['is_login_registered'=>$is_login_registered]);*/
    session(['user_id'=> 3]);
    $asd = DB::table('carts')->insert(array(
'id'=>NULL,
'owner_id'=>session('user_id'), 
'product_id'=>$_GET['product_id'], 
'time_created'=>time()
    ));
});





Route::match(['get', 'post'], '/products/get_one/{product_id}', function() {

  return view('products.get_one');

});







































Route::match(['get', 'post'], '/reg', function() {
if(empty($_POST['r_submit'])) {
  return view('reg.reg');
} else {
  $first_name = makeSafetyString($_POST['r_first_name']);
  $last_name = makeSafetyString($_POST['r_last_name']);
  $email = makeSafetyString($_POST['r_email']);
  $login = makeSafetyString($_POST['r_login']);
  $password = makeSafetyString($_POST['r_password']);

/*
  $first_name = makeSafetyString('uiuiui');
  $last_name = makeSafetyString('sadasd');
  $email = makeSafetyString('remsaisl@mail.ru');
  $login = makeSafetyString('addaddd');
  $password = makeSafetyString('rpassword');
*/
  $first_name_length = mb_strlen($first_name);
  $last_name_length = mb_strlen($last_name);
  $email_length = mb_strlen($email);
  $login_length = mb_strlen($login);
  $password_length = mb_strlen($password);

  if($first_name_length < SHORT_FIRST_NAME_LENGTH) {
    return view('reg.reg', ['result'=>array('error_field'=>'first_name', 'is_error'=>true,'error'=>array('error_code'=>3,'error_message'=>Lang::get('messages.short_firstname')),'status'=>'error')]);
  } else if($first_name_length > LONG_FIRST_NAME_LENGTH) {
    return view('reg.reg', ['result'=>array('error_field'=>'first_name', 'is_error'=>true,'error'=>array('error_code'=>4,'error_message'=>Lang::get('messages.long_firstname')),'status'=>'error')]);
  } else if(preg_match("/[^a-zA-Zа-яА-Я]/u",$first_name)) {
    return view('reg.reg', ['result'=>array('error_field'=>'first_name', 'is_error'=>true,'error'=>array('error_code'=>5,'error_message'=>Lang::get('messages.incorrect_first_name')),'status'=>'error')]);
  }

  if($last_name_length < SHORT_LAST_NAME_LENGTH) {
    return view('reg.reg', ['result'=>array('error_field'=>'last_name','is_error'=>true,'error'=>array('error_code'=>6,'error_message'=>Lang::get('messages.short_lastname')),'status'=>'error')]);
  } else if($last_name_length > LONG_LAST_NAME_LENGTH) {
    return view('reg.reg', ['result'=>array('error_field'=>'last_name','is_error'=>true,'error'=>array('error_code'=>7,'error_message'=>Lang::get('messages.long_lastname')),'status'=>'error')]);
  } else if(preg_match("/[^a-zA-Zа-яА-Я]/u",$last_name)) {
    return view('reg.reg', ['result'=>array('error_field'=>'last_name', 'is_error'=>true,'error'=>array('error_code'=>8,'error_message'=>Lang::get('messages.incorrect_last_name')),'status'=>'error')]);
  }

  if($login_length < SHORT_LOGIN_LENGTH) {
    return view('reg.reg', ['result'=>array('error_field'=>'login','is_error'=>true,'error'=>array('error_code'=>9,'error_message'=>Lang::get('messages.short_login')),'status'=>'error')]);
  } else if($login_length > LONG_LOGIN_LENGTH) {
    return view('reg.reg', ['result'=>array('error_field'=>'login','is_error'=>true,'error'=>array('error_code'=>10,'error_message'=>Lang::get('messages.long_login')),'status'=>'error')]);
  } else if(!preg_match("/^[a-zA-Zа-яА-Я0-9+_@.-]*$/u",$login)) {
    return view('reg.reg', ['result'=>array('error_field'=>'login', 'is_error'=>true,'error'=>array('error_code'=>11,'error_message'=>Lang::get('messages.incorrect_login')),'status'=>'error')]);
  }

  if($email_length < SHORT_EMAIL_LENGTH) {
    return view('reg.reg', ['result'=>array('error_field'=>'email','is_error'=>true,'error'=>array('error_code'=>12,'error_message'=>Lang::get('messages.short_email')),'status'=>'error')]);
  } else if($email_length > LONG_EMAIL_LENGTH) {
    return view('reg.reg', ['result'=>array('error_field'=>'email','is_error'=>true,'error'=>array('error_code'=>13,'error_message'=>Lang::get('messages.long_email')),'status'=>'error')]);
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return view('reg.reg', ['result'=>array('error_field'=>'email','is_error'=>true,'error'=>array('error_code'=>14,'error_message'=>Lang::get('messages.incorrect_email')),'status'=>'error')]);
  }

  if($password_length < SHORT_PASSWORD_LENGTH) {
    return view('reg.reg', ['result'=>array('error_field'=>'password','is_error'=>true,'error'=>array('error_code'=>15,'error_message'=>Lang::get('messages.short_password')),'status'=>'error')]);
  } else if($password_length > LONG_PASSWORD_LENGTH) {
    return view('reg.reg', ['result'=>array('error_field'=>'password','is_error'=>true,'error'=>array('error_code'=>16,'error_message'=>Lang::get('messages.long_password')),'status'=>'error')]);
  }



  $is_email_registered = DB::table('users')->where('email', $email)->get();
  $is_email_registered = json_decode(json_encode($is_email_registered), true);

  if(!empty($is_email_registered['id'])) {
    return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>1,'error_message'=>  Lang::get('messages.user_registered')), 'status'=>'error')]);
  }

  $is_login_registered = DB::table('users')->where('login', $login)->get();
  $is_login_registered = json_decode(json_encode($is_login_registered), true);

  if(!empty($is_login_registered[0]['id'])) {
    return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>2,'error_message'=>Lang::get('messages.login_exist')),'status'=>'error')]);
  }

  $this->crypto = new Crypto;
  $password_hashing = $this->crypto->passwordHashing($password);
  $hashed_password = $password_hashing['hashed_password'];  
  $salt = $password_hashing['salt'];

  $timestamp_registered = time();
  $reg_ip = getIp();
  $user_hash = getRandomHash();
  $lang=getLang();

  $reg_id = DB::table('users')->insertGetId(array(
'id'=>NULL, 
'first_name'=>$first_name, 
'last_name'=>$last_name, 
'email'=>$email, 
'login'=>$login, 
'phone_number'=>'', 
'salt'=>$salt,
'hashed_password'=>$hashed_password, 
'ip_reg'=>$reg_ip, 
'lang'=>$lang, 
'bio'=>'', 
'50_photo'=>'', 
'400_photo'=>'', 
'orig_photo'=>'', 
'is_banned'=>'false', 
'ban_timestamp'=>'', 
'hash'=>$user_hash, 
'burth_timestamp'=>'', 
'sex'=>'', 
'parent_id'=>'-1',
'reg_timestamp'=>$timestamp_registered
  ));
  session(['user_id'=>$reg_id]);
  session(['user_first_name'=>$first_name]);
  session(['user_last_name'=>$last_name]);
  session(['user_login'=>$login]);
  session(['user_email'=>$email]);
  Log::notice($reg_id);
  return redirect('/');
  return view('reg.reg');
}
});





Route::match(['get', 'post'], '/login', function() {
if(empty($_POST['l_submit'])) {
  return view('login.login');
} else {
  $email = makeSafetyString($_POST['l_email']);
  $password = makeSafetyString($_POST['l_password']);

/*
  $first_name = makeSafetyString('uiuiui');
  $last_name = makeSafetyString('sadasd');
  $email = makeSafetyString('remsaisl@mail.ru');
  $login = makeSafetyString('addaddd');
*/
  $email_length = mb_strlen($email);
  $password_length = mb_strlen($password);














  $is_email_registered = DB::table('users')->where('email', $email)->get();
  $is_email_registered = json_decode(json_encode($is_email_registered), true);
  if(!empty($is_email_registered['id'])) {
    return view('login.login', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>17,'error_message'=>  Lang::get('messages.incorrect_login_or_password'))   ,'status'=>'error')]);
  }
  $this->crypto = new Crypto;
  $password_hashing = $this->crypto->passwordHashing($password);
  $hashed_password = $password_hashing['hashed_password'];  
  $salt = $password_hashing['salt'];
  
    if($email_length < SHORT_EMAIL_LENGTH) {
      return view('login.login', ['result'=>array('error_field'=>'email','error_field'=>'email','is_error'=>true,'error'=>array('error_code'=>12,'error_message'=>Lang::get('messages.short_email')),'status'=>'error')]);
    } else if($email_length > LONG_EMAIL_LENGTH) {
      return view('login.login', ['result'=>array('error_field'=>'email','error_field'=>'email','is_error'=>true,'error'=>array('error_code'=>13,'error_message'=>Lang::get('messages.long_email')),'status'=>'error')]);
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return view('login.login', ['result'=>array('error_field'=>'email','error_field'=>'email','is_error'=>true,'error'=>array('error_code'=>121,'error_message'=>Lang::get('messages.incorrect_email')),'status'=>'error')]);
    }




  if($password_length < SHORT_PASSWORD_LENGTH) {
    return view('login.login', ['result'=>array('error_field'=>'password','is_error'=>true,'error'=>array('error_code'=>15,'error_message'=>Lang::get('messages.short_password')),'status'=>'error')]);
  } else if($password_length > LONG_PASSWORD_LENGTH) {
    return view('login.login', ['result'=>array('error_field'=>'password','is_error'=>true,'error'=>array('error_code'=>16,'error_message'=>Lang::get('messages.long_password')),'status'=>'error')]);
  }






  $get_db_0 = DB::table('users')->where('email', $email)->get();
  $get_db_0 =  json_decode(json_encode($get_db_0), true);
  if(empty($get_db_0[0]['id'])) {
    return view('login.login', ['result'=> array('is_error'=>true, 'error'=>array('error_code'=>31, 'error_message'=> trans('messages.incorrect_login_or_password')))] );
  }

  $is_email_registered = DB::table('users')->where('email', $email)->get();
  $is_email_registered = json_decode(json_encode($is_email_registered), true);

  if(empty($is_email_registered[0]['id'])) {
    return view('login.login', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>112,'error_message'=> trans('messages.incorrect_email')),'status'=>'error')]);
  }
   $crypto = new Crypto;


  if($crypto->checkPassword($get_db_0[0]['hashed_password'], $password, $get_db_0[0]['salt'])) {
    session(['user_id'=>$get_db_0[0]['id']]);
    session(['user_first_name'=>$get_db_0[0]['first_name']]);
    session(['user_last_name'=>$get_db_0[0]['last_name']]);
    session(['user_login'=>$get_db_0[0]['login']]);
    session(['user_email'=>$get_db_0[0]['email']]);
    return redirect('/');
  } else {
    return view('login.login', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>32,'error_message'=>trans('messages.incorrect_login_or_password')),'status'=>'error')]);
  } 
  return view('login.login');








}
});























Route::match(['get', 'post'], '/product/create_product', function() {

if(!empty($_POST['product_submit'])) {


DB::table('products')->insert(array(
'id'=>NULL, 
'owner_id'=>7, 
'title'=>$_POST['product_title'], 
'time_created'=>time(), 
'cost'=>$_POST['product_cost'], 
'description'=>$_POST['product_description'], 
'id_deleted'=>'false',
'photo_big'=>'t'
));
}
return view('products.create_product');

});
