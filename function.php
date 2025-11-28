<?php
    $conn = mysqli_connect("localhost", "root", "", "simb");

    function query($query){
        global $conn;

        $result = mysqli_query($conn, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    function tambah_data($data){
        global $conn;

        $isbn = $data['isbn'];
        $nama_buku = $data['nama_buku'];
        $kategori = $data['kategori'];
        $nama_penulis = $data['nama_penulis'];
        $tahun_terbit = $data['tahun_terbit'];
        $gambar = $data['gambar'];
        $tanggal_input = date('Y-m-d H:i:s');

        $gambar = upload_gambar($isbn, $nama_buku);
        if(!$gambar) {
        return false;
        }

        $query = "INSERT INTO buku (isbn, nama_buku, kategori, nama_penulis, tahun_terbit, gambar, tanggal_input)
                    VALUES ('$isbn', '$nama_buku', '$kategori', '$nama_penulis', '$tahun_terbit', '$gambar', '$tanggal_input')
                    ";
         mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function hapus_data($id_buku){
        global $conn;

        $query = "DELETE FROM buku WHERE id_buku = $id_buku";
        $result = mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);    
    }

    function ubah_data($data): int|string{
        global $conn;

        $id_buku = $data['id_buku'];
        $isbn = $data['isbn'];
        $nama_buku = $data['nama_buku'];
        $kategori = $data['kategori'];
        $nama_penulis = $data['nama_penulis'];
        $tahun_terbit = $data['tahun_terbit'];
        $gambar_lama = $data['gambar_lama'];

        if($_FILES['gambar']['error'] === 4){
            $gambar = $gambar_lama;
        } else {
            $gambar = upload_gambar($isbn, $nama_buku);
            if(!$gambar){
                return false;
            }
        }

        $query = "UPDATE buku SET
                    isbn = '$isbn',
                    nama_buku = '$nama_buku',
                    kategori = '$kategori',
                    nama_penulis = '$nama_penulis',
                    tahun_terbit = '$tahun_terbit',
                    gambar = '$gambar'
                WHERE id_buku = $id_buku
                ";

        mysqli_query($conn, $query);
        return mysqli_affected_rows(mysql: $conn);
    }

    function search_data($keyword){
        global $conn;


        $query = "SELECT * FROM buku
                WHERE
                nama_buku LIKE '%$keyword%' OR
                isbn LIKE '%$keyword%' OR
                kategori LIKE '%$keyword%' OR
                nama_penulis LIKE '%$keyword%' OR
                tahun_terbit LIKE '%$keyword%' OR
                tanggal_input LIKE '%$keyword%'
                ";
        return query($query);
    }

    function upload_gambar($isbn, $nama_buku) {

        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        if( $error === 4 ) {
            echo "<script>
                    alert('Pilih gambar terlebih dahulu!');
                </script>";
            return false;
        }

        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
            echo "<script>
                    alert('yang anda upload bukan gambar!');
                </script>";
            return false;
        }

        if( $ukuranFile > 5000000 ) {
            echo "<script>
                    alert('ukuran gambar terlalu besar!');
                </script>";
            return false;
        }

        $namaFileBaru = $isbn . "_" . $nama_buku;
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

        return $namaFileBaru;
    }

    function register($data){
        global $conn;

        $username = strtolower($data['username']);
        $email = $data['email'];
        $password = mysqli_real_escape_string($conn, $data['password']);

        // query untuk ngecek username yang diinputkan oleh user di database
        $query = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
        $result = mysqli_fetch_assoc($query);

        if($result != NULL){
            return "Username sudah terdaftar!";
        }

        if(strlen($password) < 8){
            return "Password minimal 8 karakter!";
        }

        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // tambahkan userbaru ke database
        mysqli_query($conn, "INSERT INTO user (username, email, password) VALUES('$username', '$email', '$password')");

        return true;
    }

    function login($data){
        global $conn;

        $username = $data['username'];
        $password = $data['password'];

        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password'])){
                $_SESSION['login'] = true;
                $_SESSION['username'] = $row['username'];
                return true;
            } else {
            
                return "Password salah!";
            }

        }else{

            return "Username tidak terdaftar!";
            
        }
    }

?>