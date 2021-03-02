<?php
if (isset($_GET['registration'])){
    if (empty($_GET['login'])|| empty($_GET['pasw'])){
        $message="Введите Логин и Пароль";
    } else {
        $r=$db->dbs->prepare('select * from users where login=:j;');
        $r->execute([':j'=>$_GET['login']]);
            if ($r->rowCount()!=0){
                $message="Такой пользователь уже зарегестрирован";
            } else {
                $r=$db->dbs->prepare('insert into users set login=:j, pasw=:j1, `name`=:j2, email=:j3, phone=:j4;');
                $r->execute([
                    ':j'=>$_GET['login'],
                    ':j1'=>md5($_GET['pasw']),
                    ':j2'=>$_GET['name'],
                    ':j3'=>$_GET['email'],
                    ':j4'=>$_GET['phone']
                ]);
            }
    }

}

if (isset($_REQUEST['auth'])) {
$r=$db->dbs->prepare("SELECT * FROM users WHERE login=:j and pasw=:j1");
$r->execute([':j'=>$_REQUEST['login'], ':j1'=>md5($_REQUEST['pasw'])]);
if ($r->rowCount()!=0){
    foreach($r as $res){
        $_SESSION['test']="jhhjgh";
        $_SESSION['login']=$res['login'];
        $_SESSION['name']=$res['name'];
        $message="Вы успешно авторизованы-".$r->rowCount();
    }
}else $message="error-".$r->rowCount();
}