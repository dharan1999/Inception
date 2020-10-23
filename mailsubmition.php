<?php
include ("includes/header.php");
require 'PHPMailerAutoload.php';

  $user_Id = $user['id'] ;

  if(isset($_POST["submit"])){


    $fname= $_FILES['upload']['name'];
    $tmp_name= $_FILES['upload']['tmp_name'];
    $position= strpos($fname, "."); 
    $fileextension= substr($fname, $position + 1);
    $fileextension= strtolower($fileextension);
    $size        = $_FILES['upload']['size'];  // get size of the file for size validation 
    $file_type        = $_FILES['upload']['type'];  // get type of the file 

    if (isset($fname)) {

        $path= 'C:/xampp/htdocs/final5/applicationDocuments/';

        if (!empty($fname)){
            if (move_uploaded_file($tmp_name, $path.$fname)) {

              $investor_username = $_POST['investors'];
              $title = $_POST["title"];
          
              $user_name_query = mysqli_query($con, "select first_name from users where id = '$user_Id'");
              while($res = mysqli_fetch_array($user_name_query)){
                   $user_name = $res['first_name'];
              }
              $user_EmailId_query = mysqli_query($con, "select email from users where id = '$user_Id'");
              while($res = mysqli_fetch_array($user_EmailId_query)){
                   $user_EmailId = $res['email'];
              }

              $investor_Id_query = mysqli_query($con, "select id from users where username = '$investor_username'");
              
              while($res = mysqli_fetch_array($investor_Id_query)){
                   $investor_Id = $res['id'];
              }

              $investor_name_query = mysqli_query($con, "select first_name from users where username = '$investor_username'");
              $investor_name= '';
              while($res = mysqli_fetch_array($investor_name_query)){
                   $investor_name = $res['first_name'];
              }

              $investor_EmailId_query = mysqli_query($con, "select email from users where username = '$investor_username'");
              while($res = mysqli_fetch_array($investor_EmailId_query)){
                   $investor_EmailId = $res['email'];
              }

       
            $query = mysqli_query($con, "INSERT INTO `idea_application` ( `application_title`, `application_document`, `user_id`, `investor_id`) values('$title','$fname','$user_Id','$investor_Id')");

              $mail = new PHPMailer;
            //  $mail->SMTPDebug = 3; 
              $mail->isSMTP();
              $mail->Host = "smtp.gmail.com";  
              $mail->SMTPAuth = true;
              $mail->Username = "in.our.inception@gmail.com";   
              $mail->Password = "inception135";
              $mail->Port = 587; 
              $mail->setFrom("in.our.inception@gmail.com",  "Inception" );
              $mail->addReplyTo($user_EmailId,$user_name);
              $mail->addCC($user_EmailId,$user_name);
             
              $mail->addAttachment( "applicationDocuments/".$fname);
              $mail->addAddress($investor_EmailId, $investor_name);
              $mail->isHTML(true);
              $mail->Subject = "Application of Idea";
              $mail->Body = "<i>Dear $investor_name,<br> Below is application of Idea of $user_name.<br>Thank You, <br>Inception</i>";
              
              $mail->send();
               
         }
        }   
    }
  }


    

    $query = mysqli_query($con, "select friend_array from users where id ='$user_Id'" );

    $arrayList = '';
                  
    while($res = mysqli_fetch_array($query)){
           $arrayList = $res['friend_array'];
      }
                                     

     $proresult = mysqli_query($con,"call SpliteFriends('$arrayList')");

     $inv = mysqli_query($con,"SELECT * FROM `store`");

     $investorList = array();

     while($res = mysqli_fetch_array($inv)){
        if($res['allValues'] != '')
           array_push($investorList,$res['allValues']);
      }

      mysqli_query($con,"TRUNCATE TABLE  `store`"); 
?>

  <html>
<head>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
  <style>

    .container{
      /*display: block;
      text-align: center;*/
      
      width: 700px;
     }
     .investor-form{
      margin-top: 20px;
      border-style: solid;
     }
     #show{
      display: none;
     }
     #show1{
      display:block;
      text-align:center;
      color: green;
     }
      #show2{
      display:block;
      text-align:center;
      color: black;
     }
  </style>
 <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->

</head>
<body>

    <div class="container">
      <h2 style="display:block;text-align:center;color: black;"> SUBMIT YOUR APPLICATION HERE</h2>
        <div class="investor-form">
            <form method="post" action="#upload" enctype="multipart/form-data" style="display: block; text-align: center;">
                <label style="padding-top: 50px;padding-bottom: 30px;font-size:large; ">Send To : </label>
                <select name="investors" id="investors" style="font-size:large;width: 150px;margin: 10px;border-radius: 5px;" >
                    <?php
                            foreach($investorList as $investor){
                    ?>

                    <option value="<?php echo strtolower($investor); ?>" style="font-size: medium;"><?php echo $investor; ?></option>
                    <?php
                            }
                    ?>

                </select>

                <br>
                <label style="padding-bottom: 30px;font-size:large;">Doc. Title: </label>
                <input type="title" name="title" placeholder="Enter Document Title" required style="margin-left: 5px;font-size: medium; border-radius: 5px; " />
                <br>
                <label style="font-size: large;"> Doc. File: </label>
                <input type="file" name="upload" accept="application/pdf" required style="margin-left: 230px;margin-top: 7px;font-size: medium;" />
                <br>
                <input type="submit" name="submit" value="Send To Investors" style="font-size: medium;background-color: blue;color: white; padding: 7px; border-radius: 5px;margin-top: 10px;" id="btnsend" onclick="showMessage()"  />
            </form>
        </div>
       
               <div id="show" >
          <h2 id="show1" >Success!</h2>
          <h3 id="show2" > Your application has been sent to your preferred Investors</h3>
        </div>

            
    </div>
   <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
      <script type="text/javascript">
        function showMessage(){
         document.getElementById('show').style.display = "block";
        
        }
    
  </script>


</body>

</html>
