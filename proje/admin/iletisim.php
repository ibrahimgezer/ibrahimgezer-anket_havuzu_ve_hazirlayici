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
                <h1 align="center">İletişim Bilgileri </h1>
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
                <label>Telefon</label>
                <input type="text" name="telefon"  id="telefon" class="form-control" />
              
                <br /><label>Mail</label>
                <input type="text" name="mail"  id="mail" class="form-control" />  <br />
                <label>Konum Kısaltma</label>
                <input type="text"   name="konum_kisaltma" id="konum_kisaltma"  class="form-control"  />
                <br />
                <label>Konum Link</label>
                <input type="text" name="konum"  id="konum" class="form-control" />
              
               
               
       <br />
       <form id="onay">
                    <label>İletişim Bilgilerinde Gösterilsin mi ?</label>
                    <label name="göster" style="visibility: hidden;">ccccccccc</label>
                    <label style="color:#c2c2c2;"><input type="radio" value="Evet" name="onay" /><span
                            style="margin-bottom:-3px; "></span> Evet</label>
                    <label name="göster" style="visibility: hidden;">ccccc</label>
                    <label style="color:#c2c2c2;"><input type="radio" value="Hayır" name="onay" /><span
                            style="margin-bottom:-3px; "></span> Hayır</label>
                </form>
          
              
                <br />
               
             </div>
           <div class="modal-footer">
                <input type="hidden" name="connect_id" id="connect_id" />
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
                url: "iletisim_action.php", //Request send to "iletisim_action.php page"
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
             $('input[name=onay]:checked', '#onay').val();  
          
           $('#telefon').val('');
           $('#konum_kisaltma').val('');
           $('#konum').val('');
           $('#mail').val('');
    
        
        
      
            $('.modal-title').text("Yeni Bilgi Ekle"); //It will change Modal title to Create new Records
            $('#action').val('Ekle'); //This will reset Button value ot Create
        });
       
        //This JQuery code is for Click on Modal action button for Create new records or Update existing records. This code will use for both Create and Update of data through modal
        $('#action').click(function () {
           // var alan =  $('input[name=alan]:checked', '#alann').val(); //Get the value of first name textbox.
            var telefon = $('#telefon').val();
            var konum_kisaltma = $('#konum_kisaltma').val();
            var mail = $('#mail').val();
            var konum = $('#konum').val();
            var onay =   $('input[name=onay]:checked', '#onay').val(); 
        
            
             //Get the value of last name textbox
            var id = $('#connect_id').val();  //Get the value of hidden field customer id
            var action = $('#action').val();  //Get the value of Modal Action button and stored into action variable
        if (telefon != null && konum_kisaltma != null && onay != null && konum != null && mail != null) //This condition will check both variable has some value
            {
                $.ajax({
                    url: "iletisim_action.php",    //Request send to "iletisim_action.php page"
                    method: "POST",     //Using of Post method for send data
                    data: {telefon: telefon, mail: mail, konum_kisaltma: konum_kisaltma, onay: onay, konum: konum, id: id, action: action}, //Send data to server
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
                url: "iletisim_action.php",   //Request send to "iletisim_action.php page"
                method: "POST",    //Using of Post method for send data
                data: { id: id, action: action },//Send data to server
                dataType: "json",   //Here we have define json data type, so server will send data in json format.
                success: function (data) {
                
                    $('#customerModal').modal('show');
                  //It will display modal on webpage
                    $('.modal-title').text("Bilgi Güncelle"); //This code will change this class text to Update records
                    $('#action').val("Güncelle");     //This code will change Button value to Update
                     //It will define value of id variable to this customer id hidden field
                    $('#connect_id').val(id);     //It will define value of id variable to this customer id hidden field
                    $('#telefon').val(data.telefon); 
                    $('#mail').val(data.mail);
                    $('#konum_kisaltma').val(data.konum_kisaltma);   //It will assign value to modal first name texbox
                     $('#konum').val(data.konum);   
                     $('#onayy').val(data.onay); 
                   
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
            if (confirm("İletişim Bilgisini Silmek istediğinize Emin Misniz?")) //Confim Box if OK then
            {
                var action = "Sil"; //Define action variable value Delete
                $.ajax({
                    url: "iletisim_action.php",    //Request send to "iletisim_action.php page"
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