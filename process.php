<?php
    $conn = new mysqli("localhost", "root","", "task");
    if($conn->connect_error){
        die("Connection Failed".$conn->connect_error);

    }

    $result = array('error'=>false);
    $action = '';
    if(isset($_GET['action'])){
        $action = $_GET['action'];

    }

    if($action == 'read'){
        $sql = $conn->query("SELECT * FROM tugas");
        $tugas = array();
        while($row = $sql->fetch_assoc()){
            array_push($tugas, $row);
        }
        $result['tugas'] = $tugas;
    }

    if($action == 'create'){
        $nama_tugas = $_POST['nama_tugas'];
        $mata_pelajaran = $_POST['mata_pelajaran'];
        $batas_waktu = $_POST['batas_waktu'];
        $kondisi_sekarang = $_POST['kondisi_sekarang'];
        

        $sql = $conn->query("INSERT INTO tugas (nama_tugas, mata_pelajaran, batas_waktu, kondisi_sekarang) VALUES ('$nama_tugas', '$mata_pelajaran', '$batas_waktu', '$kondisi_sekarang')");
        
        if($sql){
            $result['message'] = "Tugas sudah ditambahkan";
        }
        else{
            $result['error'] = true;
            $result['message'] = "gagal ditambahkan";      
        }
    }

    if($action == 'update'){
        $id = $_POST['id'];
        $nama_tugas = $_POST['nama_tugas'];
        $mata_pelajaran = $_POST['mata_pelajaran'];
        $batas_waktu = $_POST['batas_waktu'];
        $kondisi_sekarang = $_POST['kondisi_sekarang'];
        

        $sql = $conn->query("UPDATE tugas SET nama_tugas='$nama_tugas', mata_pelajaran='$mata_pelajaran', batas_waktu='$batas_waktu', kondisi_sekarang='$kondisi_sekarang' WHERE id='$id' " ); 
        
        if($sql){
            $result['message'] = "Tugas sudah diperbarui";
        }
        else{
            $result['error'] = true;
            $result['message'] = "gagal diperbarui";      
        }
    }

    if($action == 'delete'){
        $id = $_POST['id'];
      
        $sql = $conn->query("DELETE FROM tugas WHERE id='$id' "); 
        
        if($sql){
            $result['message'] = "Tugas sudah dihapus";
        }
        else{
            $result['error'] = true;
            $result['message'] = "Tugas gagal dihapus";      
        }
    }
    echo json_encode($result);
?>