<?php
include 'init.php';
session_start();
$id=FetchidUser($_SESSION['name'])['id_user'];
$data=ftechOnetoone($id,$_GET['id'],10,$_GET['lastid']);
/*Start Sid Bar Message*/

/*End Sid Bar Message*/
/*Message*/
foreach ($data as $d)
{

    if($d['user_id'] !=$id )
    {

        ?>
        <div class="incoming_msg">
            <div class="incoming_msg_img"> <img src="avatar.png" class="rounded-circle" alt="sunil"> </div>

            <div class="received_msg">
                <div class="received_withd_msg">
                    <p><?php echo $d["message"]; ?></p>
                    <span class="time_date">  <?php echo $d["date"]; ?></span></div>
            </div>
        </div>

        <?php
    }else{
        ?>
        <div class="outgoing_msg">
            <div class="sent_msg">
                <p><?php echo $d["message"]; ?></p>
                <span class="time_date"> <?php echo $d["date"]; ?></span> </div>
        </div>
        <?php
    }}
if(!empty($data))
    $lastid = $data[sizeof($data)-1]["id"];
else
    $lastid =$_GET['lastid'];

?>
<input type="hidden"  class="lastid" value="<?php echo $lastid; ?>">
