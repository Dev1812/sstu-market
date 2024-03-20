<?php
namespace App\Http\Controllers;
use DB;

use Crypto;
use App\Http\Controllers\Controller;
use Session;

class RestoreController extends Controller{
  public function restore() {
  if(isUserAuth()) {
    return redirect('/');
  }
  if(!empty($_GET['restore_submit'])) {


    $email = htmlentities(htmlspecialchars($_GET['restore_email']));

    $email_length = mb_strlen($email);

    if($email_length < 3) {
      return view('restore.restore', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>9,'error_message'=>trans('messages.short_email')),'status'=>'error')]);
    } else if($email_length > 70) {
      return view('restore.restore', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>10,'error_message'=>trans('messages.long_email')),'status'=>'error')]);
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return view('restore.restore', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>11,'error_message'=>trans('messages.incorrect_email')),'status'=>'error')]);
    }

$is_email_having = DB::table('users')->where('email', $email)->get();

$is_email_having = json_decode(json_encode($is_email_having), true);

if(empty($is_email_having[0]['id'])) {

      return view('restore.restore', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>11,'error_message'=>trans('messages.email_not_exist')),'status'=>'error')]);
}

  $hash = getRandomHash();  

  $email = $_GET['restore_email'];
 mail($email ,"Восстановление пароля", RESTORE_URL.$hash); 

DB::table('restore')->where('email', $email)->delete();
DB::table('restore')->insert(array(
'id'=>NULL, 
'owner_id'=>0, 
'email'=>$email, 
'token'=>$hash, 
'time_created'=>time(), 
'owner_ip'=>$_SERVER['REMOTE_ADDR']

));
  return view('restore.restore', ['result'=>array('is_error'=>false, 'status'=>'success', 'message'=>trans('messages.restore_success_send_mail'))]);
}
  return view('restore.restore');
  }



  public function make() {
$get = DB::table('restore')->where('token', $_GET['token'])->get();
$get = json_decode(json_encode($get), true);
if(empty($get[0]['email'])) {

return redirect('/restore');
}
session(['restore_email'=> $get[0]['email']]);

  return redirect('/restore/change');
}
public function change(){
     /* return view('restore.show_form_change_password', ['result'=>array('error_field'=>'email','error_field'=>'email','is_error'=>true,'error'=>array('error_code'=>119,'error_message'=>array('title'=>'messages', 'description'=>'test')),'status'=>'error')]);*/
if(!empty(session('restore_email'))) {
  //return redirect('/login?u');
}

  if(!empty($_GET['restore_submit'])) {
    $email = $_GET['restore_email'];




    $restore_email_length = mb_strlen($email);
    
    if($restore_email_length < 3) {
      return view('restore.show_form_change_password', ['result'=>array('error_field'=>'first_name', 'is_error'=>true,'error'=>array('error_code'=>113,'error_message'=>'messages.short_firstname'),'status'=>'error')]);
    } else if($restore_email_length > 70) {
      return view('restore.show_form_change_password', ['result'=>array('error_field'=>'first_name', 'is_error'=>true,'error'=>array('error_code'=>114,'error_message'=>'messages.long_firstname'),'status'=>'error')]);
    }





    $email_length = mb_strlen($email);
    $this->crypto = new Crypto;
    $password_hashing = $this->crypto->passwordHashing($email);
    $hashed_password = $password_hashing['hashed_password'];  
    $salt = $password_hashing['salt'];

$s = DB::table('users')->where('email', session('restore_email'))->get();
$s = json_decode(json_encode($s), true);
  DB::table('users')->where('email', session('restore_email'))->update(['hashed_password'=>$hashed_password, 'salt'=>$salt]);
    DB::table('restore')->where('email', session('restore_email'))->delete();
    Session::flush();
    if(empty($s[0]['id'])) {


      return view('restore.show_form_change_password', ['result'=>array('error_field'=>'email','error_field'=>'email','is_error'=>true,'error'=>array('error_code'=>119,'error_message'=>array('title'=>'Неизвестная ошибка', 'description'=>'Неизвестная ошибка')),'status'=>'error')]);





    //  return view('restore.show_form_change_password');
    }
    var_dump('l');
    session(['user_first_name'=>$s[0]['first_name']]);
    session(['user_last_name'=>$s[0]['last_name']]);
    session(['user_id'=>$s[0]['id']]);
    session(['user_login'=>$s[0]['login']]);
    session(['user_small_photo'=>$s[0]['small_photo']]);
    session(['user_big_photo'=>$s[0]['big_photo']]);

    return redirect('/');
}
return view('restore.show_form_change_password');
}
}   