<?php

// #5 file controler



class FileCon {

	static function LoadList($extension=".json"){
		//ディレクトリーの指定
		$parent_url = HomeUrl . "/api/";


		//ディレクトリー内のファイルを読み込み
		$lists = FileCon::calldirectory($parent_url,$extension);

		return $lists;
	}


	static function calldirectory($parent_url, $extension='.json'){

	// ディレクトリハンドルの取得
	$dir_h = opendir( $parent_url ) ;


	// ファイル・ディレクトリの一覧を $file_list に
	while (false !== ($file_list[] = readdir($dir_h))) ;
	// ディレクトリハンドルを閉じる
	closedir( $dir_h ) ;
	 
	//print_r($file_list);

	//ディレクトリ内のファイル名を１つずつを取得,jsonだけを取得

		foreach ( $file_list as $file_name ){


			$pos = strpos($file_name, $extension);

			if($pos != null){
			$arrays[] = $file_name ;
			}

			//echo "test2";

		}  


	return $arrays;
	}




	static function SaveFile($savename,$filedata,$mode = 1,$extension=".json"){

		//$mode = 1 新規　２上書きＯＫ

		//共通
		$localurls = HomeUrl . "/api/";

		$filename = $localurls.$savename.$extension;


		//新規の場合
		if($mode == 1){
			if (!file_exists($filename)) {
				touch($filename);
			} else {
				//header("location: yetfiles.php");
				exit("新規作成モードです。同じファイル名がすでにあります。上書きできません。");
			}
		}

		//書き込み不能の場合の提示
		if (!file_exists($filename) && !is_writable($filename)
			|| !is_writable(dirname($filename))) {
			//header("location: yetfiles.php");
			exit("書き込み権限がありません");
		}



		$fp = fopen($filename,'w+') or dir('ファイルを開けません');



		fwrite($fp, sprintf($filedata) );


		fclose($fp);

		return "書き込み完了";
	}



	static function SaveRoot($param=1){

		if(isset($_POST['json2'])):

			$savename = $_POST['json2'];
			$js = $_POST['json1'];

			
			exit(FileCon::SaveFile($savename,$js,$param));
		endif;

		if(isset($_POST['text2'])):

			$savename = $_POST['text2'];
			$js = $_POST['text1'];

			
			exit(FileCon::SaveFile($savename,$js,$param,'.txt'));
		endif;


	}






	static function DeleteFile(){

		if(isset($_POST['sakujofile'])):

			$sakujofile = $_POST['sakujofile'];
			unlink(HomeUrl."/api/".$sakujofile.".json");
			exit('削除しました。');
		endif;


		if(isset($_POST['sakujotxtfile'])):

			$sakujofile = $_POST['sakujotxtfile'];
			unlink(HomeUrl."/api/".$sakujofile.".txt");
			exit('削除しました。');
		endif;


	}



	static function CreateFile(){

		if(isset($_POST['newfile'])):

			$newfile = $_POST['newfile'];
			$dummydata = '[[" "," "," "," "]]';

			FileCon::SaveFile( $newfile, $dummydata ,1 );
			exit('ファイル'.$newfile.'を新規作成しました。');
		endif;





		if(isset($_POST['newtxtfile'])):

			$newfile = $_POST['newtxtfile'];
			$dummydata = '<h2>ベーシックテンプレ</h2>

<table>
<tr>
<th>1</th>
<th>2</th>
<th>3</th>
<th>4</th>

</tr>
[loop]
<tr>
<td>[data0]</td>
<td>[data1]</td>
<td>[data2]</td>
<td>[data3]</td>
</tr>
[loop]</table>

<br>
toysking
';

			FileCon::SaveFile( $newfile, $dummydata ,1,".txt" );
			exit('ファイル'.$newfile.'を新規作成しました。');
		endif;



	}


















}

