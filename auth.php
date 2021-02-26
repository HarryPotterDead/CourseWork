<?php
if (isset($message)){
    print $message;
}
?>
<!--
<div class="login">
    <<form action="index.php" method="get">
        <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
        <input type="text" placeholder="Username" name="login">
        <input type="password" placeholder="password" name="pasw">
        <button type="submit">Send</button>
    </form>
</div> -->

<div class="wrapper">
    <form action="index.php" class="form-signin" method="GET">       
      <h2 class="form-signin-heading">Please login</h2>
      <input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
      <input type="text" class="form-control" name="login" placeholder="Login" required="" autofocus="" />
      <input type="password" class="form-control" name="pasw" placeholder="Password" required=""/>      
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
    </form>
  </div>