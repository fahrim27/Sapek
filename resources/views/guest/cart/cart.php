
<?php
include 'header.php'
?>

<div aria-label="breadcrumb" class="bg-light pb-2 container col-sm-9">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">BELANJAAN</li>
    </ol>
    <h2 class="pl-3" style="color: #2f9f00">BELANJAAN</h2>
</div>

<div class="container col-sm-9 bg-light pb-sm-5">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead" align="center">
            <tr>
                <th>Action</th>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Model</th>
                <th>Kuanitas</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
            </tr>
            </thead>
            <tbody align="center">
            <tr>
                <td class="align-middle">
                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button>
                    <button class="btn btn-sm btn-primary"><i class="fa fa-pen"></i> </button>
                </td>
                <td class="align-middle">
                    <img style="max-width: 120px" class="rounded"  src="image/item.jpg">
                </td>
                <td class="align-middle" >
                    <label>Capertee</label><br>
                    <label>Warna : Merah</label>
                </td>
                <td class="align-middle" >
                    <h3>Backpack</h3>
                </td>
                <td class="align-middle" >
                    <div class="wrapper">
                        <select class="form-control" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                        </select>
                    </div>
                </td>
                <td class="align-middle" >
                    <label>Rp. 450.000,-</label>
                </td>
                <td class="align-middle" >
                    <label>Rp. 450.000,-</label>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
  <div class="container row d-flex col-12">
      <div class="col-auto mr-auto">
          <div>
              <button class="btn btn-outline-success mb-4">
                  Lanjut Belanja
              </button>
          </div>
      </div>
      <div class="col-auto">
          <div class="">
              <div>
                  <label>Sub-total :</label>
                  <label>Rp. 450.000,-</label>
              </div>
              <div>
                  <h5>
                      Total :
                  </h5>
                  <h5>
                      Rp. 450.000,-
                  </h5>
              </div>
              <button class="btn btn-success mb-4">Bayar</button>
          </div>
      </div>
  </div>
</div>

<?php
include 'footer.php'
?>
