<?php
    require "koneksi.php";

    $nama = htmlspecialchars($_GET["nama"]);
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama='$nama'");
    $produk = mysqli_fetch_array($queryProduk);

    $queryProdukTerkait = mysqli_query($conn,"SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]' AND id!='$produk[id]'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Rina | Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .baner-produk2 {
    height: 40vh;
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('../foto/baner.jpg');
    background-size: cover;
    color: white;
    animation: fadeIn 2s ease;
}
    </style>
</head>
<body>
<?php
// Fungsi untuk membuat slug dari string
function buatSlug($string) {
    $string = strtolower(trim($string));
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
    $string = preg_replace('/[\s-]+/', ' ', $string);
    $string = str_replace(' ', '-', $string);
    return $string;
}
?>
    <!-- Navbar -->
    <?php require "navbar.php"; ?>
        <!-- detail produk -->
         <div class="container-fluid py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 mb-4">
                        <img src="foto/<?php echo $data['foto']; ?>" class="w-100" alt="">
                    </div>
                    <div class="col-lg-6 offset-lg-1">
                        <h1><?php echo $produk['nama']; ?></h1>
                        <p class="fs-5">
                        <?php echo $produk['detail']; ?>
                        </p>
                        <p class="fs-4 text-merah-terang">
                            Rp. <?php echo $produk['harga']; ?>
                        </p>
                        <p class="fs-5">
                            Status Ketersediaan: <strong><?php echo $produk['ketersediaan_stok']; ?></strong>
                        </p>
                        <a href="https//wa.me/6285183480659" class="btn btn-primary">Beli Sekarang</a>
                    </div>
                </div>
            </div>
         </div>

         <!-- produk terkait -->
          <div class="container-fluid py-5 warna19">
            <div class="container">
                <h2 class="text-center text-white mb-3">Produk Terkait</h2>
                <div class="row">
                <?php while($data = mysqli_fetch_array($queryProdukTerkait)){ ?>
                    <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>">
                    <div class="col-lg-3 mb-3">
                        <img src="foto/<?php echo $data['foto']; ?>" alt="" class="img-fluid img-thumbnail produk-detail-image">
                    </div>
                    </a>
                    <?php } ?>
                </div>
            </div>
          </div>

          <!-- footer -->
           <?php require "footer.php" ?>
<!-- Script js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
</body>
</html>