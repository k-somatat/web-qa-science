<!DOCTYPE HTML>
<html>
<head>
    <link href="http://127.0.0.1/Project/SCI/Project/dist/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen"
          href="http://127.0.0.1/Project/SCI/Project/dist/css/bootstrap-datetimepicker.min.css">
</head>
<body>
<div id="datetimepicker" class="input-append date">
    <input type="text"/>
      <span class="add-on">
        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
      </span>
</div>
<script type="text/javascript"
        src="http://127.0.0.1/Project/SCI/Project/dist/js/jquery.min.js">
</script>
<script type="text/javascript"
        src="http://127.0.0.1/Project/SCI/Project/dist/js/bootstrap.min.js">
</script>
<script type="text/javascript"
        src="http://127.0.0.1/Project/SCI/Project/dist/js/bootstrap-datetimepicker.min.js">
</script>
<script type="text/javascript"
        src="http://127.0.0.1/Project/SCI/Project/dist/js/bootstrap-datetimepicker.pt-BR.js">
</script>
<script type="text/javascript">
    $('#datetimepicker').datetimepicker({
        format: 'dd/MM/yyyy hh:mm:ss',
        language: 'pt-BR'
    });
</script>
</body>
<html>