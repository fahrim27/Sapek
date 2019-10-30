<?php
require 'header.php'
?>
    <div class="container col-10 pt-4">
        <div id="carouselExampleIndicators" class="carousel slide pb-5" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="image/1.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="image/2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="image/3.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="container col-12 bg-light">
        <h1 style="color: #2f9f00" align="center" class="pt-5">Layanan Kami</h1>
        <div class="d-flex">
            <div class="row justify-content-center p-4">
                    <div class="card-img col-sm-3 pb-5 m-sm-5">
                        <a href="adventure.php"><img class="w-100" src="image/adventure.png"></a>
                    </div>
                    <div class="card-img col-sm-3 pb-5 m-sm-5">
                        <img class="w-100" src="image/card.png">
                    </div>
                    <div class="card-img col-sm-3 pb-5 m-sm-5">
                        <img class="w-100" src="image/card.png">
                    </div>
                    <div class="card-img col-sm-3 pb-5 m-sm-5">
                        <img class="w-100" src="image/card.png">
                    </div>
                    <div class="card-img col-sm-3 pb-5 m-sm-5">
                        <img class="w-100" src="image/card.png">
                    </div>
                    <div class="card-img col-sm-3 pb-5 m-sm-5">
                        <img class="w-100" src="image/card.png">
                    </div>
            </div>
        </div>
    </div>

<?php
require 'footer.php'
?>