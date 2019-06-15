<section class="posts-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-4">

                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <?php $brojPostova = getAllPostsProfile($idUserSession); ?>

                            <span class="number"><?= count($brojPostova);  ?></span>Total Posts
                        </div>
<!--                        <div class="tbl-cell">-->
<!--                            <span class="number">544</span>Total Likes-->
<!--                        </div>-->
                    </div>
                </div>

                <div class="card about-user">
                    <div class="card-body">
                        <div class="card-block">
                            <h4 class="card-title info">About</h4>
                            <p class="card-text"><?= $getUserSession->description; ?></p>
                            <div class="text-left">
                                <p class="card-text"><strong>Full Name :</strong> <span class="m-l-15"><?= $getUserSession->first_name; ?> <?= $getUserSession->last_name; ?></span></p>
<!--                                <p class="card-text"><strong>Mobile :</strong><span class="m-l-15">(+12) 334 5555 723</span></p>-->
<!--                                <p class="card-text"><strong>Website :</strong> <span class="m-l-15">www.themashabrand.com</span></p>-->
<!--                                <p class="card-text"><strong>Location :</strong> <span class="m-l-15">USA</span></p>-->
                            </div>
                        </div>
                    </div>
                </div>


            </div>
