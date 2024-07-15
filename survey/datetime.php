<html>  
<head>  
<title>Bootstrap date and time</title>  
<script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
<script src ="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>  
<script src ="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>  
<script src ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>  
<script>  
$(function() {  
  $('#datetimepicker1').datetimepicker();  
});  
</script>  
<link rel ="stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
<link rel ="stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">  
<style>  
    .container {  
        margin-top: 5px;  
        margin-left: 10px;  
        width: 600px;  
    }  
</style>  
</head>  
<body>  
</br>  
<div class ="container">  
  <div class ="row">  
    <div class ='col-sm-6'>  
      <div class ="form-group">  
        <div class ='input-group date' id='datetimepicker1'>  
          <input type ='text' class="form-control" />  
          <span class ="input-group-addon">  
            <span class ="glyphicon glyphicon-calendar"></span>  
          </span>  
        </div>  
      </div>  
    </div>  
  </div>  
</div>  
</body>  
</html>  
