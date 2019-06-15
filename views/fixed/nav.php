
<body>
<?php
ob_start();

    $idUser = $_SESSION['id_user'];
    $getUserPhoto = getUserPhoto($idUser);
    $getUser = getUser($idUser);
    $categories = getCategories();


?>
<!-- ==============================================
Navigation Section
=============================================== -->
<nav class="navbar navbar-light navbar-toggleable-sm bg-faded justify-content-between" id="mainNav-2">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#collapsingNavbar2">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a href="index.php?page=pocetna" class="navbar-brand mr-0"> MEDIUM</a>&nbsp;
    <div class="navbar-collapse collapse justify-content-between" id="collapsingNavbar2">
        <div><!--placeholder to evenly space flexbox items and center links--></div>
        <ul class="navbar-nav">
            <!-- Search in right of nav -->
            <li class="nav-item hidden-xs-down">
                <?php
                    @$url = $_GET['page'];
                    if($url == 'pocetna'):

                ?>
                <form class="top_search clearfix" method="post" action="models/posts/searchPost.php">
                    <div class="top_search_con">
                        <input class="s" placeholder="Search Here ..." type="text" id="searchPost">
                        <span class="top_search_icon"><i class="fa fa-search"></i></span>
                        <input class="top_search_submit" type="submit">
                    </div>
                </form>
                <?php endif; ?>
            </li>
            <!-- Search Ends -->
        </ul>
        <ul id="slikaNav" class="nav navbar-nav">
            <a href="index.php?page=profilUser&user=<?= $idUser; ?>">
                <li><span class="avatar w-32"><img src="<?= $getUserPhoto->nav_path; ?>"  width="25" height="25" alt="<?= $getUser->first_name; ?>"></span></li>
            </a><!-- /navbar-item -->
            <a href="index.php?page=profilUser&user=<?= $idUser; ?>"><li><?= $getUser->first_name; ?></li></a>
            <?php
            $role = $_SESSION['user']->id_role; //id uloge korisnika koji je ulogovan
            if($role == 1):

            ?>
            <li><a href="index.php?page=autor">Author</a></li>
            <li><a href="index.php?page=adminPanel">AdminPanel</a></li>
            <?php endif; ?>
            <li><a href="models/users/logout.php">Logout</a></li>
<!--            <li><a href="models/users/exportExcel.php"><i class="fa fa-user m-r-5"></i>Export Excel</a></li>-->
        </ul><!-- /navbar-nav -->
    </div><!-- /navbar-collapse -->
</nav><!-- /nav -->
