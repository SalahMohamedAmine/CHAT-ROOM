<?php
/***
    Ftech All User
 */
function ftechOnetoone($user1,$user2,$limit , $lastid)
{
    global $con;
    $stmt=$con->prepare("SELECT * FROM message WHERE (user_id=? AND user2=? AND id > ?) OR (user2=? AND user_id=?  AND id > ?) ORDER BY date DESC  LIMIT $limit");
    $stmt->execute(array($user1,$user2, $lastid,$user1,$user2, $lastid));
    $rows=$stmt->fetchAll();
    usort($rows,function($a,$b)
    {
        if($a>$b)
            return $b;
    });
    return $rows;
}




function getAllUser($userName)
{
    global $con;
    $stmt=$con->prepare("SELECT DISTINCT (id_user), users.* , message FROM users ,message WHERE name!=? AND users.id_user=message.user_id ORDER BY `date` DESC ");
    $stmt->execute(array($userName));
    $row=$stmt->fetchAll();
    return $row;
}
/*
 *
 * Ftech One To One
 * */
/***
    Get the Lastest Message
 */

function lastestMessage($username)
{
    global $con;
    $stmt=$con->prepare("select users.* ,message from message ,users where users.id_user=message.user_id AND users.name!=? And message.id in (select max(id) from message group by message.user_id)
");
    $stmt->execute(array($username));
    $row=$stmt->fetchAll();
    return $row;

}
/****
check user
 */
function checkUser($userName)
{
    global $con;
    $stmt=$con->prepare("SELECT * FROM users WHERE name=?");
    $stmt->execute(array($userName));
    $nb=$stmt->rowCount();
    return $nb;
}

function FetchidUser($userName)
{
    global $con;
    $stmt=$con->prepare("SELECT id_user FROM users WHERE name=?");
    $stmt->execute(array($userName));
    $row=$stmt->fetch();
    return $row;
}

/*
 * Fetch Messages
 * */

function FetchMessage($limit)
{
    global $con;
    $stmt=$con->prepare("SELECT * FROM message WHERE user2=0 ORDER BY date DESC  LIMIT $limit");
    $stmt->execute();
    $rows=$stmt->fetchAll();
    usort($rows,function($a,$b)
    {
        if($a>$b)
            return $b;
    });
    return $rows;
}

/**
    /*insert Message
 **/

function insertMessage($msg,$user1,$user2)
{
    global $con;
    $stmt=$con->prepare("INSERT INTO `message` (`id`, `message`, `date`, `user_id`,`user2`) VALUES (NULL, ?, CURRENT_TIMESTAMP, ?,?);
");
    $stmt->execute(array($msg,$user1,$user2));
    $nb=$stmt->rowCount();
    return $nb;
}



function FetchMessage2($limit , $lastid)
{
    global $con;
    $stmt=$con->prepare("SELECT * FROM message WHERE user2=0 and id > ? ORDER BY date DESC  LIMIT $limit");
    $stmt->execute(array($lastid));
    $rows=$stmt->fetchAll();
    usort($rows,function($a,$b)
    {
        if($a>$b)
            return $b;
    });
    return $rows;
}






?>