<?php zabeleziPristupStranici(); ?>
<div class="col-md-6">
    <div class="box">
        <form action="models/comments/insertComment.php" method="POST" id="unosPost" style="border: solid 1px #d8e2e7;">
            <input type="hidden" name="idPost" id="idPost" value="<?= $_GET['id']; ?>">
            <input type="hidden" name="idComm" id="idComm" value="">
            <textarea class="form-control no-border" rows="3" name="textOpis" id="textOpis" placeholder="Enter Comment"></textarea>
            <input class="btn btn-info pull-right btn-sm" type="button" name="btnComment" id="btnComment" value="Post" >
            <input class="btn btn-info pull-right btn-sm" type="button" name="btnReset" id="btnReset" value="Reset" style="margin-right: 30px">
        </form>
    </div>

    <section id="sviComments" style="margin-top: 70px;">

    </section>

</div><!-- /.col-md-6 -->

<div class="col-md-1">

</div>


<!-- /.row -->
</div><!-- /.container -->
</section><!-- /.section -->

<a id="scrollup">Scroll</a>