<?php
include 'header.php'
?>
<div aria-label="breadcrumb" class="bg-light pb-2 container col-sm-9">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="sapekoutdor.php">SAPEK OUTDOOR</a></li>
        <li class="breadcrumb-item active" aria-current="page">CAPERTEE</li>
    </ol>
    <h2 class="pl-3" style="color: #2f9f00">CAPERTEE</h2>
</div>

<div class="container d-flex col-sm-9 justify-content-center bg-light">
    <div class="row">
        <div class="pr-5 col-7">
            <img class="w-100" src="image/item.jpg">
        </div>
        <div class="col-5">
            <h1>CAPERTEE</h1>
            <label>Rp. 450.000</label>
            <table>
                <tbody>
                <tr>
                    <td>Stock :</td>
                    <td>Ready</td>
                </tr>
                <tr>
                    <td>Model :</td>
                    <td>BackPack</td>
                </tr>
                <tr>
                    <td>Warna :</td>
                    <td class="pt-2">
                        <select class="form-control">
                            <option value="merah">Merah</option>
                            <option value="biru">Biru</option>
                            <option value="kuning">Kuning</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Qty :</td>
                    <td class="pt-2">
                        <div class="d-flex">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-success" type="button"><b>+</b></button>
                                </div>
                                <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button"><b>-</b></button>
                                </div>
                            </div>

                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container col-sm-9 bg-light">
    <div class="col-sm-10 d-flex justify-content-end">
        <button class="btn btn-outline-success">Batal</button>
        <button class="btn btn-success ml-2">Beli</button>
    </div>
</div>
<div class="container col-sm-9 bg-light">
    <h3 style="color: #2f9f00">DESKRIPSI</h3>
    <textarea rows="15" class="form-control col-sm-8">

    </textarea>
</div>
<div class="container col-sm-9 bg-light">
    <h3 style="color: #2f9f00">Produk Sejenis</h3>
    <div class="row d-flex">
        <?php
        for ($x = 1; $x <= 2; $x++){
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
</div>


<?php
include 'footer.php'
?>
