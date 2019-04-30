<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    
   <style type="text/css">
   .custom {
    width: 70px ;
}
     .gradient-text{
                font-size: 30px;
        background: -webkit-linear-gradient(#eee, #0000ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
            }

</style>
 <script type="text/javascript">
            <!--
                function toggle_visibility(id) {
                   var e = document.getElementById(id);
                   if(e.style.display == 'block')
                      e.style.display = 'none';
                   else
                      e.style.display = 'block';
                }
            //-->
        </script>  

     <style type="text/css">

            #popupBoxOnePosition{
                top: 0; left: 0; position: fixed; width: 100%; height: 120%;
                background-color: rgba(0,0,0,0.7); display: none;
            }
            .popupBoxWrapper{
                 width: 450px; margin: 200px auto; position: center; text-align: left; 
            }
            .popupBoxContent{
                background-color: #ffffff; padding: 15px;
            }

    </style> 
<style>
#ct4 {
  font-size:18px;
  font-family:  Arial;
}
</style>
    <script type="text/javascript">
      var global_dt_alarm_sec=0; // global variable to store Alarm value in Seconds
function update_alarm(type,direction) {
switch(type){
case "h":
var h =parseInt(document.getElementById('h1').value);
if(direction =='up' && h < 24){
h=h+1;}
if(direction =='down' && h >0){
h=h-1;}
if(h >24){h=24;}
if(h <0){h=0;}

h=h.toString();
if(h.length < 2){
var h='0'+h;
}
document.getElementById('h1').value =  h;
break;

case "m":
var m =parseInt(document.getElementById('m1').value);
if(direction =='up' && m < 59){
m=m+1;}
if(direction =='down' && m >0){
m=m-1;}
if(m >59){m=59;}
if(m <0){m=0;}
m=m.toString();
if(m.length < 2){
var m='0'+m;
}
document.getElementById('m1').value =  m;

break;

case "s":
var s =parseInt(document.getElementById('s1').value);
if(direction =='up' && s < 59){
s=s+1;}
if(direction =='down' && s >0){
s=s-1;}
if(s >59){s=59;}
if(s <0){s=0;}

s=s.toString();
if(s.length < 2){
var s='0'+s;
}
document.getElementById('s1').value =  s;
break;
} // end of switch
document.getElementById('ct3').style.fontSize='15px';
document.getElementById('ct3').style.color='#ffffff';
document.getElementById('ct3').innerHTML = document.getElementById('h1').value + ':' + document.getElementById('m1').value + ':' + document.getElementById('s1').value;
 }
function set_alarm(){
var dt_alarm= new Date();
dt_alarm.setHours(parseInt(document.getElementById('h1').value));
dt_alarm.setMinutes(parseInt(document.getElementById('m1').value));
dt_alarm.setSeconds(parseInt(document.getElementById('s1').value));
global_dt_alarm_sec=dt_alarm.getTime();
document.getElementById('ct3').style.background='#ffffff';
}


function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}


function display_ct() {
var dt = new Date();
document.getElementById('ct4').innerHTML = dt;
if((dt.getTime() >= global_dt_alarm_sec) && (global_dt_alarm_sec > 1000)){
document.getElementById('ct3').style.background='#ffffff';
global_dt_alarm_sec=0;
alert('Time over');
}
tt=display_c();
}
    </script>


    <title>Homepage</title>
</head>
 
<body onload=display_ct();>
    
   <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand gradient-text" href="home.php">Breathe</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                            <div class="top-search-bar">
                                <a id="ct4"></a>
                           </div>
                        </li>
                    
                        
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"> <?php echo($_SESSION['username']); ?> </h5>
                                  <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                                <a class="dropdown-item" href='logout.php'><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg ">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="home.php" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>
                            </li>
                            <br>                        
                        
                            <li class="nav-item ">
                                <a class="nav-link active" href="manage.php""><i class="fa fa-fw fa-user-circle"></i>Manage Activities</a>
                            </li>
                            <br>
                             <li class="nav-item ">
                                <a class="nav-link active" href="javascript:void(0)" onclick="toggle_visibility('popupBoxOnePosition');"><i class="fa fa-fw fa-user-circle"></i>Send timetable</a>
                            </li>
                        
                    </div>
                </nav>
            </div>
        </div>