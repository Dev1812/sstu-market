<?php 
namespace App\Http\Controllers;
use DB;
use Crypto;
use Lang;
use Log;
class QuestionController extends Controller {
//!TODO is i nor reg

public function getQuestion($question_id) {


    $questions = DB::table('questions')->where('is_deleted','!=', 'true' )->where('id', $question_id)->get();
    $questions = json_decode(json_encode($questions), true);
foreach($questions as $v) { 


          $owner_info = DB::table('users')->where('id', $v['owner_id'])->get();
          $owner_info = json_decode(json_encode($owner_info), true);

$row1['owner_info']=$owner_info;


        $row1['date_created'] = parseTimestamp($v['time_created']);
        $row1['data'] = $v;
        $result[]=$row1;
}
  return view('/question.get_question', ['questions'=>$result]);
 // return view('/question.get_question', ['is_success_submiteed'=>'']);
}



public function replyToQuestion($question_id) {



$is_success_submiteed = 'false';
    if(!empty($_POST['create_quesion_submit'])) {
      //SELECT `id`, `owner_id`, `text`, `time_created`, `is_deleted`, `question_id` FROM `comments` WHERE 1
    $q = DB::table('comments')->insertGetId(array(
  'id'=>NULL,
  'owner_id'=>'21',
  'text'=>$_POST['create_quesion_text'],
  'time_created'=>time(),
  'is_deleted'=>'false',
  'question_id'=>'1'
  ));
    //session(['user_id'=>$q]);
$is_success_submiteed = 'true';
    }
  return view('/question.reply_to_question', ['is_success_submiteed'=>'']);
}



  public function getQuestions() {
    $questions = DB::table('questions')->where('is_deleted','!=', 'true' )->orderBy('id', 'DESC')->get();
    $questions = json_decode(json_encode($questions), true);
foreach($questions as $v) { 


          $owner_info = DB::table('users')->where('id', $v['owner_id'])->get();
          $owner_info = json_decode(json_encode($owner_info), true);

$row1['owner_info']=$owner_info;


        $row1['date_created'] = parseTimestamp($v['time_created']);
        $row1['data'] = $v;
        $result[]=$row1;
}
  return view('/feed.feed', ['questions'=>$result]);

  }
  public function createQuetion() {


$is_success_submiteed = 'false';
    if(!empty($_POST['create_quesion_submit'])) {
      //SELECT `id`, `owner_id`, `title`, `text`, `time_created`, `is_deleted` FROM `questions` WHERE 1
    $q = DB::table('questions')->insertGetId(array('id'=>NULL,
  'owner_id'=>'21',
  'title'=>$_POST['create_quesion_title'],
  'text'=>$_POST['create_quesion_text'],
  'time_created'=>time(),
  'is_deleted'=>'false'
  ));
    //session(['user_id'=>$q]);
$is_success_submiteed = 'true';
    }
    return view('question.create_question', ['is_success_submiteed'=>$is_success_submiteed]);
  }

  public function index() {

    if(isUserAuth()) {
     return redirect('/');
    }

    if(empty($_POST['reg_submit'])) {
     return view('reg.reg');
    }

    if(!empty($_POST['reg_submit'])) {

    $reg_first_name = htmlentities(htmlspecialchars($_POST['reg_first_name']));
    $reg_last_name = htmlentities(htmlspecialchars($_POST['reg_last_name']));
    $reg_login = htmlentities(htmlspecialchars($_POST['reg_login']));
    $reg_email = htmlentities(htmlspecialchars($_POST['reg_email']));
    $reg_password = htmlentities(htmlspecialchars($_POST['reg_password']));

    $reg_first_name_length = mb_strlen($reg_first_name);
    $reg_last_name_length = mb_strlen($reg_last_name);
    $reg_login_length = mb_strlen($reg_login);
    $reg_email_length = mb_strlen($reg_email);
    $reg_password_length = mb_strlen($reg_password);
      
    $is_email_registered = DB::table('users')->where('email', $reg_email)->get();
    $is_email_registered = json_decode(json_encode($is_email_registered), true);


    if(!empty($is_email_registered['id'])) {
      return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>111,'error_message'=>  Lang::get('messages.welcome'))   ,'status'=>'error')]);
    }
    
    $is_email_registered = DB::table('users')->where('email', $reg_email)->get();
    $is_email_registered = json_decode(json_encode($is_email_registered), true);


    if(!empty($is_email_registered[0]['id'])) {
      return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>112,'error_message'=> Lang::get('messages.email_exist')),'status'=>'error')]);
    }



    $is_login_registered = DB::table('users')->where('login', $reg_login)->get();
    $is_login_registered = json_decode(json_encode($is_login_registered), true);



    if(!empty($is_login_registered[0]['id'])) {
      return view('reg.reg', ['result'=>array('is_error'=>true,'error'=>array('error_code'=>112,'error_message'=> Lang::get('messages.login_exist')),'status'=>'error')]);
    }



    $this->crypto = new Crypto;
    $password_hashing = $this->crypto->passwordHashing($reg_password);
    $hashed_password = $password_hashing['hashed_password'];  
    $salt = $password_hashing['salt'];

    if($reg_first_name_length < 3) {
      return view('reg.reg', ['result'=>array('error_field'=>'first_name', 'is_error'=>true,'error'=>array('error_code'=>113,'error_message'=>Lang::get('messages.short_firstname')),'status'=>'error')]);
    } else if($reg_first_name_length > 70) {
      return view('reg.reg', ['result'=>array('error_field'=>'first_name', 'is_error'=>true,'error'=>array('error_code'=>114,'error_message'=>Lang::get('messages.long_firstname')),'status'=>'error')]);
    } else if(preg_match("/[^a-zA-Zа-яА-Я]/u",$reg_first_name)) {
      return view('reg.reg', ['result'=>array('error_field'=>'first_name', 'is_error'=>true,'error'=>array('error_code'=>114,'error_message'=>Lang::get('messages.incorrect_first_name')),'status'=>'error')]);
    }


    if($reg_last_name_length < 3) {
      return view('reg.reg', ['result'=>array('error_field'=>'last_name','is_error'=>true,'error'=>array('error_code'=>115,'error_message'=>Lang::get('messages.short_lastname')),'status'=>'error')]);
    } else if($reg_last_name_length > 70) {
      return view('reg.reg', ['result'=>array('error_field'=>'last_name','is_error'=>true,'error'=>array('error_code'=>116,'error_message'=>Lang::get('messages.long_lastname')),'status'=>'error')]);
    } else if(preg_match("/[^a-zA-Zа-яА-Я]/u",$reg_last_name)) {
      return view('reg.reg', ['result'=>array('error_field'=>'last_name', 'is_error'=>true,'error'=>array('error_code'=>114,'error_message'=>Lang::get('messages.incorrect_last_name')),'status'=>'error')]);
    }


    if($reg_login_length < 3) {
      return view('reg.reg', ['result'=>array('error_field'=>'login','is_error'=>true,'error'=>array('error_code'=>117,'error_message'=>Lang::get('messages.short_login')),'status'=>'error')]);
    } else if($reg_login_length > 70) {
      return view('reg.reg', ['result'=>array('error_field'=>'login','is_error'=>true,'error'=>array('error_code'=>118,'error_message'=>Lang::get('messages.long_login')),'status'=>'error')]);
    } else if(!preg_match("/^[a-zA-Zа-яА-Я0-9+_@.-]*$/u",$reg_login)) {
      return view('reg.reg', ['result'=>array('error_field'=>'login', 'is_error'=>true,'error'=>array('error_code'=>114,'error_message'=>Lang::get('messages.incorrect_login')),'status'=>'error')]);
    }//^[a-zA-Zа-яА-Я0-9+_@.-]*$

    if($reg_email_length < 3) {
      return view('reg.reg', ['result'=>array('error_field'=>'email','is_error'=>true,'error'=>array('error_code'=>119,'error_message'=>Lang::get('messages.short_email')),'status'=>'error')]);
    } else if($reg_email_length > 70) {
      return view('reg.reg', ['result'=>array('error_field'=>'email','is_error'=>true,'error'=>array('error_code'=>120,'error_message'=>Lang::get('messages.long_email')),'status'=>'error')]);
    } else if(!filter_var($reg_email, FILTER_VALIDATE_EMAIL)) {
      return view('reg.reg', ['result'=>array('error_field'=>'email','is_error'=>true,'error'=>array('error_code'=>121,'error_message'=>Lang::get('messages.incorrect_email')),'status'=>'error')]);
    }

    if($reg_password_length < 3) {
      return view('reg.reg', ['result'=>array('error_field'=>'password','is_error'=>true,'error'=>array('error_code'=>122,'error_message'=>Lang::get('messages.short_password')),'status'=>'error')]);
    } else if($reg_password_length > 70) {
      return view('reg.reg', ['result'=>array('error_field'=>'password','is_error'=>true,'error'=>array('error_code'=>123,'error_message'=>Lang::get('messages.long_password')),'status'=>'error')]);
    }
    $timestamp_registered = time();
    $reg_ip = $_SERVER['REMOTE_ADDR'];
    $reg_time = time();
    $user_hash = md5(time());

    $q = DB::table('users')->insertGetId(array('id'=>NULL,
  'first_name'=>$reg_first_name,
  'last_name'=>$reg_last_name,
  'login'=>$reg_login,
  'email'=>$reg_email,
  'hashed_password'=>$hashed_password,
  'salt'=>$salt,
  'reg_ip'=>$reg_ip,
  'time_reg'=>$reg_time,
  'big_photo'=>'',
  'small_photo'=>'',
  'bio'=>'',
  'hash'=>$user_hash)
  );
    session(['user_id'=>$q]);
    session(['user_first_name'=>$reg_first_name]);
    session(['user_last_name'=>$reg_last_name]);
    session(['user_login'=>$reg_login]);
    session(['user_email'=>$reg_email]);
    Log::notice($q);
    
    return redirect('/photo');

}


  }

}