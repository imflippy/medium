<?php
zabeleziPristupStranici();
$idUserGET = $_GET['user']; //Dohvatam id usera iz url adrese
$getUserGET = getUser($idUserGET);
@$_SESSION['idUserDelete'] = $idUserGET;
include ABSOLUTE_PATH."/models/zabranaUser.php";
?>

<div class="container">
    <div class="row">
        <div class="col-xs-2 col-md-2"></div>
        <div class="col-xs-8 col-md-8">
            <div class="card-body table-responsive">

                <!-- FORMA ZA UPDATE USER INFO  -->
                Edit
                <form action="models/posts/updatePost.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="hiddenPost" id="hiddenPost">
                    <div class="input">
                        <p style="color: #9e9e9e;font-size: 12px;font-weight:400;">Title</p>
                        <input class="main-form animated bounceInDown" type="text" name="tbTitle" id="tbTitle" required>
                    </div>

                    <div class="input">
                        <p style="color: #9e9e9e;font-size: 12px;font-weight:400;">Description</p>
<!--                        <input class="main-form animated bounceInDown" type="text" name="tbDescription" id="tbDescription" required>-->
                        <textarea class="form-control no-border" rows="3" name="tbDescription" id="tbDescription" required></textarea>
                    </div>

                    <div class="input">
                        <p style="color: #9e9e9e;font-size: 12px;font-weight:400;">Choose Category</p>
                        <select class="btn btn-sm" name="ddlCategories" id="ddlCategories" style="background-color: #1ab394;">
                            <?php
                            foreach ($categories as $cat):
                                ?>
                                <option value="<?= $cat->id_category; ?>"><?= $cat->naziv; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="input">
                        <p style="color: #9e9e9e;font-size: 12px;font-weight:400;">Photo is required</p>
                        <a class="nav-link" href="#" onclick="document.getElementById('postPhoto').click()"><i class="fa fa-camera text-muted"></i></a>
                        <input type="file" name="postPhoto" id="postPhoto" style="display:none;" onchange="document.getElementById('postPhotoValue').innerHTML=this.value;" required/>

                        <span id="postPhotoValue"></span>
                    </div>
                    <div class="input">
                        <input type="submit" class="btn btn-success" value="Save" name="btnUpdatePost" id="btnUpdatePost" />
                    </div>



                </form>
                <!--// FORMA ZA UPDATE USER INFO  -->

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-9 col-md-9">
            <table class="table">
                <tr>
                    <th>Photo</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>

                </tr>
            </table>
            <table class="table" id="postoviUser">

            </table>

        </div>


    </div>

</div>
