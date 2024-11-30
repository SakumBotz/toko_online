<?php
    require "session.php";
    require "../koneksi.php";

    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);

    $queryProduk = mysqli_query($conn, "SELECT * FROM produk");
    $jumlahProduk = mysqli_num_rows($queryProduk);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Home</title>
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
<body>
<!--navbar-->
    <?php require "navbar.php";?>
<!--break-->

<!--bread-->
    <div class="container mt-3">
    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">
        <i class="fas fa-home"></i> Home
        
    </li>
  </ol>
</nav>
<h3>hello <?php echo $_SESSION['username'];?></h3>
</div>
<!--break-->

<!--tampilan-->
        <div class="container mt-3">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12 mb-3">
            <div class="summary-kategori p-2">
            <div class="row">
                <div class="col-6">
                    <i class="fas fa-align-justify fa-7x"></i>
                </div>
                <div class="col-6 text-white">
                    <h2 class="fs-2">Kategori</h2>
                    <p class="fs-4"><?php echo $jumlahKategori;?> Kategori</p>
                    <p><a href="kategori.php" class="text-white dekorasi">Lihat Detail</a></p>
                </div> 
            </div>
        </div>
    </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3">
            <div class="produk p-2">
            <div class="row">
                <div class="col-6">
                    <i class="fas fa-box fa-7x"></i>
                </div>
                <div class="col-6 text-white">
                    <h2 class="fs-2">Produk</h2>
                    <p class="fs-4"><?php echo $jumlahProduk;?> Produk</p>
                    <p><a href="kategori.php" class="text-white dekorasi">Lihat Detail</a></p>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
    
<!--break-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
</body>
</html>