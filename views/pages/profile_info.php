<section class="posts-2">
	  <div class="container-fluid">
	   <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-4">

		 <div class="card widget-info-one">

		    <div class="card-block">
		 <div class="inner">
		  <div class="widget-avatar pull-left"><img alt="<?= $getUser->first_name; ?>" src="<?= $getUserPhoto->comment_path; ?>"></div>
		   <h5><?= $getUser->first_name; ?> <?= $getUser->last_name; ?></h5>
		   <span class="subtitle"><?= $getUser->description; ?></span>
		  </div><!-- /.inner -->
		  </div>
          <div class="card-footer">
           <ul class="post-view">
               <li></li>
               <?php
               $brojPostova = getAllPostsProfile($_SESSION['id_user']);
               ?>
               <li><a href="#"><i class="fa fa-edit"></i></a><?= count($brojPostova);  ?></li>




           </ul><!-- /.post-view -->
          </div><!-- /.card-footer -->
         </div><!-- /.panel -->

		<div class="card widget-info-two">
		  <ul class="list-group list-group-flush">
<!--			<li class="list-group-item"><i class="fa fa-map-marker"></i>&nbsp; New York</li>-->
              <?php
                $datumJoin = $getUser->created_at;
                $datumObrada = date('d-m-Y', strtotime($datumJoin));

              ?>
			<li class="list-group-item"><i class="fa fa-calendar"></i>&nbsp; Joined <?= $datumObrada; ?></li>

		  </ul>
		</div>
            <section class="box-typical">
                <header class="box-typical-header-sm">People you may know</header>
                <div class="people-rel-list">
                    <ul class="people-rel-list-photos" id="usersPretraga">

                    </ul>
                    <form class="site-header-search">
                        <input placeholder="Search for people" type="text" id="textUser" style="border: 1px solid #1ab394;">
                        <button type="submit">
                            <span class="fa fa-search"></span>
                        </button>
                        <div class="overlay"></div>
                    </form>
                </div>
            </section>
            <h3>Categories</h3>
            <ul style="border:1px solid #d8e2e7;list-style-type: circle;">
                <?php

                foreach ($categories as $getCategory):
                    ?>

                    <li><a class="getCategory" href="index.php?page=pocetna&category=<?= $getCategory->id_category; ?>" style="color:black;"><?= $getCategory->naziv; ?></a></li>

                <?php endforeach; ?>
                <?php
                if(isset($_GET['category'])){
                    $_SESSION['id_category'] = $_GET['category'];
                }else{
                    unset($_SESSION['id_category']);
                }
                ?>
            </ul>
        </div>








