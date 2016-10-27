<meta charset="utf-8">
<?php

//エラーチェック
$ck = 0;


//テンプレートの設定
if(isset($_GET['temptext'])){
	if(file_exists($_GET['temptext'])){
	$base_template =  file_get_contents($_GET['temptext']);
	}else{
	$ck = 1;
	}

}else{
//テンプレ分解
$base_template="<h2>テストテンプレート</h2><table>[loop]<tr><td>[data0]</td><td>[data1]</td><td>[data2]</td><td>[data3]</td></tr>[loop]</table>";
}


//jsonの取得
if(isset($_GET['jsontext'])){
	if(file_exists($_GET['jsontext'])){
		$datas = json_decode(file_get_contents($_GET['jsontext']), true);
		$stop = count($datas)-1; //json仕様で空白入る分を削除

	}else{
		$ck = 1;
	}
}




//表示
if(	$ck == 0):

	$temp=explode("[loop]", $base_template);

	$head = $temp[0];
	$roop = $temp[1];
	$foot = $temp[2];



	echo $head;


	foreach ($datas as $data) {

		if($y < $stop){
			$tempo_roop = $roop;

			for($i = 0; $i < count($data) ;$i++){

				$tempo_roop = str_replace('[data'.$i.']', $data[$i], $tempo_roop);

			}
			

			echo $tempo_roop;
		}
		$y++;

	}

	echo $foot;

else:

	echo "error";

endif;
