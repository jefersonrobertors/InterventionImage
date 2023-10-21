<div class="container">
    <form action="/login" method="post">
        <input type="email" name="email" id="email" placeholder="E-mail">
        <input type="password" name="password" id="password" placeholder="Password">
        <?php echo isset($_GET['error']) ? '<span class="error">' . $_GET['error'] . '</span>' : ''?>
        <input type="submit" value="Login">
        <?php \app\services\CsfrService::insertHiddenToken(); ?>
    </form>
</div>