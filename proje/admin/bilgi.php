<?php

require_once "baglan.php";

if(isset($_REQUEST['ekle']))
{
   
	try
	{
		$baslik	= $_REQUEST['baslik'];
        $icerik	= $_REQUEST['icerik'];
        $onay	= $_REQUEST['onay'];
        $path="upload/"; 
        $fileName = basename($_FILES["resim"]["name"]); 
        $targetFilePath = $path . $fileName; 
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
         
       
        
        if(empty($baslik)){
            $errorMsg="Lütfen Ad Girin";
        }
        else if(empty($icerik)){
            $errorMsg="Lütfen Açıkklama Seçiniz";
        }
        if(empty($onay)){
            $errorMsg="Lütfen Onay Bloğunu İşaretleyiniz ";
        }
        else if(empty($fileName)){
            $errorMsg="Lütfen Resim Seçiniz";
        }
     
        
        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg'); 
 if(in_array($fileType, $allowTypes)){ 
    if(!file_exists($targetFilePath)) //check file not exist in your upload folder path
    {
            // Upload file to the server 
            if(move_uploaded_file($_FILES["resim"]["tmp_name"], $targetFilePath)){ 
                $uploadedFile = $fileName; 
            }else{ 
                $uploadStatus = 0; 
                $errorMsg= '    Maalesef, dosyanız yüklenirken bir hata oluştu.'; 
            } 
         }
         else
        {	
            $errorMsg="Dosya Zaten Var . Yükleme Klasörünü Kontrol Et (Dosya ismini Değiştirip Yükleyebilirsiniz)"; //error message file not exists your upload folder path
        }
        }else{ 
            $uploadStatus = 0; 
            $errorMsg= 'Maalesef, yalnızca JPG, JPEG ve PNG dosyalarının yüklenmesine izin verilir.'; 
        } 
		
	 if(!isset($errorMsg))
		{	$insert_stmt=$baglanti->prepare('INSERT INTO kayitlar (baslik,icerik,onay,resim) VALUES(:baslik,:icerik,:onay,:resim)'); //sql insert query					
			$insert_stmt->bindParam(':baslik',$baslik);	
			$insert_stmt->bindParam(':icerik',$icerik);	 
			$insert_stmt->bindParam(':onay',$onay);	
			$insert_stmt->bindParam(':resim',$fileName);	  
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
        [type=rbasliko]:checked+span:before {
            content: '\2714';
            position: absolute;
            top: -3px;
            left: 1px;
            color: gray;

        }

        [type=rbasliko]:checked+span:after {
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
                <h1 align="center">Sistem Çalışması Hakkında Bilgi Ekleme</h1>
                <?php
		if(isset($errorMsg))
		{
			?>
                <div class="alert alert-danger">
                    <strong> <?php echo $errorMsg; ?></strong>
                </div>
                <?php
		}
		if(isset($insertMsg)){
		?>
                <div class="alert alert-success">
                    <strong><?php echo $insertMsg; ?></strong>
                </div>
                <?php
		}
		?>
                <form method="post" id="onayy" class="form-horizontal" enctype="multipart/form-data">
                    <div class="modal-body">


                        <label>Kayıt Adı</label>
                        <input type="text" name="baslik" id="baslik" class="form-control" />
                        <br />
                        <label>Kayıt Açıklama </label>
                        <input type="text" name="icerik" id="icerik" class="form-control" />
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
                        <label>Anasayfa'da Gösterilsin mi ?</label>

                        <label style="color:#c2c2c2;"><input type="rbasliko" value="Evet" id="evet" name="onay" /><span
                                style="margin-bottom:-3px; "></span> Evet</label>
                        <label name="göster" style="visibility: hidden;">ccccc</label>
                        <label style="color:#c2c2c2;"><input type="rbasliko" value="Hayır" id="hayir" name="onay" /><span
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
				<input type="file" name="resim" class="form-control" />
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
  <?php include("footer.php"); ?>
</body>

</html>