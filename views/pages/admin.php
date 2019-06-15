<?php
zabeleziPristupStranici();
$role = $_SESSION['user']->id_role;
if($role != 1){
    header("Location: index.php?page=pocetna");
}

?>

<div class="row">
    <div class="col-md-2 col-lg-2"></div>
    <div class="card col-sm-12 col-md-8 col-lg-8">
        <div class="card-header card-header-info">
            <h4 class="card-title">Usefull links</h4>
        </div>
        <div class="card-body table-responsive">
            <ul id="adminUl" >

                <li><a href="models/users/exportExcel.php"></i>Export Excel</a></li>
                <li><a href="models/users/exportWord.php"></i>Export Word</a></li>
                <li><a href="data/documentaton.pdf"></i>Documentation</a></li>
            </ul>

        </div>
    </div>
    <div class="col-md-2 col-lg-2"></div>
</div>



<div class="row">
    <div class="col-md-2 col-lg-2"></div>
    <div class="card col-sm-12 col-md-8 col-lg-8">
        <div class="card-header card-header-info">
            <h4 class="card-title">Attendance in the last 24 hours in %</h4>
        </div>
        <div class="card-body table-responsive">
            <table class="flat-table flat-table-3">
<!--                <thead>-->
<!--                    <th>Page</th>-->
<!--                    <th>%</th>-->
<!--                </thead>-->
                 <tbody><tr>
                     <td>Login/Reg</td>
                     <td>Index</td>
                     <td>User Profile</td>
                     <td>Edit Profile</td>
                     <td>Edit Post</td>
                     <td>Comment</td>
                     <td>Admin Panel</td>
                     <td>Author</td>
                 </tr>
                 <tr>
            <?php

                $podaci = pristumStranamaUprocentima();
                //var_dump($podaci);
                    foreach ($podaci as $podatak):

            ?>

                        <td><?= $podatak; ?></td>



            <?php endforeach; ?>
                 </tr>
                </tbody>
            </table>

        </div>
    </div>
    <div class="col-md-2 col-lg-2"></div>
</div>

<div class="row">
    <div class="col-md-2 col-lg-2"></div>
    <div class="card col-sm-12 col-md-8 col-lg-8">
        <div class="card-header card-header-info">
            <h4 class="card-title">Active members: <?php echo loggedCount();?></h4>
        </div>
        <div class="card-body table-responsive">
            <table class="flat-table flat-table-3">
                <!--                <thead>-->
                <!--                    <th>Page</th>-->
                <!--                    <th>%</th>-->
                <!--                </thead>-->
                <tbody><tr>
                    <td>No.</td>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Role</td>


            <?php
                $idUlogovanogUsera = @file(LOGGING_FAJL);
                $br = 1;
                foreach ($idUlogovanogUsera as $id):
            ?>
                </tr>
                    <td><?= $br++;?></td>
                    <td><?= nameUser($id)->first_name; ?></td>
                    <td><?= nameUser($id)->last_name; ?></td>
                    <td><?= nameUser($id)->role_name; ?></td>
                </tr>
            <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-2 col-lg-2"></div>
</div>
