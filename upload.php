<?php

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
$uploadOk = 1;

//pega a extensão do arquivo
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//verifica se a imagem é real 
if(isset($_POST['submit'])) {
    $check = getimagesize($_FILES['fileToUpload']['tmp_name']); //nome do arquivo temporario, antes de upar o arquivo no server

    if($check !== false){
        echo "O arquivo é uma imagem - " . $check['mime'] . " <br>";
    }else{
        echo "O arquivo não é uma imagem! <br>";
        $uploadOk = 0;
    }
}

//verifica se o arquivo já existe na pasta 
if(file_exists($target_file)) {
    echo "Desculpe, o arquivo já existe. <br>";
    $uploadOk = 0;
}

//verifica o tamanho do arquivo 
if($_FILES['fileToUpload']['size'] > 500000) {
    echo "Desculpe, seu arquivo é muito grande. ";
    $uploadOk = 0;
}

//verifica que o arquivo é uma imagem
if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif'){
    echo "Desculpe, aceitamos apenas arquivos JPG, PNG, JPEG e GIF. <br>";
    $uploadOk = 0;
}

//verifica se a variável uploadOk está como verdadeiro ou falso (1 ou 0)
if($uploadOk === 0){
    echo "Desculpe, o seu arquivo não foi enviado para o servidor. <br>";
} else {
    //verifico se o dir existe $target_dir existe, caso contrário crio  
    if(!file_exists('uploads')){
        mkdir('uploads');
    }

    // movo o arquivo da pasta temporaria /tmp para a /uploads
    if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
        echo "O arquivo " . basename($_FILES['fileToUpload']['name']) . " foi enviado com sucesso! <br>";
    }else{
        echo "Desculpe, houve um erro! Contate o desenvolvedor o sistema. <br>";
    }
}
