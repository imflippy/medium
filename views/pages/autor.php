
<?php
zabeleziPristupStranici();
?>


<div class="row">
    <div class="col-md-2 col-lg-2"></div>
    <div class="card col-sm-12 col-md-8 col-lg-8">
        <div class="card-header card-header-info">
            <h4 class="card-title">Author's details</h4>
        </div>
        <div class="card-body table-responsive">
            <table class="flat-table flat-table-3">
                <!--                <thead>-->
                <!--                    <th>Page</th>-->
                <!--                    <th>%</th>-->
                <!--                </thead>-->
                <tbody><tr>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Birthday</td>
                    <td>Faculty</td>
                    <td>ID</td>
                    <td>Born</td>

                </tr>
                <tr>
                    <?php
                    $podaci = autor();
                        ?>

                        <td><?= $podaci->ime; ?></td>
                        <td><?= $podaci->prezime; ?></td>
                       <td><?= $podaci->datum; ?></td>
                      <td><?= $podaci->skola; ?></td>
                        <td><?= $podaci->index; ?></td>
                        <td><?= $podaci->mesto; ?></td>
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
            <h4 class="card-title">Author's Photo</h4>
        </div>
        <div class="card-body table-responsive">
            <img src="<?= $podaci->slika; ?>" alt="<?= $podaci->ime; ?>" >

        </div>
    </div>
    <div class="col-md-2 col-lg-2"></div>
</div>
