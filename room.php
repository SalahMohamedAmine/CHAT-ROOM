<?php
session_start();
include 'init.php';
include  $tpl."header.php";
if(isset($_SESSION['name']))
{
    $id=FetchidUser($_SESSION['name'])['id_user'];
}else
{
    header("Location: index.php");
    exit();
}
    if($_SERVER['REQUEST_METHOD']=="POST")
{
    $msg=$_POST['msg'];
    $sendto=$_POST['sendTo'];

    $check=insertMessage($msg,$id,$sendto);
    //header("Location: room.php");
}
include  $tpl."header.php";
?>
    <div class="logout float-right">
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
    </div>
    <div id="switch">
        <span class="btn " id="amis">Amis</span>
        <span class="btn btn-primary" id="chat">Chat</span>
    </div>
    <div class="container">
        <h3 class=" text-center ">Messaging</h3>
        <div class="messaging">
            <div class="inbox_msg">
                <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4>Recent</h4>
                        </div>
                        <div class="srch_bar">
                            <div class="stylish-input-group">
                                <input type="text" class="search-bar"  placeholder="Search" >
                                <span class="input-group-addon">
	                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
	                </span> </div>
                        </div>
                    </div>
                    <div class="inbox_chat">
                        <div class="chat_list active_chat">
                            <div class="chat_people">
                                <div class="chat_img"> <img src="avatar.png" class="rounded-circle" alt="sunil"> </div>
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
                        <!--Start CHAT MESSAGE-->
                               <?php $userss=lastestMessage($_SESSION['name']);
                        foreach ($userss as $dss){?>
                            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET" class="userrr">
                                <div class="chat_list">
                                    <div class="chat_people">
                                        <div class="chat_img"> <img src="avatar.png" class="rounded-circle" alt="sunil"> </div>
                                        <div class="chat_ib">
                                            <h5><?php echo $dss['name'];?><span class="chat_date">Dec 25</span></h5>
                                            <p><?php echo $dss['message'];?>.</p>
                                            <input type="hidden" name="id" value="<?php echo $dss['id_user'];?>" class="sons">
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <?php }?>
                        <!--End CHAT MESSAGE-->
                    </div>
                </div>


                <div class="mesg" style="" id="mesgs" >
                    <div class="msg_history">


                    </div>
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="sendmsg">
                        <div class="type_msg">
                            <div class="input_msg_write">
                                <input type="text" class="write_msg" name="msg" placeholder="Type a message" autocomplete="off" />
                                <input type="submit" class="btn btn-primary" value="Send">
                                <input type="hidden" name="sendTo" value="0" id="sendTo">
                            </div>
                        </div>
                    </form>
                </div>

            </div>




        </div>
    </div>
<?php
include $tpl.'footer.php';
?>