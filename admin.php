<?
if ($_SESSION['status']==100){
    ?>
    <a href="index.php?page=<?=$_REQUEST['page']?>&items=1">Добавить категорию</a><br>
    <a href="index.php?page=<?=$_REQUEST['page']?>&&items=2">Добавить товар</a><br>
    <?
    if (isset($_REQUEST['items'])){
        if ($_REQUEST['items']==1){
            ?>
            <h3>Добавление категории</h3>
            <form action="index.php" method="POST">
                <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
                <input type="hidden" name="items" value="<?=$_REQUEST['items']?>">
                <input type="text" name="nazv">
                <button>inserting</button>
            </form>
            <?
        }
        if ($_REQUEST['items']==2){
            ?>
            <h3>Добавление товара</h3>
            <form action="index.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
                <input type="hidden" name="items" value="<?=$_REQUEST['items']?>">
                <select name="idcat">
                    <?
                    $r=$db->dbs->prepare('SELECT DISTINCT * from category;');
                    $r->execute();
                    if ($r->rowCount()!=0){
                        foreach ($r as $res){
                            print "<option value='".$res['id']."'>".$res['nazv']."</option>";
                        }
                    }else print "<option disabled>Нет категорий</option>";
                    ?>
                </select>
                <input type="text" name="nam">
                <input type="number" name="price">
                <input type="file" name="img">
                <button>inserting</button>
            </form>
            <?
        }
    }
}
?>
<a href="index.php?page=<?=$_REQUEST['page']?>&&items=3">Мои Заказы</a>
<?
if (isset($_REQUEST['items'])) {
    if ($_REQUEST['items'] == 3) {
        $r = $db->dbs->prepare("SELECT R.status, P.*, C.nazv FROM `recucle` R, `products` P, `category` C WHERE R.idp=P.id and P.idcat=C.id and R.iduser=:i and R.status>1;");
        $r->execute([':i' => $_SESSION['id']]);
        if ($r->rowCount() != 0) {
            print "<table><tr><td><p class='text'>Название</p></td><td><p class='text'>Цена</p></td></tr>";
            foreach ($r as $res) {
                print "<tr><td><p class='text'>" . $res['nam'] . "</p></td><td><p class='text'>" . $res['price'] . "</p></td></tr>";
            }
            print "</table>";
        }
    }
}
?>