
<div class="row" style="padding:0px 20px 10px;">

<div class="btn-group" role="group" aria-label="...">
  <button type="button" class="btn btn-default" onmousedown="saves(this)">保存</button>
  <button type="button" class="btn btn-default" onmousedown="deletes(this)">削除</button>
</div>

  <button type="button" class="btn btn-default" onmousedown="news(this)">新規作成</button>









<select id="select_tenp" name="template_select" class="form-control" style="width:150px;display:inline-block;">
<?php

$lists = FileCon::LoadList('.txt');
foreach ( $lists as $list ){
		
		echo "<option value='" . $list ."'>";
			print $list  ;
		echo "</option>";
}
?>
</select>

<?php
//表示用ＵＲＬ
$openurls = url_base . "/api/json.php?jsontext=" .$_GET['files'] ;
$openurls .= "&temptext=";
?>

<script>
$("#select_tenp").change(function(){
	var selecttxt = $('[name=template_select] option:selected').text();
	selecttxt = '<?php echo $openurls ?>' + selecttxt;
	$(".selectreturn").attr({href:selecttxt});
});
</script>

  <a class="selectreturn" href="<?php echo $openurls.$lists[0] ?>" target="_blank">
  <button type="button" class="btn btn-default">
  テンプレートで表示
  </button>
	</a>

</div>





<div class="row" style="padding:0px 20px;">
<div id="jsondatas" style="width:100%;"></div>
</div>


<style>
table.htCore {
    width: 100%;
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
  dataType: 'json',
  success: function(json){
	

	$("#jsondatas").handsontable({
		  data:json,
		  startRows: 4,
		  startCols: 4,
		  rowHeaders: true,
		  colHeaders: true,
		  minSpareRows: 1,
		  stretchH: 'non',
		  contextMenu: true,
		  contextMenuCopyPaste: {swfPath: "<?php echo url_base ?>api/ZeroClipboard.swf"},
		  colHeaders: ["メーカー名(P・画像URL)", "シリーズ(P・タイトル)", "商品名(P・補足)", "上限価格(P・上限価格)"],

	});

  }
});
</script>



<!-- save関係 -->
<script>
<?php 
$savenames = $_GET['files'];
$savenames = str_replace(".json", "", $savenames);
?>



	function saves(){

var $container = $("#jsondatas");
var handsontable = $container.data('handsontable');


		var predate = handsontable.getData();
		var predate = JSON.stringify(predate);


		var savedata = predate;

		$.ajax({
		   type: "POST",
		   url: "<?php echo url_base; ?>/view/",
		   data: "json2=<?php echo $savenames ?>" + "&" + "json1=" + savedata,
		    dataType: 'json'
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
$deletenames = str_replace(".json", "", $savenames);
?>



	function deletes(){

 	  var res = confirm("削除していいですか？");
      // 選択結果で分岐
      if( res == true ) {

		$.ajax({
		   type: "POST",
		   url: "<?php echo url_base; ?>/view/",
		   data: "sakujofile=<?php echo $deletenames ?>",
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