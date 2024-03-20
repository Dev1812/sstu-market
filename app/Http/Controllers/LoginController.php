<?php 
namespace App\Http\Controllers;
use DB;
use Crypto;
use Lang;
class LoginController extends Controller {

  public function ajaxLogin() {

    if(isUserAuth()) {
     return redirect('/');
    }
    
    $reg_email = htmlentities(htmlspecialchars($_GET['email']));
    $reg_password = htmlentities(htmlspecialchars($_GET['password']));
    $row1 = DB::table('users')->where('email', $reg_email)->get();
    $row1 =  json_decode(json_encode($row1), true);
    if(empty($row1[0]['id'])) {
      return json_encode(array('is_error'=>true, 'error'=>array('error_code'=>311, 'error_message'=> trans('messages.email_not_exist'))) );
    }

   $crypto = new Crypto;


  if($crypto->checkPassword($row1[0]['hashed_password'], $reg_password, $row1[0]['salt'])) {
    session(['user_id'=>$row1[0]['id']]);
    session(['user_first_name'=>$row1[0]['first_name']]);
    session(['user_last_name'=>$row1[0]['last_name']]);
    session(['user_login'=>$row1[0]['login']]);    
    session(['user_email'=>$row1[0]['email']]);
    return json_encode(array('is_error'=>false, 'redirect_url'=> '/'));
    return false;
  } else {
    return json_encode(array('is_error'=>true, 'error'=>array('error_code'=>313, 'error_message'=> trans('messages.incorrect_login_or_password')))); 



}
}

  public function index(){
    if(isUserAuth()) {
     return redirect('/');
    }
if(empty($_GET['login_submit'])) {
  
  return view('login.login');

    

}
  $login_email = $_GET['login_email'];
  $login_password = $_GET['login_password'];
  $login_email_length = mb_strlen($login_email);
  $login_password_length = mb_strlen($login_password);
  $is_email_registered = DB::table('users')->where('email', $login_email)->get();
  $is_email_registered = json_decode(json_encode($is_email_registered), true);
  if(!empty($is_email_registered['id'])) {
    return view('login.login', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>111,'error_message'=>  Lang::get('messages.incorrect_login_or_password'))   ,'status'=>'error')]);
  }
  $this->crypto = new Crypto;
  $password_hashing = $this->crypto->passwordHashing($login_password);
  $hashed_password = $password_hashing['hashed_password'];  
  $salt = $password_hashing['salt'];

  
    if($login_email_length < 3) {
      return view('login.login', ['result'=>array('error_field'=>'email','error_field'=>'email','is_error'=>true,'error'=>array('error_code'=>119,'error_message'=>Lang::get('messages.short_email')),'status'=>'error')]);
    } else if($login_email_length > 70) {
      return view('login.login', ['result'=>array('error_field'=>'email','error_field'=>'email','is_error'=>true,'error'=>array('error_code'=>120,'error_message'=>Lang::get('messages.long_email')),'status'=>'error')]);
    } else if(!filter_var($login_email, FILTER_VALIDATE_EMAIL)) {
      return view('login.login', ['result'=>array('error_field'=>'email','error_field'=>'email','is_error'=>true,'error'=>array('error_code'=>121,'error_message'=>Lang::get('messages.incorrect_email')),'status'=>'error')]);
    }
/*
    if($login_password_length < 3) {
      return view('login.login', ['result'=>array('error_field'=>'password','is_error'=>true,'error'=>array('error_code'=>122,'error_message'=>Lang::get('messages.short_password')),'status'=>'error')]);
    } else if($login_password_length > 70) {
      return view('login.login', ['result'=>array('error_field'=>'password','is_error'=>true,'error'=>array('error_code'=>123,'error_message'=>Lang::get('messages.long_password')),'status'=>'error')]);
    } else if(!preg_match("/^[a-zA-Zа-яА-Я0-9+_@.-]*$/u",$reg_login)) {
      return view('reg.reg', ['result'=>array('error_field'=>'login', 'is_error'=>true,'error'=>array('error_code'=>114,'error_message'=>Lang::get('messages.incorrect_login')),'status'=>'error')]);
    }*///^
  $row1 = DB::table('users')->where('email', $login_email)->get();
  $row1 =  json_decode(json_encode($row1), true);
  if(empty($row1[0]['id'])) {
    return view('login.login', ['result'=> array('is_error'=>true, 'error'=>array('error_code'=>31, 'error_message'=> trans('messages.incorrect_login_or_password')))] );
  }

  $is_email_registered = DB::table('users')->where('email', $login_email)->get();
  $is_email_registered = json_decode(json_encode($is_email_registered), true);

  if(empty($is_email_registered[0]['id'])) {
    return view('login.login', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>112,'error_message'=> trans('messages.incorrect_email')),'status'=>'error')]);
  }
   $crypto = new Crypto;


  if($crypto->checkPassword($row1[0]['hashed_password'], $login_password, $row1[0]['salt'])) {
    session(['user_id'=>$row1[0]['id']]);
    session(['user_first_name'=>$row1[0]['first_name']]);
    session(['user_last_name'=>$row1[0]['last_name']]);
    session(['user_login'=>$row1[0]['login']]);
    session(['user_email'=>$row1[0]['email']]);
    return redirect('/');
  } else {
    return view('login.login', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>32,'error_message'=>trans('messages.incorrect_login_or_password')),'status'=>'error')]);
  } 
  return view('login.login');

    


































}}
