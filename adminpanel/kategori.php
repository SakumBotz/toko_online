<?php
    require "session.php";
    require "../koneksi.php";

    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Kategori</title>
    <style>
        .kotak {
            border: solid;
        }
        .summary-kategori {
            background-color: #00b4d8;
            border-radius: 10px;
        }
        .produk {
            background-color: #ffb703;
            border-radius: 10px;
        }
        .dekorasi{
            text-decoration: none;
        }
    </style>
</head>
    <!--navbar-->
    <?php require "navbar.php";?>
    <!--break-->

    <!--bread-->
    <div class="container mt-3">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">
        <a href="../adminpanel" class="dekorasi text-muted">
            <i class="fas fa-home"></i> Home
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
         Kategori
        
    </li>
  </ol>
</nav>
    <!--Break-->
        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Kategori</h3>
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" id="kategori" name="kategori" placeholder="input nama kategori" class="form-control" autocomplete="off">
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="simpan-kategori">Simpan</button>
                </div>
            </form>
            
            
            <?php
             if(isset($_POST["simpan-kategori"])){
                $kategori = htmlspecialchars($_POST["kategori"]);
                $queryPengecekan = mysqli_query($conn,"SELECT * FROM kategori WHERE nama='$kategori'");
                $jumlahDataKategoriBaru = mysqli_num_rows($queryPengecekan);

                if($jumlahDataKategoriBaru > 0){
            ?>
                    <div class="alert alert-warning mt-3" role="alert">
                    Kategori Sudah Tersedia
            <?php
             }
             else{
                $querySimpan = mysqli_query( $conn,"INSERT INTO kategori (nama) VALUES ('$kategori')");
                if($querySimpan){
                    ?>
                    <div class="alert alert-primary mt-3" role="alert">
                    Sukses Menambahkan Kategori</div>
                    <meta http-equiv="refresh" content="0" url="kategori.php"/>
                    <?php
                }
                else {
                    echo mysqli_error($conn);
                }
             }
            }
             ?>
            </div>
        </div>
    <!--Break-->

    <!--List Kategori-->
    <div class="container">
        <div class="mt-3">
            <h2>List Kategori</h2>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($jumlahKategori==0) {
                            ?>
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data Kategori</td>
                            </tr>
                            <?php
                        }
                            else{
                                $number = 1;
                                while($data=mysqli_fetch_array($queryKategori)){
                ?>
                                <tr>
                                    <td><?php echo $number; ?></td>
                                    <td><?php echo $data['nama'];?></td>
                                    <td>
                                        <a href="kategori-detail.php?d=<?php echo $data['id'];?>" class="btn btn-info"><i class="fas fa-search"></i></a>
                                    </td>
                                </tr>
                <?php
                            $number++;
                            }
                        }
                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--break-->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
</body>
</body>
</html>