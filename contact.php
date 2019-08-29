<?php 
    include_once("includes/db.php");
    $title = "Contact Us";
    if(isset($_POST['submit'])){
        $headers = 'MIME-Version: 1.0'."\r\n";
        $headers .= 'From: Jay Ashra <jay.ashra251198@gmail.com>'."\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
        
        $to = $_POST['emailid'];
        $subject = $_POST['subject'];
        
        $body = $_POST['comments'];
        
        $sentMail = mail($to,$subject,$body,$headers);
        if(!$sentMail){
            echo error_get_last()['message'];
        }else{
            echo "Sent";
        }
    }
?>
<html>
    <?php include_once("includes/header.php"); ?>
    <div>
        <?php include_once("includes/navigation.php"); ?>
        <div class="col-md-6 col-md-offset-3">
            <form action="" method="POST" role="form">
                <legend>Contact Us!</legend>
                
                <div class="form-group">
                    <label for="mailid">Email ID</label>
                    <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Your Email">
                </div>
                
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Your Subject">
                </div>
                
                <div class="form-group">
                    <label for="comments">Comments</label>
                    <textarea name="comments" id="comments" cols="30" rows="10" class="form-control" placeholder="Your Comments"></textarea>
                </div>
                
                <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
            </form>
        </div>
    </div>
</html>