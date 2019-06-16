$(function() {

    //Color red in sign up | Login

    $(".formulaire h2 span").click(function()
    {
        $(this).addClass('active').siblings().removeClass('active');
        var etat=($(this).attr('data-class'));
        //console.log(etat);
        $('form').hide();

        $('.'+ etat).css('display','block');
    });


    var url="ajaxRoom.php?";
    scroll();
    start();
    $('.msg_history').scrollTop($('.msg_history')[0].scrollHeight);

    var timer ;
    function start()
    {
        timer = setInterval(send, 1000);
        console.log("sended");
    }
    function send()
    {
        urli = url + "lastid=" +$(".lastid").val();
        $.ajax({
            url: urli,
            type:"GET",
            dataType: "html",

        }).done(function(data){
            i = $(".lastid").val();

            $(".lastid").remove();
            $(".msg_history").append(data);
            if(i<$(".lastid").val() || i == null)
            $('.msg_history').scrollTop($('.msg_history')[0].scrollHeight);

        });

       /* $.ajax({
            url: "http://127.0.0.1:500/chatRoom/ajaxSideBar.php",
            type:"GET",
            dataType: "html",

        }).done(function(data){
            $(".inbox_chat").html(data);

            console.log(data);
        });*/
    }
    function stop()
    {
        clearInterval(timer);
    }
    $(".chat_list").on("click",function(e)
    {
        nva = $(this).find(".sons").val();
        $(".active_chat").removeClass("active_chat");
        $(this).addClass("active_chat");
        console.log($(this).find(".sons").val());
        $("#sendTo").val(nva);
        url="onetoone.php?id="+nva+"&";
        $(".lastid").val("0");
        $(".msg_history").html("");


        $(".inbox_people").addClass("hidd");
        $(".mesg").removeClass("hidd");
        $("#chat").addClass("btn-primary");
        $("#amis").removeClass("btn-primary");
        e.preventDefault();
    });



    $(".sendmsg").on("submit",function(e)
    {

        nvm = $(this).serialize();
        $(".write_msg").val("");
        //alert("vf");
        //alert(nvm);
        $.ajax({
            url: "insertMessageAjax.php",
            type:"POST",
            data: nvm,
            dataType: "html",


        }).done(function(data){
            // $(".msg_history").html(data);
            // $('.msg_history').scrollTop($('.msg_history')[0].scrollHeight);
            //console.log(data);
        });
        e.preventDefault();
    });

/*scroll*/

function scroll()
{
     w = window.innerWidth ;
     if(w <= 575){
         $(".inbox_people").addClass("hidd");
         h = window.innerHeight ;
          send_button = $('.sendmsg').height();
          $('.msg_history').height(h - send_button-40);
     }else {
         $("#switch").addClass("hidd");
     }
}

$("#chat").on("click",function () {
    $(".inbox_people").addClass("hidd");
    $(".mesg").removeClass("hidd");
    $(this).addClass("btn-primary");
    $("#amis").removeClass("btn-primary");


});
    $("#amis").on("click",function () {
        $(".mesg").addClass("hidd");
        $(".inbox_people").removeClass("hidd");
        $(this).addClass("btn-primary");
        $("#chat").removeClass("btn-primary");
    });


});