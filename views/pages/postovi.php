<?php zabeleziPristupStranici(); ?>
<div class="col-md-6">

	     <div class="box">
		  <form action="models/posts/insertPost.php" method="POST" enctype="multipart/form-data" id="unosPost" style="border: solid 1px #d8e2e7;">
              <input class="form-control no-border" type="text" name="tbTitle" placeholder="Type title" required>
		   <textarea class="form-control no-border" rows="3" name="textOpis" placeholder="Type something..." required></textarea>

              <div class="box-footer clearfix">
                  <p style="color: #7e7e7e;font-size: 12px;font-weight:400;">Choose Category</p>
                  <select class="btn btn-info btn-sm" name="ddlCategories">

                      <?php
                      foreach ($categories as $cat):
                          ?>
                          <option value="<?= $cat->id_category; ?>"><?= $cat->naziv; ?></option>
                      <?php endforeach; ?>
                  </select>
                  <ul class="nav nav-pills nav-sm">
                      <li><p style="color: #7e7e7e;font-size: 12px;font-weight:400;">Photo is Required</p></li>
                      <li class="nav-item"><a class="nav-link" href="#" onclick="document.getElementById('postPhoto').click()"><i class="fa fa-camera text-muted"></i></a></li>
                  </ul>


                  <input class="btn btn-info pull-right btn-sm" type="submit" name="btnPost" id="btnPost" value="Post" >
                  <input type="file" name="postPhoto" id="postPhoto" style="display:none;" onchange="document.getElementById('postPhotoValue').innerHTML=this.value;" required/>

                  <span id="postPhotoValue"></span>

              </div>

          </form>
		 </div>
        <section id="sviPostovi">


        </section>
        </div><!-- /.col-md-6 -->

<div class="col-md-1">

</div>


<!-- /.row -->
</div><!-- /.container -->
</section><!-- /.section -->

<a id="scrollup">Scroll</a>