
<div class="row" style="padding:0px 20px 10px;">

	<div class="btn-group" role="group" aria-label="...">
	  <button type="button" class="btn btn-default" onmousedown="saves(this)">保存</button>
	  <button type="button" class="btn btn-default" onmousedown="deletes(this)">削除</button>
	</div>

  <button type="button" class="btn btn-default" onmousedown="news(this)">新規作成</button>


</div>

<div class="row" style="padding:0px 150px;">


<p>テンプレート編集<br>
<textarea id="tenpdata" type="text" name="tenpdata">
</textarea></p>





</div>


<style>
textarea{
	width:100%;
	height:300px;
}
</style>


<!-- load関係 -->
<script>
<?php 
$jsonurl = url_base .'/api/'.$_GET['files'];
?>

$.ajax({
  type: 'GET',
  url: <?php echo "'".$jsonurl."'" ?>,
  dataType: 'text',
  success: function(txtdata){

  	//txtdata = unescape(txtdata);

	$("#tenpdata").val(txtdata);
 }
});
</script>



<!-- save関係 -->
<script>
<?php 
$savenames = $_GET['files'];
$savenames = str_replace(".txt", "", $savenames)
?>



	function saves(){

		var predate = $("#tenpdata").val();

		var savedata = predate;

		//var savedata = escape(predate);
		    //console.log(savedata);


		$.ajax({
		   type: "POST",
		   url: "<?php echo url_base; ?>/view_tenp/",
		   data: "text2=<?php echo $savenames ?>" + "&" + "text1=" + savedata,
		    dataType: 'text'
		 }).success(function(data){
		    alert('success!!');
		}).error(function(data){
		    alert(data.responseText);
		    console.log(data);
		});

		//window.location.reload();
	}
</script>









<!-- delete -->
<script>
<?php 
$deletenames = $_GET['files'];
$deletenames = str_replace(".json", "", $savenames)
?>



	function deletes(){

 	  var res = confirm("削除していいですか？");
      // 選択結果で分岐
      if( res == true ) {

		$.ajax({
		   type: "POST",
		   url: "<?php echo url_base; ?>/view_tenp/",
		   data: "sakujotxtfile=<?php echo $deletenames ?>",
		    dataType: 'json'
		 }).success(function(data){
		    alert('success!!');
		}).error(function(data){
		    alert(data.responseText);
			location.href="<?php echo url_base; ?>/top/";

		});

      }
      else {
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