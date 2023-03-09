<?php
include "server.php";

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Create
if (isset($_POST['submit'])) {
    $nama = $_POST['namatanaman'];
    $lama = $_POST['lamatanam'];
    $tanggal = $_POST['tanggaltanam'];
    $hasil = $_POST['hasil'];

    //gambar
    if (strlen($_FILES['gambar']['name'])>0) {
        $gambar = $_FILES['gambar']['name'];
        $directory = "../img/gambar/";
        $dir = "img/gambar/";
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $filter = array('jpeg', 'jpg', 'png');

        if (in_array($ext, $filter)) {
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $directory.$gambar)) {
                $sql = "INSERT INTO tanaman (nama, lama, tanggal, hasil, gambar)
                VALUES('$nama', '$lama', '$tanggal', '$hasil', '$dir$gambar')";
                mysqli_query($conn, $sql);
                header("Location: ../index.php?success=Tanaman Berhasil Ditambah");
                exit();
            } else {
                header("Location: ../index.php?error=Tanaman Tidak Berhasil Ditambah!");
                exit();
            }
        } else {
            header("Location: ../index.php?error=File harus berupa Gambar!");
            exit();
        }
    } else {
        $sql = "INSERT INTO tanaman(nama, lama, tanggal, hasil)
        VALUES('$nama', '$lama', '$tanggal', '$hasil')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../index.php?success=Tanaman Berhasil Ditambah.");
            exit();
        } else {
            header("Location: ../index.php?error=Tanaman Tidak Berhasil Ditambah!");
            exit();
        }
    }


}

// Edit
if(isset($_POST['edit'])) {
    $id = $_GET['id'];
    $nama = $_POST['namatanaman'];
    $lama = $_POST['lamatanam'];
    $tanggal = $_POST['tanggaltanam'];
    $hasil = $_POST['hasil'];

    //gambar
    if (strlen($_FILES['gambar']['name'])>0) {
        $gambar = $_FILES['gambar']['name'];
        $directory = "../img/gambar/";
        $dir = "img/gambar/";
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $filter = array('jpeg', 'jpg', 'png');
        // var_dump($_FILES);
        // die();

        if (in_array($ext, $filter)) {
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $directory.$gambar)) {
                $sql = "UPDATE tanaman
                SET nama = '$nama', lama = '$lama', tanggal = '$tanggal', hasil = '$hasil', gambar = '$dir$gambar'
                WHERE id_tanaman='$id'";
                mysqli_query($conn, $sql);
                header("Location: ../index.php?warning=Data Tanaman Berhasil Diubah");
                exit();
            } else {
                header("Location: ../index.php?error=Data Tanaman Tidak Berhasil Diubah!");
                exit();
            }
        } else {
            header("Location: ../index.php?error=File harus berupa Gambar!");
            exit();
        }
    } else {
        $sql = "UPDATE tanaman
        SET nama = '$nama', lama = '$lama', tanggal = '$tanggal', hasil = '$hasil'
        WHERE id_tanaman='$id'";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../index.php?warning=Data Tanaman Berhasil Diubah.");
        } else {
            header("Location: ../index.php?error=Data Tanaman Tidak Berhasil Diubah!");
        }
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM tanaman WHERE id_tanaman='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php?error=Tanaman Berhasil Dihapus!");
        exit();
    } else {
        header("Location: ../index.php?warning=Tanaman Belum Terhapus.");
        exit();
    }
}

header("Location: ../index.php");
?>