<?php
    require "koneksi.php";

    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

    //get produk by nama kategori/keyword
    if(isset($_GET['keyword'])){
        $queryProduk = mysqli_query($conn,"SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
    }
    //get produk by kategori
    else if(isset($_GET['kategori'])){
        $queryGetKategoriId = mysqli_query($conn,"SELECT id FROM kategori WHERE nama='$_GET[kategori]'");
        $kategoriId = mysqli_fetch_array($queryGetKategoriId);
        $queryProduk = mysqli_query($conn,"SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
    }

    // get produk default
    else{
        $queryProduk = mysqli_query($conn,"SELECT * FROM produk");
    }
    $countData = mysqli_num_rows($queryProduk);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Toko Rina | Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .list-group a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php require "navbar.php"; ?>


    <!-- Banner -->
<div class="baner-produk container-fluid d-flex align-items-center">
    <div class="container text-center">
        <h1 class="display-4 fw-bold text-white">Toko Rina Produk</h1>
    </div>
</div>
    <!-- layout1 -->
     <div class="container py-5">
        <div class="row">
        <div class="col-lg-3 mb-5">
            <h3>Kategori</h3>
        <ul class="list-group">
            <?php while($kategori = mysqli_fetch_array($queryKategori)){ ?>
                <a href="produk.php?kategori=<?php echo $kategori['nama']; ?>">
                 <li class="list-group-item"><?php echo $kategori['nama']; ?></li>
                </a>
            <?php } ?>
            </ul>
        </div>
        <div class="col-lg-9">
            <h3 class="text-center mb-3">Produk</h3>
            <div class="row">
                <?php
                if($countData<1){
                    ?>
                    <div class="alert alert-danger my-3" role="alert">
                    Produk yang anda cari tidak tersedia!</div>
                    <?php
                }
                ?>
            <?php while($data = mysqli_fetch_array($queryProduk)){ ?>
                    <div class="col-md-3 mb-4">
                        <div class="card product-card h-100">
                            <img src="<?php echo $data['foto']; ?>" class="card-img-top" alt="<?php echo $data['nama']; ?>">
                            <div class="card-body">
                                <h6 class="card-title"><?php echo $data['nama']; ?></h6>
                                <p class="card-text"><?php echo $data['detail']; ?></p>
                                <p class="card-text">Rp. <?php echo number_format($data['harga'], 0, ',', '.'); ?></p>
                                <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn btn-primary mt-auto">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
     </div>
    </div>
    
    <?php require "footer.php" ?>

    <!-- JavaScript Bootstrap & FontAwesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</body>
</html>