<?php

if (isset($_REQUEST['login'])){
    if (($_REQUEST['login']!='') && ($_REQUEST['pasw']!='')){
        $r=$db->dbs->prepare('SELECT * FROM users WHERE login=:i;');
        $r->execute([':i'=>$_REQUEST['login']]);
        if ($r->rowCount()!=0){
            $message.="Duplicated login";
        }else{
            $pasw=md5($_REQUEST['pasw']);
            $r=$db->dbs->prepare('INSERT INTO users SET login=:i, pasw=:i1');
            ($r->execute([':i'=>$_REQUEST['login'], ':i1'=>$pasw]))?$message.="Inserting":$message.="Not Inserting";
        }
    }else $message.="Empty data";
}