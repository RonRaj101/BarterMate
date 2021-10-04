<?php 
include('DBCONNECT.php');

$msg_from = $_GET['|'];
$msg_to = $_GET['/'];
$u_id = $msg_from;


$getrecieverinfosql = "SELECT U_NAME FROM users WHERE U_ID = '$msg_to'";
$getrecieverinfo = mysqli_query($connectionString,$getrecieverinfosql);
$getrecieverinfo_arr = mysqli_fetch_array($getrecieverinfo);
$msg_to_name = $getrecieverinfo_arr['U_NAME'];


  
    $getallmessagessql = "SELECT * FROM messages WHERE M_TO = '$msg_to' OR M_TO = '$u_id' AND M_FROM = '$msg_to' OR M_FROM = '$u_id'";
    $getallmessages = mysqli_query($connectionString,$getallmessagessql);
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Message Box</title>
	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
	

    <div id="msg_box" style="max-width: 50rem; margin: 0 auto; ">
    	 <div id="message-box">
              <div id="top-bar" class="row">
                <span class="col">To <h4 id="u_name"><?php echo $msg_to_name?></h4></span>
                <span class="col"><i class="bi bi-star" style="float: right;"></i></span>
              </div>
              <div id="message-bar" class="row" style="overflow-y: scroll; min-height: 50vh; align-content: flex-end;">
                
                <?php 
                while($m_row = mysqli_fetch_assoc($getallmessages)){
                if($m_row['M_TO'] == $msg_to){
                	$color = 'primary';
                	$float = 'right';
                }
                else if($m_row['M_TO'] == $u_id){
                	$color = 'secondary';
                	$float = 'left';
                }
                ?>

                <div class="mb-3" style="max-height: 2rem; line-height: 1rem;">
                <span class="text-dark bg-<?php echo $color?>" style="float: <?php echo $float?>; padding: 0.5rem;"><?php echo $m_row['M_CONTENT']?></span>
                </div>

                <?php
                }
                ?>
                

              </div>
              <div id="message-type" class="row">
                <div class="col">
                <input type="text" value="" class="form-control" placeholder="Enter Your Message" id="msg_content">
                </div>
                <div class="col-2">
                <button id="send_msg" class="btn btn-success"><i class="bi bi-telegram"></i></button>
               
                </div>
              </div>
            </div>
    </div>


    <script>
    	window.onload = function () {
	     var objDiv = document.getElementById("message-bar");
	     objDiv.scrollTop = objDiv.scrollHeight;
      }
    </script>

    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        
        function send_msg(){

        var request_messages = new XMLHttpRequest();

        var msg_content = document.getElementById("msg_content").value;

        var to_id = <?php echo $msg_to?>;
        var from_id = <?php echo $u_id?>;

        

        request_messages.onreadystatechange = function(){
          if (this.status == 200 && this.readyState == 4) {
              //refresh chat box
              var refresh_messages = new XMLHttpRequest();

              refresh_messages.onreadystatechange = function() {
                if (this.status == 200 && this.readyState == 4) {

                  messages_data = json.parse(this.responseText);

                  

                }
               }

              refresh_messages.open('GET','refresh_messages.php?from='+from_id+'&to='+to_id,true);
              refresh_messages.send();
          }
        }

        request_messages.open('POST','send_message.php?msg='+msg_content+'&from='+from_id+'&to='+to_id,true);
        request_messages.send();
        }

        document.getElementById('send_msg').addEventListener("click", send_msg);


      
    </script>
</body>
</html>
