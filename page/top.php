<div class="row">

<div class="col-md-12" style="text-align: center;"> 
<h2>データ編集</h2>
</div>

<div class="col-md-2"> 
</div>

<div class="col-md-2"> 
 <button type="button" class="btn btn-default" onmousedown="news(this)">データ新規作成</button>
</div>

<div class="col-md-6">


<?php

$lists = FileCon::LoadList('.json');

foreach ( $lists as $list ){
		$file_name_r = $list;

		echo "<a href='" . url_base . "/view/?files=";
			print $file_name_r  ;
		echo "'>".$file_name_r."</a><br>\n";

}

?>
</div>

<div class="col-md-2"></div>
</div>



<hr>

<hr>



<div class="row">
<div class="col-md-12" style="text-align: center;"> 
<h2>テンプレート編集</h2>
</div>

<div class="col-md-2"></div>

<div class="col-md-2">
	  <button type="button" class="btn btn-default" onmousedown="news(this)">テンプレ新規作成</button>
</div>

<div class="col-md-6">

<?php

$lists = FileCon::LoadList('.txt');

foreach ( $lists as $list ){
		$file_name_r = $list;

		echo "<a href='" . url_base . "/view_tenp/?files=";
			print $file_name_r  ;
		echo "'>".$file_name_r."</a><br>\n";

}

?>
</div>

<div class="col-md-2"></div>
</div>




<!-- new -->
<script>
<?php 
$deletenames = $_GET['files'];
$deletenames = str_replace(".json", "", $savenames);
?>


	function news(){

	    var name=prompt("作成ファイル名", "hoge");
	    if(name==null){
	        /* [キャンセル]ボタンが押下された場合 */

	    }else if(name==""){
			alert("ファイル名を入力してください");

	    }else{

			$.ajax({
			   type: "POST",
			   url: "<?php echo url_base; ?>/view/",
			   data: "newfile="+name,
			    dataType: 'json'
			 }).success(function(data){
			    alert('success!!');
			}).error(function(data){
			    alert(data.responseText);
				location.href="<?php echo url_base; ?>/view/?files="+name+".json";
			});


	    }
	    



		//window.location.reload();
	}
</script>



<!-- new -->
<script>
<?php 
$deletenames = $_GET['files'];
$deletenames = str_replace(".txt", "", $savenames)
?>


	function news(){

	    var name=prompt("作成テンプレート名", "hoge");
	    if(name==null){
	        /* [キャンセル]ボタンが押下された場合 */

	    }else if(name==""){
			alert("ファイル名を入力してください");

	    }else{

			$.ajax({
			   type: "POST",
			   url: "<?php echo url_base; ?>/view_tenp/",
			   data: "newtxtfile="+name,
			    dataType: 'json'
			 }).success(function(data){
			    alert('success!!');
			}).error(function(data){
			    alert(data.responseText);
				location.href="<?php echo url_base; ?>/view_tenp/?files="+name+".txt";
			});


	    }
	    



		//window.location.reload();
	}
</script>