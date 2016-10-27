<html>
<head>
  <meta charset="utf-8">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="<?php echo url_base; ?>/inc/jquery.handsontable.full.js"></script>
<script src="<?php echo url_base; ?>/inc/bootstrap.min.js"></script>

<link rel="stylesheet" media="screen" href="<?php echo url_base; ?>/inc/bootstrap.min.css">
<link rel="stylesheet" media="screen" href="<?php echo url_base; ?>/inc/jquery.handsontable.full.css">
<link rel="stylesheet" media="screen" href="<?php echo url_base; ?>/inc/k-style.css">

</head>
<body style="margin:0px;padding:0px;">
<div class="row" style="background-color:#aad8d5;padding:10px;text-align:center;">

<div class="col-md-2" style="font-size:10px;">
<a class="btn btn-primary btn-xs active" href="<?php echo url_base; ?>/top">TOP</a>
現在のステータス：<?php echo $_SESSION['userauth']; ?></div>

<div class="col-md-8"><?php echo TITLE_TAG; ?></div>

<div class="col-md-2">
<a class="btn btn-primary btn-xs active" href="<?php echo url_base; ?>/logout">LogOut</a>
</div>

</div>
<div style="clear:both;height:10px;"></div>
