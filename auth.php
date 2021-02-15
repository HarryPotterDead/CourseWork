Autorization
<?php
if (isset($message)){
    print $message;
}
?>
<div class="login">
    <form action="index.php" method="get">
        <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
        <input type="text" placeholder="Username" name="login">
        <input type="password" placeholder="password" name="pasw">
        <button type="submit">Send</button>
    </form>
</div>