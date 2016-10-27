<?php



//class
class Auth{

	static function StartUp(){

			if (isset($_SESSION['userauth'])) {
			//echo $_SESSION['userauth'];

			} else {
			$_SESSION['userauth'] = "gest";
			//echo $_SESSION['userauth'];
			}


	}



	static function CheckAuth(){
			if (isset($_SESSION['userauth'])) {

				if($_SESSION['userauth'] == "login"){
					return true;
				}else{
					//echo "else";
					//header('Location: '.url_base.'/login/');
					return false;
				}
			}
	}











	static function CheckRockfile(){

		$rocklist= array('test','temp');

		if(isset($_POST['sakujofile'])):
			foreach ($rocklist as $value) {
				if($_POST['sakujofile'] == $value){
				exit('ファイルはロックされてます。削除できません。');
				}
			}
		endif;

		if(isset($_POST['sakujotxtfile'])):
			foreach ($rocklist as $value) {
				if($_POST['sakujotxtfile'] == $value){
				exit('ファイルはロックされてます。削除できません。');
				}
			}
		endif;

	}









	static function CheckRoot($param){



			Auth::StartUp();



			if($param=="logout"){
				$_SESSION['userauth']="gest";
				session_unset();
				session_destroy();
				//echo "logout";
				header('Location: '.url_base.'/login/');
				//return false;

			}elseif($param=="login"){

				if(Auth::CheckPASS()){
					header('Location: '.url_base.'/top/');
					//return true;
				}else{
				return true;
				}

			}else{
				//echo "else";
	
				if(Auth::CheckAuth()){
				return true;
				}else{
				header('Location: '.url_base.'/login/');
				}
	
			}


	}


	static function CheckPASS(){
			$name = $_POST['name'];
			$pass = $_POST['pass'];

			if($name == LoginID){
				if($pass==LoginPASS){
					$_SESSION['userauth']="login";
					return true;
				}
			}

			$_SESSION['userauth']="gest";
			//echo $_SESSION['userauth'];
			return false;
	}




}
