<?php
include 'init.php';
session_start();
$id=FetchidUser($_SESSION['name'])['id_user'];
$data=FetchMessage(10);
?>

<div class="inbox_chat">
                        <div class="chat_list active_chat">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="avatar.png" class="img-circle" alt="sunil"> </div>
                                <div class="chat_ib">
                                    <?php  $dataSideBar=FetchMessage(1);
                                        foreach ($dataSideBar as $data){
                                    ?>
    <h5>Chat Room <span class="chat_date"><?php echo $data['date']; ?></span></h5>
<p>
    <?php echo $data['message'];}; ?>
</p>
</div>
</div>
</div>
<?php $userss=getAllUser($_SESSION['name']);
foreach ($userss as $dss){?>
    <div class="chat_list">
        <div class="chat_people">
            <div class="chat_img"> <img src="avatar.png" class="rounded-circle" alt="sunil"> </div>
            <div class="chat_ib">
                <h5><?php echo $dss['name'];?><span class="chat_date">Dec 25</span></h5>
                <p><?php echo $dss['message'];?>.</p>
            </div>
        </div>
    </div>
<?php }?>
</div>