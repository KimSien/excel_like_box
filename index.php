<?php 
ini_set('display_errors',0);
session_start();
require_once('config.php');




			//autoload
			function autoload_classes( $class_name='undefine') {
				$files = AutoLoadClass.$class_name.'.php';
				if(file_exists($files))
				require_once($files);
			}

			spl_autoload_register( 'autoload_classes');





$params = explode('/', str_replace(BaseFolder, "",$_SERVER["REQUEST_URI"]));



Auth::CheckRoot($params[1]);
Auth::CheckRockfile();


FileCon::SaveRoot(2);


FileCon::DeleteFile();
FileCon::CreateFile();


		include('inc/header.php'); 


		
		$page = 'page/'.$params[1].".php";
			if(file_exists($page)):
				include($page);
			else:
				echo "not page";
			endif;


		include('inc/footer.php');


