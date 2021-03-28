<div class="products">
    <?
    $limit=4;
    if (!isset($_REQUEST['pages'])){
        $start=1;

    }else{
        $start=($_REQUEST['pages']-1)*$limit+1;
    }
    $r=$db->dbs->prepare('SELECT * FROM products LIMIT '.$start.', '.$limit.';');
    $r->execute();
    if ($r->rowCount()!=0){
        foreach ($r as $res){
            ?>
            <div class="product-item">
                <img src="<?=$res['img']?>">
                <div class="product-list">
                    <h3><?=$res['nam']?></h3>
                    <span class="price">₽ <?=$res['price']?></span>
                    <a href="index.php?page=<?=$_REQUEST['page']?>&action=insert&id=<?=$res['id']?>" class="button">В корзину</a>
                </div>
            </div>
            <?
        }
    }
    ?>
</div>
<div>
    <?
    $countPages=4;
    $allCount=1;
    $r=$db->dbs->prepare("SELECT count(*) as n FROM products;");
    $r->execute();
    foreach ($r as $res){
        $allCount = $res['n'];
    }
    if ($allCount>4) {
        for ($i = 1; $i <= ($allCount / $countPages) + 1; $i++) {
            print "<a href='index.php?page=" . $_REQUEST['page'] . "&pages=" . $i . "'>" . $i . "</a>&nbsp;&nbsp;&nbsp;";
        }
    }
    ?>
</div>