<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Rina | Tentang Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .baner-produk2 {
            height: 40vh;
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('foto/baner.jpg');
            background-size: cover;
            color: white;
            animation: fadeIn 2s ease;
}
    </style>
</head>
<body>
    <?php require "navbar.php"; ?>
    <!-- Banner -->
    <div class="baner-produk2 container-fluid d-flex align-items-center">
        <div class="container text-center">
            <h1 class="display-4 fw-bold text-white">Tentang Kami</h1>
        </div>
    </div>

    <!-- Text -->
     <div class="container-fluid py-4">
        <div class="container fs-5 text-center">
            <p>Selamat datang di Toko Rina! Kami adalah toko terpercaya yang berdedikasi menyediakan produk berkualitas dengan harga yang terjangkau bagi seluruh pelanggan kami. Sejak didirikan, Toko Rina telah berkomitmen untuk memberikan pengalaman belanja yang nyaman dan memuaskan, dengan berbagai pilihan produk yang dapat memenuhi kebutuhan sehari-hari Anda.</p>
            <p>Di Toko Rina, kepuasan pelanggan adalah prioritas utama kami. Dengan layanan yang ramah, produk yang beragam, serta tim yang selalu siap membantu, kami berusaha untuk menjadi toko pilihan Anda. Kami percaya bahwa belanja seharusnya mudah, menyenangkan, dan dapat dipercaya. Itulah sebabnya kami selalu berupaya menjaga kualitas, keaslian, dan ketersediaan produk agar Anda mendapatkan yang terbaik.</p>
            <p>Terima kasih telah menjadi bagian dari keluarga Toko Rina. Kami berharap bisa terus melayani Anda dan menjadi bagian dari keseharian Anda. Selamat berbelanja!

</p>
        </div>
     </div>

     <!-- footer -->
    <?php require "footer.php"; ?>

    <!-- JavaScript Bootstrap & FontAwesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
</body>
</html>