<!DOCTYPE html>
<html lang="en">
<head>
<style>
label input {
  display: none; /* Hide the default checkbox */
}

/* Style the artificial checkbox */
label span {
  height: 15px;
  width: 15px;
  border: 1px solid  #c2c2c2;
  display: inline-block;
  position: relative;
  margin-bottom:1px;
  
}

/* Style its checked state...with a ticked icon */
[type=radio]:checked {
  content: '\2714';
  position: absolute;
  top: -3px;
  left: 1px;
  color:gray;
 
}  
</style></head>
<body class="boxed-page">
    <div class="container">
        <?php include("header.php"); ?>
        <section id="main-content">
            <section class=" wrapper">
                <h1 align="center">Admin Panel Kullanıcı Bilgileri </h1>
                <br />
                <div align="right">
                    <button type="button" id="modal_button" class="btn btn-info">Bilgi Ekle</button>
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
                <h4 class="modal-title">Yeni Bilgi Ekle</h4>
            </div>
            
            <div class="modal-body">
               
             
              <!--  <form id="alann">
                <label>Bilgi Alanı</label>             <label name="göster"style="visibility: hidden;">ccccc</label>
                <label style="color:#c2c2c2;"><input type="radio" value="Konum"  name="alan" /><span style="margin-bottom:-3px; " ></span> Konum</label>
                <label name="göster"style="visibility: hidden;">ccccc</label>
                <label style="color:#c2c2c2;"><input type="radio" value="Konum" name="alan"/><span style="margin-bottom:-3px; " ></span> Telefon</label>
                <label name="göster"style="visibility: hidden;">ccccc</label>
                <label style="color:#c2c2c2;"><input type="radio" value="Mail" name="alan"/><span style="margin-bottom:-3px; " ></span> Mail</label>
                </form>
                <br />-->
                <label>Ad / Soyad</label>
                <input type="text" name="adsoyad"  id="adsoyad" class="form-control" />
              
                <br /> <label>Mail</label>
                <input type="text" name="mail"  id="mail" class="form-control" />  <br />
                <label>Kullanıcı Adı</label>
                <input type="text"   name="kullanici_adi" id="kullanici_adi"  class="form-control"  />
                <br />
                <label>Şifre</label>
                <input type="text" name="sifre"  id="sifre" class="form-control" />
              
               
               
       <br />
 
               
             </div>
           <div class="modal-footer">
                <input type="hidden" name="k_id" id="k_id" />
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

<script>
    $(document).ready(function () {
        fetchUser(); //This function will load all data on web page when page load
        function fetchUser() // This function will fetch data from table and display under <div id="result">
        {
            var action = "Load";
            $.ajax({
                url: "kullanici_action.php", //Request send to "kullanici_action.php page"
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
           // $('input[name=alan]:checked', '#alann').val();  //This will clear Modal first name textbox
           $('#adsoyad').val('');
           $('#kullanici_adi').val('');
           $('#sifre').val('');
           $('#mail').val('');
            $('.modal-title').text("Yeni Bilgi Ekle"); //It will change Modal title to Create new Records
            $('#action').val('Ekle'); //This will reset Button value ot Create
        });
       
        //This JQuery code is for Click on Modal action button for Create new records or Update existing records. This code will use for both Create and Update of data through modal
        $('#action').click(function () {
           // var alan =  $('input[name=alan]:checked', '#alann').val(); //Get the value of first name textbox.
            var adsoyad = $('#adsoyad').val();
            var kullanici_adi = $('#kullanici_adi').val();
            var mail = $('#mail').val();
            var sifre = $('#sifre').val();
             //Get the value of last name textbox
            var id = $('#k_id').val();  //Get the value of hidden field customer id
            var action = $('#action').val();  //Get the value of Modal Action button and stored into action variable
        if (adsoyad != null && kullanici_adi != null  && sifre != null && mail != null) //This condition will check both variable has some value
            {
                $.ajax({
                    url: "kullanici_action.php",    //Request send to "kullanici_action.php page"
                    method: "POST",     //Using of Post method for send data
                    data: {adsoyad: adsoyad, mail: mail, kullanici_adi: kullanici_adi, sifre: sifre, id: id, action: action}, //Send data to server
                    success: function (data) {
                      //  alert(data);    //It will pop up which data it was received from server side
                        toastr.success(data);
                        fetchUser();    // Fetch User function has been called and it will load data under divison tag with id result
                    }
                });
            }
            else {
                alert("Tüm alanlar zorunludur.."); //If both or any one of the variable has no value them it will display this message
            }
        });

        //This JQuery code is for Update customer data. If we have click on any customer row update button then this code will execute
        $(document).on('click', '.update', function () {
            var id = $(this).attr("id"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
            var action = "Select";   //We have define action variable value is equal to select
            $.ajax({
                url: "kullanici_action.php",   //Request send to "kullanici_action.php page"
                method: "POST",    //Using of Post method for send data
                data: { id: id, action: action },//Send data to server
                dataType: "json",   //Here we have define json data type, so server will send data in json format.
                success: function (data) {
                
                    $('#customerModal').modal('show');
                  //It will display modal on webpage
                    $('.modal-title').text("Bilgi Güncelle"); //This code will change this class text to Update records
                    $('#action').val("Güncelle");     //This code will change Button value to Update
                     //It will define value of id variable to this customer id hidden field
                    $('#k_id').val(data.id);     //It will define value of id variable to this customer id hidden field
                    $('#adsoyad').val(data.adsoyad); 
                    $('#mail').val(data.mail);
                    $('#kullanici_adi').val(data.kullanici_adi);   //It will assign value to modal first name texbox
                     $('#sifre').val(data.sifre);   
                   
                   
                        // fetchUser() function has been called and it will load data under divison tag with id result
                        //alert(data);  //It will define value of id variable to this customer id hidden field
                  
                        //It will pop up which data it was received from server side
                   //It will assign value of modal last name textbox
                }
                
                
            });
        });
      
        //This JQuery code is for Delete customer data. If we have click on any customer row delete button then this code will execute
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
            if (confirm("Kullanıcı Bilgisini Silmek istediğinize Emin Misniz?")) //Confim Box if OK then
            {
                var action = "Sil"; //Define action variable value Delete
                $.ajax({
                    url: "kullanici_action.php",    //Request send to "kullanici_action.php page"
                    method: "POST",     //Using of Post method for send data
                    data: { id: id, action: action }, //Data send to server from ajax method
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