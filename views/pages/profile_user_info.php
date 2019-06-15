<!-- ==============================================
Header
=============================================== -->
<?php
zabeleziPristupStranici();
$_SESSION['userStrana'] = $_GET['user']; //kreiranje sesije sa id-em korisnika na cijem smo profilu
$idUserSession = $_SESSION['userStrana']; // promenljiva koja sadrzi id tog korisnika na cijoj smo strani
$getUserPhotoSession = getUserPhoto($idUserSession); //dohvatanje slike korisnika sa zadatim id
$getUserSession = getUser($idUserSession); //dohvatiti korisika sa zadatim id
?>
<header class="profile-bg-picture">

    <img src="<?= $getUserPhotoSession->background_path; ?>" alt="<?= $getUserSession->first_name; ?>" class="thumb-lg img-circle">
</header><!-- /header -->

<!-- ==============================================
User Section
=============================================== -->
<section class="user-section">
    <div class="container">
        <div class="profile-user-box">
            <div class="row">
                <div class="col-sm-6">
<!--                    Mala profilna slika korisnika -->
                    <img src="<?= $getUserPhotoSession->profile_path; ?>" alt="<?= $getUserSession->first_name; ?>" class="thumb-lg img-circle">

                    <div class="media-body">
                        <h4 class="m-t-5 m-b-5 ellipsis"><?= $getUserSession->first_name; ?> <?= $getUserSession->last_name; ?></h4>
<!--                        -->
                        <?php
                        $role = $_SESSION['user']->id_role; //id uloge korisnika koji je ulogovan
                        if($role ==1):?>
                            <p class="font-13">User Role:  <?= strtoupper (userRole($_GET['user'])->role_name); ?></p>
                        <?php endif; ?>
<!--                        <p class="text-muted m-b-0"><small>California, United States</small></p>-->
                    </div><!-- /media-body -->
                </div><!-- /col-sm-6 -->
                <div class="col-sm-6">
                    <div class="text-right">
                        <?php
                        $role = $_SESSION['user']->id_role; //id uloge korisnika koji je ulogovan
                        if($idUser == $idUserSession || $role == 1):

                        ?>
                        <button type="button" class="btn btn-success waves-effect waves-light">
                            <a href="index.php?page=editProfile&user=<?= $idUserSession;?>"><i class="fa fa-user m-r-5"></i> Edit Profile</a>
                        </button><br>
                        <button type="button" class="btn btn-success waves-effect waves-light" style="margin-top: 5px;">
                            <a href="index.php?page=editPost&user=<?= $idUserSession;?>"><i class="fa fa-user m-r-5"></i> Edit Posts</a>
                        </button>
                        <?php endif; ?>
                    </div><!-- /text-right -->
                </div><!-- /col-sm-6 -->
            </div><!-- /row -->
        </div><!--/ profile-user-box -->
    </div><!-- /container -->
</section><!-- /section -->
