<?php
require 'header.php'
?>

    <div aria-label="breadcrumb" class="bg-light pb-2 container col-sm-9">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">SAPEK  ADVENTURE</li>
        </ol>
        <h2 class="pl-3" style="color: #2f9f00">SAPEK ADVENTURE</h2>
    </div>

<div class="container col-sm-9 ">
    <hr style="border-width: 5px; border-color: white;">
    <div class="row d-flex justify-content-center">
        <?php
        for ($x = 1; $x <= 4; $x++){
            ?>
            <div class="card text-center m-3" style="width: 300px">
                <div class="card-img-top">
                    <img class="w-100" src="image/paket.png">
                </div>
                <div class="card-body">
                    <label>
                        <b>Paket
                        <?php
                        echo "$x";
                        ?>
                        </b>
                    </label><br>
                    <label>Rp.410.000</label><br>
                    <label style="color: #2f9f00; font-size: small;">Empty Stock</label><br>
                    <hr>
                    <button class="btn btn-sm w-100 btn-success">Beli</button>
                    <br>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <hr class="mt-sm-5" style="border-width: 5px; border-color: white;">
</div>

    <div class="container col-sm-9 ">
        <div class="row d-flex justify-content-center">
            <?php
            for ($x = 1; $x <= 10; $x++){
                ?>
                <div class="card col-sm-2 text-center m-3">
                    <div class="card-img-top">
                        <img class="w-100" src="image/item.jpg">
                    </div>
                    <div class="card-body">
                        <label>
                            <b>barang no
                                <?php
                                echo "$x";
                                ?>
                            </b>
                        </label><br>
                        <label>Rp.410.000</label><br>
                        <label style="color: #2f9f00; font-size: small;">Ready Stock</label><br>
                        <hr>
                        <button class="btn btn-sm w-100 btn-success">Beli</button>
                        <br>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <hr class="mt-sm-5" style="border-width: 5px; border-color: white;">

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

<?php
require 'footer.php'
?>