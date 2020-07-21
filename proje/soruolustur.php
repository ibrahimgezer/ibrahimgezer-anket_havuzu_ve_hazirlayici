<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Post a job position or create your online resume by TheJobs!">
    <meta name="keywords" content="">
    <title>Anket Merkezi</title>
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/thejobs.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link
        href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700'
        rel='stylesheet' type='text/css'>
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href="assets/img/favicon.ico">
    <style>
        @media (max-width: 1366px){
.item-block {
    width: 96%;
margin-top:25px;
    /* width: 100%; */
}}
    @media (max-width: 991px){

.item-block {
    /* margin-top: 10px; */
    width: 84%;
margin-top:15px;
}}

    </style>
</head>
<body class="nav-on-header smart-nav">

    <?php
   include("header.php");
   ?>
    <main>
        <section class=" bg-alt">
            <div class="container">
             <header class="section-header">
                    <h2>Anket Oluşturma</h2>
                </header> 
             
            
                <div class="item-block col-md-11"> 
                    <div class="item-form">                 
                        <div class="row">                        
                            <div class="form-group" style="border-bottom:1px solid; border-color: #cacaca">
                            <span class="input-group-addon" style="font-size:24px; background-color:white; border:none"> Anket Başlığı 
                            <input type="text" class="form-control " 
                              style="background-color:white;  border:none; font-size:17px;"></input></span>
                            </div>
                        </div>                
                    </div>
                </div>
                <div class="row">
                   <!-- <div class="col-xs-10 " style=" width:91%;">
                        <div class="item-block">
                            <div class="item-form">
                           
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="form-group" style="border-bottom:1px solid; border-color: #cacaca">
                                            <input type="text" class="form-control "
                                                style="background-color:white;  border:none; width:95%; font-size:17px;" placeholder="Soru Adı"></input>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group" style="border-bottom:1px solid; border-color: #cacaca">
                                                <span class="input-group-addon" style="background-color:white; border:none"><i class="fa fa-circle" style="color: #b4b4b4"></i></span>
                                                <input type="text" class="form-control col-sm-10" style="background-color:white;  border:none; width:95%; font-size:17px;"  placeholder="1.seçenek"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="dynamic_field">
                                    </div>
                                    <div class="col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <footer style="float:left;">
                                        <div class="action-btn">
                                            <a href="#"
                                            style="margin-left:0px; color:#55595c; background-color:white;  border:none; width:95%; font-size:17px;"
                                            id="add"  >
                                            Seçenek ekle</a> veya<a> "Diğer" seçeneği ekle</a><a href="sil"><i
                                                style="color:#55595c; font-size:40px; margin-top:30px; margin-right:15px" class="fa fa-minus btn-float btn-remove"></i></a>
                                        </div>
                                        </footer>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-10 duplicateable-content" style=" width:91%;">
                        <div class="item-block"> 
                            <div class="item-form">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="form-group" style="border-bottom:1px solid; border-color: #cacaca">
                                                <input type="text" class="form-control "
                                                    style="background-color:white;  border:none; width:95%; font-size:17px;" placeholder="Soru Adı"></input>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group" style="border-bottom:1px solid; border-color: #cacaca">
                                                    <span class="input-group-addon" style="background-color:white; border:none"><i class="fa fa-circle" style="color: #b4b4b4"></i></span>
                                                    <input type="text" class="form-control col-sm-10" style="background-color:white;  border:none; width:95%; font-size:17px;"  placeholder="1.seçenek"></input>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="dynamic_field">
                                        </div>                            
                                        <div class="col-xs-12 col-sm-12">
                                        <div class="form-group">
                                            <footer style="float:left;">
                                            <div class="action-btn">
                                                <a href="#"
                                                style="margin-left:0px; color:#55595c; background-color:white;  border:none; width:95%; font-size:17px;"
                                                id="add1">
                                                Seçenek ekle</a> veya<a> "Diğer" seçeneği ekle</a><a href="sil"><i
                                                    style="color:#55595c; font-size:40px; margin-top:30px; margin-right:15px" class="fa fa-minus btn-float btn-remove"></i></a>
                                            </div>
                                            </footer>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <div  id="dynamic_div" ></div>                
                        <div class=" col-md-1" style="width:1%;">
                            <br>
                            <button class="btn btn-primary  text-center" onClick="soruEkle()" style="width:11px; padding-left:15px; height:150px;"><i class="ti-plus"></i></button>
                        </div>
                </div>
            </div>
        </section>
       
    </main>
    <!-- END Main container -->

   
    <!-- Site footer -->
    <?php
      include("footer.php");
    ?>
    <!-- END Site footer -->
    

    <!-- Back to top button -->
    <a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
    <!-- END Back to top button -->

    <!-- Scripts -->
    <script src="assets/js/app.min.js"></script>
    <script src="assets/vendors/summernote/summernote.min.js"></script>
    <script src="assets/js/thejobs.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src=".//assets/style/js/jquery-3.4.1.min.js"></script>



<script>
 
  var i = 1;
  var j = 1;
  var k = 1;
  var button_id;
  var div_id

  function secenekEkle(i){
    k++;
    $('#div_row'+i).append('<div class="form-group col-xs-12 col-sm-12"  id="row' + i + '">'+
        ' <div class="input-group" style="border-bottom:1px solid; border-color: #cacaca"> <span class="input-group-addon" style="background-color:white; border:none"><i class="fa fa-circle" style="color: #b4b4b4"></i></span>' +
       ' <input type="text" class="form-control col-sm-10 " style="background-color:white;  border:none; width:95%; font-size:17px;"  id="' + j + '" name="secenek" placeholder="' + k + '.seçenek">'+
       '<a href="javascript:void(0);"  class=" btn_remove" id="' + i + '"><i style="color:#55595c; font-size:40px; margin-top:10px; margin-right:15px" class="fa fa-times btn-float btn-remove"></i></a></input></div></div></div>');
  }
  
      function soruEkle(){ 

    $('#dynamic_div').append('<div class="col-xs-10" div_row' + j + ' style=" width:91%;">' +
    '<div class="item-block"><div class="item-form " >'+
    '<div class="row"><div class="col-xs-12 col-sm-12"  id="div_row' + i + '">' +                                                                                          
    '<div class="form-group" style="border-bottom:1px solid; border-color: #cacaca">' +
    '<input type="text" class="form-control"style="background-color:white;  border:none; width:95%; font-size:17px;" placeholder="Soru Adı"></input></div>    ' +                                                                         
    '<div class="col-xs-12 col-sm-12"> <div class="form-group"><div class="input-group" style="border-bottom:1px solid; border-color: #cacaca"> ' +                                          
    '<span class="input-group-addon" style="background-color:white; border:none"><i class="fa fa-circle" style="color: #b4b4b4"></i></span>' +
    '<input type="text" class="form-control col-sm-10" style="background-color:white;  border:none; width:95%; font-size:17px;" id="' + i + '"  placeholder="1.seçenek"></input></div></div></div></div>' +                                                                               
    '<div class="col-xs-12 col-sm-12"><div class="form-group"  ><div class="col-xs-12 col-sm-12" id="dynamic_field' + j + '"></div> <footer style="float:left;">     ' +                                                                             
    '<div class="action-btn"><a href="javacript:void(0)" style="margin-left:0px; color:#55595c; background-color:white;  border:none; width:95%; font-size:17px;" ' +
    'id="add' + i + '"  onClick="secenekEkle(' + i + ');"> Seçenek ekle</a> veya<a> "Diğer" seçeneği ekle</a><i style="color:#55595c; font-size:40px; margin-top:30px; margin-right:15px"  id="' + i + '" class="btn_div fa fa-minus btn-float btn-remove"></i>' +
    '</div></footer></div></div></div></div></div> ');   
    i++;

    }
   $(document).on('click', '.btn_div', function () {
   div_id = $(this).attr("id");
  $('#div_row' + div_id + '').remove(); });

$(document).on('click', '.btn_remove', function () {
   button_id = $(this).attr("id");
  $('#row' + button_id + '').remove();
  k=button_id-1; });


</script>    


</body>

</html>