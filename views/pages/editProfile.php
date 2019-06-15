<?php
zabeleziPristupStranici();
$idUserGET = $_GET['user']; //Dohvatam id usera iz url adrese
@$_SESSION['idUserDelete'] = $idUserGET;
$getUserGET = getUser($idUserGET);
include ABSOLUTE_PATH."/models/zabranaUser.php";
?>
<div class="row">
    <div class="col-md-2 col-lg-2"></div>
    <div class="card col-sm-12 col-md-8 col-lg-8">
        <div class="card-header card-header-info">
            <h4 class="card-title">Change Personal Info</h4>
        </div>
        <div class="card-body table-responsive">

            <!-- FORMA ZA UPDATE USER INFO  -->
            <form action="models/posts/updatePost.php" method="POST">
                <input type="hidden" name="tbHidden1" id="tbHidden1" value="<?= $_GET['user']; ?>">
                <div class="input">
                    <p style="color: #9e9e9e;font-size: 12px;font-weight:400;">First Name</p>
                    <input class="main-form animated bounceInDown" type="text" name="tbFirstName" id="tbFirstName" value="<?= $getUserGET->first_name; ?>">
                </div>

                <div class="input">
                    <p style="color: #9e9e9e;font-size: 12px;font-weight:400;">Last Name</p>
                    <input class="main-form animated bounceInDown" type="text" name="tbLastName" id="tbLastName" value="<?= $getUserGET->last_name; ?>">
                </div>

                <div class="input">
                    <p style="color: #9e9e9e;font-size: 12px;font-weight:400;">Mail</p>
                    <input class="main-form animated bounceInDown" type="text" name="tbMail" id="tbMail" value="<?= $getUserGET->email; ?>">
                </div>

                <div class="input">
                    <p style="color: #9e9e9e;font-size: 12px;font-weight:400;">Description</p>
                    <textarea class="form-control animated bounceInDown" style="border: 3px solid #a0b3b0;" name="tbDescription" id="tbDescription"><?= $getUserGET->description; ?>

                    </textarea>

                </div>
                <div class="input">
                    <input type="button" class="btn btn-success" value="Save" name="btnUpdateProfile" id="btnUpdateProfile" />
                </div>



            </form>
            <!--// FORMA ZA UPDATE USER INFO  -->

        </div>
    </div>
    <div class="col-md-2 col-lg-2"></div>
</div>

<div class="row">
    <div class="col-md-2 col-lg-2"></div>
    <div class="card col-sm-12 col-md-8 col-lg-8">
        <div class="card-header card-header-info">
            <h4 class="card-title">Change Password</h4>
        </div>
        <div class="card-body table-responsive">

            <!-- FORMA ZA UPDATE USER INFO  -->
            <form action="models/users/updatePassword.php" method="POST">
                <input type="hidden" name="tbHidden2" id="tbHidden2" value="<?= $_GET['user']; ?>">
                <div class="input">
                    <p style="color: #9e9e9e;font-size: 12px;font-weight:400;">Password</p>
                    <input class="main-form animated bounceInDown" type="password" name="tbPassword" id="tbPassword"">
                </div>

                <div class="input">
                    <p style="color: #9e9e9e;font-size: 12px;font-weight:400;">Confirm Password</p>
                    <input class="main-form animated bounceInDown" type="password" name="tbPasswordConfirm" id="tbPasswordConfirm"">
                </div>
                <div class="input">
                    <input type="button" class="btn btn-success" value="Save" name="btnUpdatePassword" id="btnUpdatePassword" />
                </div>

            </form>
            <!--// FORMA ZA UPDATE USER INFO  -->

        </div>
    </div>
    <div class="col-md-2 col-lg-2"></div>
</div>
<div class="row">
    <div class="col-md-2 col-lg-2"></div>
    <div class="card col-sm-12 col-md-8 col-lg-8">
        <div class="card-header card-header-info">
            <h4 class="card-title">Change User Role</h4>
        </div>
        <div class="card-body table-responsive">

            <!-- FORMA ZA UPDATE role PHOTO -->
            <?php
            $role = $_SESSION['user']->id_role; //id uloge korisnika koji je ulogovan
            if($role ==1):?>
                <form action="models/users/updateRole.php" method="post">
                    <input type="hidden" name="hiddenIdUser" value="<?= $getUserGET->id_user;?>">
                    <select name="ddlRole" class="main-form animated bounceInDown">
                        <option value="0">Choose role</option>
                        <?php $roles = getRoles();
                        foreach ($roles as $role):
                            if($role->id_role == $getUserGET->id_role):
                            ?>
                            <option selected value="<?= $role->id_role; ?>"><?= $role->role_name; ?></option>
                        <?php else: ?>
                        <option value="<?= $role->id_role; ?>"><?= $role->role_name; ?></option>

                        <?php
                            endif;
                            endforeach;
                         ?>
                    </select>
                    <input type="submit" class="btn btn-success" value="Save" name="updateRole" style="margin-left: 100px;" />
                </form>
            <?php endif; ?>
            <!--// FORMA ZA UPDATE Role PHOTO -->

        </div>
    </div>
    <div class="col-md-2 col-lg-2"></div>
</div>
<div class="row">
    <div class="col-md-2 col-lg-2"></div>
    <div class="card col-sm-12 col-md-8 col-lg-8">
        <div class="card-header card-header-info">
            <h4 class="card-title">Change Background Photo</h4>
        </div>
        <div class="card-body table-responsive">

            <!-- FORMA ZA UPDATE BACKGROUND PHOTO -->
            <form action="models/users/updateBackgroundPhoto.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="tbHidden3" value="<?= $_GET['user']; ?>">
                <p style="color: #9e9e9e;font-size: 12px;font-weight:400;">Change Background Photo</p>

                <div class="input-field">

                    <button type="button" onclick="document.getElementById('backgroundPhoto').click()" class="btn btn-info">Choose profile photo</button>
                    <span id="backgroundPhotoValue"></span>

                    <input type="file" name="backgroundPhoto" id="backgroundPhoto" style="display:none;" onchange="document.getElementById('backgroundPhotoValue').innerHTML=this.value;"/>

                    <input type="submit" class="btn btn-success" value="Save" name="endUpdateBackground" style="margin-left: 30px;" />
                </div>



            </form>
            <!--// FORMA ZA UPDATE BACKGORUND PHOTO -->

        </div>
    </div>
    <div class="col-md-2 col-lg-2"></div>
</div>

<div class="row">
    <div class="col-md-2 col-lg-2"></div>
    <div class="card col-sm-12 col-md-8 col-lg-8">
        <div class="card-header card-header-info">
            <h4 class="card-title">Change Profile Photo</h4>
        </div>
        <div class="card-body table-responsive">

            <!-- FORMA ZA UPDATE Profiles PHOTO -->
            <form action="models/users/updateProfilePhoto.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="tbHidden4" value="<?= $_GET['user']; ?>">
                <p style="color: #9e9e9e;font-size: 12px;font-weight:400;">Change Profile Photo</p>

                <div class="input-field">

                    <button type="button" onclick="document.getElementById('profilePhoto').click()" class="btn btn-info">Choose profile photo</button>
                    <span id="profilePhotoValue"></span>

                    <input type="file" name="profilePhoto" id="profilePhoto" style="display:none;" onchange="document.getElementById('profilePhotoValue').innerHTML=this.value;"/>

                    <input type="submit" class="btn btn-success" value="Save" name="endUpdateProfile" style="margin-left: 30px;" />
                </div>



            </form>
            <!--// FORMA ZA UPDATE Profile PHOTO -->

        </div>
    </div>





    <div class="col-md-2 col-lg-2">
        <?php
        $role = $_SESSION['user']->id_role; //id uloge korisnika koji je ulogovan
        if($role ==1):?>
        <form action="models/users/deleteUser.php" method="post">
            <input type="submit" class="btn btn-danger" value="DELETE USER" name="deleteUser" style="margin-left: 100px;" />
        </form>
        <?php endif; ?>
    </div>
</div>