<?php
// error_reporting(0);
// extract($_POST);
$bunga = (float) 0.03;
if (isset($_POST['submit'])) {
    $harga = $_POST['harga'];
    $dp = $_POST['dp'];
    $bulan = $_POST['bulan'];
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kredit Motor</title>
    <link rel="stylesheet" href="/CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<body style="background-color:whitesmoke; padding: 50px;">
    <h1 style="margin-bottom: 35px;">Simulasi Kredit Motor</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <label for="harga">harga motor :</label>
        <input type="number" name="harga" id="harga"><br><br>
        <label for="dp">bayar pertama / DP minimal 20% :</label>
        <input type="number" id="dp" name="dp" min="0" step="100000"><br><br>
        <label for="">Bulan :</label> <select name="bulan" id="">
            <option value="12">12 bulan</option>
            <option value="24">24 bulan</option>
            <option value="36">36 bulan</option>
        </select><br><br>
        <label for="">bunga :</label>
        <input type="hidden" name="bunga">0.03<br><br>
        <button style="margin-bottom: 25px;" type="submit" name="submit" class="btn btn-info">cek simulasi kredit</button>
    </form>
    <table class="table table-bordered border-dark" style="height: auto; width: 500px;">
    <thead>
        <tr>
        <th scope="col">Bulan</th>
        <th scope="col">Cicilan</th>
        <th scope="col">Terbayar</th>
        <th scope="col">Kurang</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $terhutang = $harga - $dp;
        $terbayar = 0;
        $kurang = $harga - $dp;
        $bungaKredit = ($bunga/100) * $terhutang / $bulan;
        $cicilanPerbulan = ($terhutang / $bulan) + $bungaKredit;
        for($i=1; $i<=$bulan; $i++) {
            $terbayar += $cicilanPerbulan;
            $kurang -= $cicilanPerbulan;
        ?>
        <tr>
        <th scope="row"><?php echo $i?></th>
        <td><?php echo round($cicilanPerbulan)?></td>
        <td><?php echo round($terbayar)?></td>
        <td><?php echo round($kurang)?></td>
        </tr>
        <?php }?>
        
    </tbody>
    </table>

    <!-- minimal DP 20% -->
    <script>
    var hargaInput = document.getElementById("harga");
    var dpInput = document.getElementById("dp");
    hargaInput.addEventListener("input", function() {
        var harga = parseInt(hargaInput.value);
        var minDp = Math.ceil(harga * 0.2 / 200000) * 200000;
        dpInput.min = minDp;
        dpInput.value = minDp;
        if (parseInt(dpInput.value) < minDp) {
            dpInput.value = minDp;
        }
    });
    </script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>
