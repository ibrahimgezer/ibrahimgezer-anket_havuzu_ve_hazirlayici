<?php

require_once "connection.php";

if(isset($_REQUEST['ekle']))
{
	try
	{
		$adi	= $_REQUEST['adi'];
        $aciklama	= $_REQUEST['aciklama'];
        $onay	= $_REQUEST['onay'];
		$image_file	= $_FILES["resim"]["name"];
		$type		= $_FILES["resim"]["type"];
		$size		= $_FILES["resim"]["size"];
		$temp		= $_FILES["resim"]["tmp_name"];
		$path="upload/".$image_file; 
	
		
		if(empty($adi)){
			$errorMsg="Lütfen Ad Girin";
		}
		else if(empty($image_file)){
			$errorMsg="Lütfen Resim Seçiniz";
		}

        <?php
        $dizin = 'upload/';
        $yuklenecek_dosya = $dizin . basename($_FILES['dosya']['name']);
         
        if (move_uploaded_file($_FILES['dosya']['tmp_name'], $yuklenecek_dosya))
        {
            echo '<img src="tamam.jpg" width="100"><br>';
        echo "Dosya başarıyla yüklendi.<br>";
         
        } else {
            echo "Dosya yüklenemedi!\n";
        }
        ?>
		else if(strpos($type,"JPEG") || strpos($type,"JPG") || strpos($type,"PNG")|| strpos($type,"GIF")) //check file extension
		{	
	
			if(!file_exists($path)) //check file not exist in your upload folder path
			{
				if($size < 15637599) //check file size 5MB
				{
					move_uploaded_file($temp, "upload/" .$image_file); //move upload file temperory directory to your upload folder
				}
				else
				{
					$errorMsg="Dosyanız Büyük Lütfen 5MB Boyut Yükleme"; //error message file size not large than 5MB
				}
			}
			else
			{	
				$errorMsg="Dosya Zaten Var ... Yükleme Klasörünü Kontrol Et"; //error message file not exists your upload folder path
			}
		}
		else
		{
			$errorMsg="JPG, JPEG, PNG ve GIF Dosya Biçimi Yükle .. DOSYA UZATMASINI KONTROL EDİN"; //error message file extension
		}
			
		
		
	 if(!isset($errorMsg))
		{	$insert_stmt=$baglanti->prepare('INSERT INTO kayitlar (adi,aciklama,onay,resim) VALUES(:adi,:aciklama,:onay,:resim)'); //sql insert query					
			$insert_stmt->bindParam(':adi',$adi);	
			$insert_stmt->bindParam(':aciklama',$aciklama);	 
			$insert_stmt->bindParam(':onay',$onay);	
			$insert_stmt->bindParam(':resim',$image_file);	  
			if($insert_stmt->execute())
			{
				$insertMsg="Kayıt Başarıyla Eklendi ..."; 
				header("refresh:2;index.php");
			}
		}
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}

?>




<!DOCTYPE html>
<html>

<head>



    <style>
        label input {
            display: none;
            /* Hide the default checkbox */
        }

        /* Style the artificial checkbox */
        label span {
            height: 15px;
            width: 15px;
            border: 1px solid #c2c2c2;
            display: inline-block;
            position: relative;
            margin-bottom: 1px;

        }

        /* Style its checked state...with a ticked icon */
        [type=radio]:checked+span:before {
            content: '\2714';
            position: absolute;
            top: -3px;
            left: 1px;
            color: gray;

        }

        [type=radio]:checked+span:after {
            content: '\2714';
            position: absolute;
            top: -3px;
            left: 1px;
            color: gray;

        }
    </style>
</head>

<body class="boxed-page">
    <div class="container">
        <?php include("header.php"); ?>
        <section id="main-content">
            <section class=" wrapper">
                <h1 align="center">Kayıt Ekleme</h1>
                <?php
		if(isset($errorMsg))
		{
			?>
                <div class="alert alert-danger">
                    <strong>Bir sorun var ! <?php echo $errorMsg; ?></strong>
                </div>
                <?php
		}
		if(isset($insertMsg)){
		?>
                <div class="alert alert-success">
                    <strong>İşlem Tamamlandı ! <?php echo $insertMsg; ?></strong>
                </div>
                <?php
		}
		?>
                <form method="post" id="onayy" class="form-horizontal" enctype="multipart/form-data">
                    <div class="modal-body">


                        <label>Kayıt Adı</label>
                        <input type="text" name="adi" id="adi" class="form-control" />
                        <br />
                        <label>Kayıt Açıklama </label>
                        <input type="text" name="aciklama" id="aciklama" class="form-control" />
                        <br />
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="resim">Resim Seç</label>
                                <input type="file" id="resim" name="resim"
                                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"
                                    class="form-control" />
                            </div>
                            <div class="col-sm-6">
                                <label>Seçilen Resim</label>
                                <img id="blah" alt=" Seçilen Resim " class="form-control"
                                    style="width:350px; height:150px;" />
                            </div>
                        </div>

                        <br />
                        <label>Anasayfada Gösterilsin mi ?</label>

                        <label style="color:#c2c2c2;"><input type="radio" value="Evet" id="evet" name="onay" /><span
                                style="margin-bottom:-3px; "></span> Evet</label>
                        <label name="göster" style="visibility: hidden;">ccccc</label>
                        <label style="color:#c2c2c2;"><input type="radio" value="Hayır" id="hayir" name="onay" /><span
                                style="margin-bottom:-3px; "></span> Hayır</label>

                        <br />


                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="kayit_id" id="kayit_id" />
                        <input type="submit" name="ekle" id="ekle" class="btn btn-success action" />
                        <a href="index.php"> <button type="button" class="btn btn-default"
                                data-dismiss="modal">Kapat</button></a>
                    </div>
                </form>
                <!--
			<form method="post" class="form-horizontal" enctype="multipart/form-data">
					
				<div class="form-group">
				<label class="col-sm-3 control-label">Name</label>
				<div class="col-sm-6">
				<input type="text" name="txt_name" class="form-control" placeholder="enter name" />
				</div>
				</div>
					
					
				<div class="form-group">
				<label class="col-sm-3 control-label">File</label>
				<div class="col-sm-6">
				<input type="file" name="txt_file" class="form-control" />
				</div>
				</div>
					
					
				<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9 m-t-15">
				<input type="submit"  name="btn_insert" class="btn btn-success " value="Insert">
				<a href="index.php" class="btn btn-danger">Cancel</a>
				</div>
				</div>
					
			</form>
			-->
    </div>


    </section>

</body>

</html>