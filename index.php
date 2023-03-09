<?php
include ("./php/server.php");
// Read
$sql = "SELECT * FROM tanaman";
$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Crud - 1303190065</title>
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="img/logo tel-u.png">
</head>
<body>
    <?php if(isset($_GET['success'])) { ?>
        <div class="success"><?php echo $_GET['success']; ?></div><br>
    <?php } ?>
    <?php if(isset($_GET['error'])) { ?>
        <div class="error"><?php echo $_GET['error']; ?></div><br>
    <?php } ?>
    <?php if(isset($_GET['warning'])) { ?>
        <div class="warning"><?php echo $_GET['warning']; ?></div><br>
    <?php } ?>
    
    <div class="container">

    <form action="php/backend.php" enctype="multipart/form-data" class="content" id="input" method="POST">
    <?php if(isset($_GET['edit'])) { ?>
        <button class="button-icon top-right" onclick="window.location.href='index.php'"><ion-icon name="close-outline"></ion-icon></button>
    <?php } ?>
        <div style="grid-column: 1 / 3">
            <center>
                <?php if(isset($_GET['edit'])) { ?>
                    <h1>E D I T _ T A N A M A N</h1>
                <?php } else { ?>
                    <h1>I N P U T _ T A N A M A N</h1>
                <?php } ?>
            </center>
        </div>

        <?php if(isset($_GET['edit'])) { ?>
            <?php $id = $_GET['edit'];
            $query = "SELECT * FROM tanaman WHERE id_tanaman='$id'";
            $res2 = mysqli_query($conn, $query);
            $row2 = mysqli_fetch_array($res2);
            ?>
        <div style="margin: 10px;">
            <label for="">Nama Tanaman</label><br>
            <input type="text" name="namatanaman" value="<?php echo $row2['nama']; ?>" placeholder="<?php echo $row2['nama']; ?>" required><br><br>
            
            <label for="">Lama Tanam</label><br>
            <input type="text" name="lamatanam" value="<?php echo $row2['lama']; ?>" placeholder="<?php echo $row2['lama']; ?>" required><br><br>

            <label for="">Tanggal Tanam</label><br>
            <input type="date" value="<?php echo $row2['tanggal']; ?>" placeholder="<?php echo $row2['tanggal']; ?>" name="tanggaltanam"><br><br>
        </div>
        <div style="margin: 10px;">
            <label for="">Hasil Panen (KG)</label><br>
            <select name="hasil" id="">
                <option value="<?php echo $row2['hasil']; ?>" selected><?php echo $row2['hasil']; ?></option>
                <option value="5">5</option>
                <OPtion value="10">10</OPtion>
                <option value="15">15</option>
                <OPtion value="20">20</OPtion>
            </select><br><br>
            <label for="">Gambar Tanaman</label><br>
            <input id="button-file" name="gambar" class="button" type="file" accept="image/*" value="<?php echo $row2['gambar']; ?>"><br><br><br>
            <input type="submit" value="Edit" class="submit" name="edit" formaction="php/backend.php?id=<?php echo $id; ?>">
        </div>
        <?php } else { ?>
        <div style="margin: 10px;">
            <label for="">Nama Tanaman</label><br>
            <input type="text" name="namatanaman" required><br><br>
            
            <label for="">Lama Tanam</label><br>
            <input type="text" name="lamatanam"  placeholder="ex: 4 bulan, 2 Minggu, 5 hari" required><br><br>

            <label for="">Tanggal Tanam</label><br>
            <input type="date" name="tanggaltanam"><br><br>
        </div>
        <div style="margin: 10px;">
            <label for="">Hasil Panen (KG)</label><br>
            <select name="hasil" id="">
                <option value="" selected>---Pilih---</option>
                <option value="5">5</option>
                <OPtion value="10">10</OPtion>
                <option value="15">15</option>
                <OPtion value="20">20</OPtion>
            </select><br><br>
            <label for="">Gambar Tanaman</label><br>
            <input id="button-file" name="gambar" class="button" type="file" accept="image/*"><br><br><br>
            <input type="submit" value="Submit" class="submit" name="submit">
        </div>
        <?php } ?>
    </form><br><br>

    <div class="content tanaman-container">
        <div style="grid-column: 1 / 3">
            <center>
                <h1>D A T A _ T A N A M A N</h1>
            </center>
        </div>

        <?php if($res->num_rows < 1) { ?>
            <div style="grid-column: 1 / 3">
            <center>
                Anda belum menambahkan Tanaman. <br>
                Silahkan menginputkan Tanaman terlebih dahulu! <br>
            </center>
            </div>
        <?php } else { ?>
            <?php while($row = mysqli_fetch_array($res)) { // Read ?>
                <div class="tanaman" style="grid-column: 1 / 3;">
                    <div class="photo">
                        <img class="gambar" src="<?php echo $row['gambar']; ?>" alt="">
                    </div>

                    <div class="section2"">
                        <button class="button-icon top-right" onclick="window.location.href='?&edit=<?php echo $row['id_tanaman']; ?>'"><ion-icon name="pencil-outline"></ion-icon></button>
                        <button class="button-icon bottom-right danger" onclick="confirm('Yakin Ingin Mengahpus Alamat?'); window.location.href='php/backend.php?delete=<?php echo $row['id_tanaman']; ?>'"><ion-icon name="trash"></ion-icon></button>
                        <label for="">Nama </label>
                        <span class="isi"><?php echo $row['nama']; ?></span> <br>

                        <label for="">Lama </label>
                        <span class="isi"><?php echo $row['lama']; ?></span> <br>

                        <label for="">Tanggal </label>
                        <span class="isi"><?php echo $row['tanggal']; ?></span> <br>

                        <label for="">Hasil </label>
                        <span class="isi"><?php echo $row['hasil']; ?> KG</span> <br>
                    </div>
                </div>
                <?php } ?>
        <?php } ?>
    </div>


    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>