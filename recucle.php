<?
$r=$db->dbs->prepare("SELECT R.status, P.*, C.nazv FROM `recucle` R, `products` P, `category` C WHERE R.idp=P.id and P.idcat=C.id and R.iduser=:i and R.status=1;");
$r->execute([':i'=>$_SESSION['id']]);
if ($r->rowCount()!=0){
    print "<table><tr><td><p class='text'>Название</p></td><td><p class='text'>Цена</p></td></tr>";
    foreach ($r as $res){
        print "<tr><td><p class='text'>".$res['nam']."</p></td><td><p class='text'>".$res['price']."</p></td></tr>";
    }
    print "</table>";
    print "<a href='index.php?page=".$_REQUEST['page']."&action=ins'>Купить</a>";
    print "<a href='index.php?page=".$_REQUEST['page']."&action=del'>Очистить Корзину</a>";
}
?>