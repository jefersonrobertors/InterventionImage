<?php

use app\models\User;

global $session;
$sessionUser = $session->getSession('auth');

$user = (new User)->find('id', $sessionUser->id); echo '<br>';

if(empty($user->avatar)) {
    $avatarPath = '/public/images/user.png';
}else{
    $avatarPath = $user->avatar;
};
?>
<div class="container">
    <img class="avatar" src="<?php echo $avatarPath;?>" alt="" loading="lazy">
    <form action="/upload" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        <input type="file" name="image" id="image" accept="image/*">
        <input type="submit" value="Upload">
        <?php echo isset($_GET['error']) ? '<span class="error">' . $_GET['error'] . '</span>' : ''?>
        <?php \app\services\CsfrService::insertHiddenToken(); ?>
    </form>
    <a href="/deauth">Logout</a>
</div>