<div class="profile">
    <div class="profile_img">
        <a href="<?=$absolute_url?>!u/<?=$_SESSION['user']['folder']?>/"><img src="<?=$_SESSION['user']['profile_img_url'] != '' ? $_SESSION['user']['profile_img_url'] : $absolute_url.$theme_path.'/images/noprofileimage.jpg' ?>" alt="<?=$_SESSION['user']['first_name']?> <?=$_SESSION['user']['last_name']?>" /></a>
    </div>
    <div class="profile_name">
        <?=$_SESSION['user']['first_name']?> <?=$_SESSION['user']['last_name']?>
        <span>(<a href="<?=$absolute_url?>!u/<?=$_SESSION['user']['folder']?>/">edit profile</a>)</span>
    </div>
</div>