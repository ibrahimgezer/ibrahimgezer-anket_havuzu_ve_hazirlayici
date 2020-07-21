

<!DOCTYPE html>
<html lang="en">

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
                <h1 align="center">Hakkımızda Özelleştirme Sayfası</h1>
                <br />
                <div align="right">
                    <button type="button" id="modal_button" class="btn btn-info">İçerik Ekle</button>
                </div>
                <br />
                <div id="result" class="table-responsive"> </div>

            </section>
        </section>
        <!--main content end-->
        <!--footer start-->
        <?php include("footer.php"); ?>
    </div>
</body>

</html>
<!-- Açılır kayıt ekleme modalları  -->
<div id="customerModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Yeni İçerik Ekle</h4>
            </div>
            <div class="modal-body">
           
                <label>İçerik Başlığı</label>
                <input type="text" name="baslik" id="baslik" class="form-control" />
                <br />
                <label>İçerik</label>
                <input type="text" name="icerik" id="icerik" class="form-control" />
                <br />
                <form id="onayy">
                <form method="post"  action="upload.php" class="form-horizontal" enctype="multipart/form-data">
                <label>Hakkımızda Modül'ünde Gösterilsin mi ?</label>
                <label name="göster" style="visibility: hidden;">ccccc</label>
                    <label style="color:#c2c2c2;"><input type="radio" value="Evet" name="onay" /><span
                            style="margin-bottom:-3px; "></span> Evet</label>
                    <label name="göster" style="visibility: hidden;">ccccc</label>
                    <label style="color:#c2c2c2;"><input type="radio" value="Hayır" name="onay" /><span
                            style="margin-bottom:-3px; "></span> Hayır</label>
         </form>
                <br />
                <label>Geliştirici İsmi</label>
                <input type="text" name="g_isim" id="g_isim" class="form-control" />
                <br />
                <label>Geliştirici Görevi</label>
                <input type="text" name="g_gorev" id="g_gorev" class="form-control" />
                <br />
                <form  id="onay" >
                <div class="row"><!--onchange="javascript:uploadFile()" -->
                            <div class="col-sm-6">
                                <label for="resim">Geliştirici Resmi </label>
                                <input type="file" id="g_resim" name="g_resim" value=""
                                onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"
                                    class="form-control" />
                            </div>
                            <div class="col-sm-6">
                                <label>Seçilen Resim</label>
                                <img id="blah" alt=" Seçilen Resim " class="form-control"
                                    style="width:250px; height:150px;" />
                            </div>
                        </div>
              
                </form>
                <br />
                <form id="g_onayy">
                    <label>Geliştiriciler Arasında Gösterilsin mi ?</label>
                    <label name="göster" style="visibility: hidden;">ccccccccc</label>
                    <label style="color:#c2c2c2;"><input type="radio" value="Evet" name="g_onay" /><span
                            style="margin-bottom:-3px; "></span> Evet</label>
                    <label name="göster" style="visibility: hidden;">ccccc</label>
                    <label style="color:#c2c2c2;"><input type="radio" value="Hayır" name="g_onay" /><span
                            style="margin-bottom:-3px; "></span> Hayır</label>
                </form>
          
          
               

            </div>
            <div class="modal-footer">
                <input type="hidden" name="hakkimizda_id" id="hakkimizda_id" />
                <input type="hidden" name="team_id" id="team_id" />
                <input type="submit" name="action" id="action" class="btn btn-success" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>
<div id="customerModal1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Durum</h4>
            </div>
            <div class="modal-body">
                <label id="durum"></label>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>
<!--
    <script>
function uploadFile() {
        var fd = new FormData();
        var files = $('#g_resim')[0].files[0];
        fd.append('g_resim',files);
        $.ajax({
            url:'hakkimizda_action.php',
            type:'post',
            data:fd,
            contentType: false,
            processData: false,
         
        });
}</script>
-->
<script type="text/javascript">

$(document).ready(function(){

    $('#action').click(function () {

        var fd = new FormData();

        var files = $('#g_resim')[0].files[0];
        fd.append('g_resim',files);

        $.ajax({
            url:'upload.php',
            type:'post',
            data:fd,
            contentType: false,
            processData: false,
         
        });
    });
});


</script>
<script>
    $(document).ready(function () {
        fetchUser(); //This function will load all data on web page when page load
        function fetchUser() // This function will fetch data from table and display under <div id="result">
        {
            var action = "Load";
            $.ajax({
                url: "hakkimizda_action.php", //Request send to "iletisim_action.php page"
                method: "POST", //Using of Post method for send data
                data: { action: action }, //action variable data has been send to server
                success: function (data) {
                    $('#result').html(data); //It will display data under div tag with id result
                }
            });
        }

        //This JQuery code will Reset value of Modal item when modal will load for create new records
        $('#modal_button').click(function () {
            $('#customerModal').modal('show'); //It will load modal on web page
            $('#baslik').val('');  //This will clear Modal first name textbox
            $('#icerik').val('');
            $('#g_isim').val('');
            $('#g_gorev').val('');
            $('#g_resim').val('');          
            $('input[name=onay]:checked', '#onayy').val(); 
           $('input[name=g_onay]:checked', '#g_onayy').val(); 
            $('.modal-title').text("Yeni İçerik Ekle"); //It will change Modal title to Create new Records
            $('#action').val('Ekle');
      //This will reset Button value ot Create
        });
    
        //This JQuery code is for Click on Modal action button for Create new records or Update existing records. This code will use for both Create and Update of data through modal
        $('#action').click(function () {
            var baslik = $('#baslik').val(); //Get the value of first name textbox.
            var icerik = $('#icerik').val();
            var g_isim = $('#g_isim').val();
            var g_gorev = $('#g_gorev').val();
            
            var g_resim = $('#g_resim').val().replace(/C:\\fakepath\\/, '');
            var onay =$('input[name=onay]:checked','#onayy').val(); 
            var g_onay =$('input[name=g_onay]:checked','#g_onayy').val(); 
        
            var id = $('#hakkimizda_id').val(); 
            var takim_id = $('#team_id').val(); 
            var action = $('#action').val(); 
        
            if (baslik != null && icerik != null && g_isim != null && g_gorev != null && g_resim != null && onay != null && g_onay != null) //This condition will check both variable has some value
            {
                
                $.ajax({
                    url: "hakkimizda_action.php",  
                    method: "POST",  
                   
                     
                    data: { baslik: baslik , icerik: icerik, g_isim: g_isim, g_gorev: g_gorev, g_resim: g_resim, onay: onay, g_onay: g_onay ,id: id,takim_id: takim_id,  action: action}, //Send data to server
          
                    success: function (data) {
                     
  
    
                        //  alert(data);   
                        toastr.success(data);
                        fetchUser(); 
                    }
                });
                
            }
            else {
                alert("Tüm alanlar zorunludur.."); 
            }
           
        });
       
       
        $(document).on('click', '.update', function () {
            var id = $(this).attr("id"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
            var action = "Select";   //We have define action variable value is equal to select
            $.ajax({
                url: "hakkimizda_action.php",   //Request send to "iletisim_action.php page"
                method: "POST",    //Using of Post method for send data
                data: { id: id, action: action },//Send data to server
                dataType: "json",   //Here we have define json data type, so server will send data in json format.
                success: function (data) {

                    $('#customerModal').modal('show');
                    //It will display modal on webpage
                    $('.modal-title').text("İçerik Güncelle"); //This code will change this class text to Update records
                    $('#action').val("Güncelle");     //This code will change Button value to Update
                    //It will define value of id variable to this customer id hidden field
                    $('#hakkimizda_id').val(id); 
                    //It will define value of id variable to this customer id hidden field
                    $('#baslik').val(data.baslik);
                    $('#icerik').val(data.icerik);
                    $('#g_gorev').val(data.g_gorev);
                    $('#g_isim').val(data.g_isim);
                    $('#g_resim').val(data.g_resim);
                    $('#onayy').val(data.onay);
                    $('#g_onayy').val(data.g_onay);
           
                }


            });
            $('#customerModal').modal('hide');
        });

      
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
            if (confirm("İçeriği  Silmek istediğinize Emin Misniz?")) //Confim Box if OK then
            {
                var action = "Sil"; //Define action variable value Delete
                $.ajax({
                    url: "hakkimizda_action.php",    //Request send to "iletisim_action.php page"
                    method: "POST",     //Using of Post method for send data
                    data: { id: id,  action: action }, //Data send to server from ajax method
                    success: function (data) {
                        toastr.error(data);
                        fetchUser();    // fetchUser() function has been called and it will load data under divison tag with id result
                        //alert(data);  //It will define value of id variable to this customer id hidden field

                        //It will pop up which data it was received from server side
                    }
                })
            }
            else  //Confim Box if cancel then 
            {
                return false; //No action will perform
            }
        });
    });
</script>
