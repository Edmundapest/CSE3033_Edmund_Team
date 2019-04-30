<?php 
require('classes/connection.php');
  $username=$_SESSION['username'];

if(isset($_POST['submit'])){
    
    $activity= $_POST['activities'];    
        $stmt = $db->prepare('SELECT activities FROM task WHERE activities = :activities');
        $stmt->execute(array(':activities' => $activity));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $start= $_POST['startact'];
        $stmt = $db->prepare('SELECT ActStart FROM task WHERE ActStart = :startact');
        $stmt->execute(array(':startact' => $start));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $end = $_POST['endact'];
        $stmt = $db->prepare('SELECT ActEnd FROM task WHERE ActEnd = :endact');
        $stmt->execute(array(':endact' => $end));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);  
    
    $category = $_POST['category'];
        $stmt = $db->prepare('SELECT category FROM task WHERE category = :category');
        $stmt->execute(array(':category' => $category));
        $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    $stresslevel = $_POST['stresslevel'];
        $stmt = $db->prepare('SELECT stressLevel FROM task WHERE stressLevel = :stress');
        $stmt->execute(array(':stress' => $stresslevel));
        $row = $stmt->fetch(PDO::FETCH_ASSOC); 

list($date, $time1, $time2) = explode(' ', $end);
    list($month, $day, $year) = explode('/', $date);
    $date1 = $date;
    $date1 .= ' ';
    $date1 .= '0:00 AM';
    $date2 = $month;
    $date2 .= '/';
    $date2 .= $day + 1;
    $date2 .= '/';
    $date2 .= $year;
    $date2 .= ' ';
    $date2 .= '0:00 AM';
    
    try {
        $galNumb = "SELECT * FROM task WHERE actend >= :date1 AND actend < :date2";
        $stmt = $db->prepare($galNumb);
        $stmt->execute(array(':date1'=>$date1,':date2'=>$date2,));
        $counts = $stmt->rowCount();
        
    } catch(PDOException $e) {
            $error[] = $e->getMessage();
        }

    if ((int)$counts < 12
){

    try {
            //insert into database with a prepared statement
            $stmt = $db->prepare('INSERT INTO task (username,activities,ActStart,ActEnd,category,stressLevel) VALUES (:username,:activities,:startact,:endact,:category,:stress)');
             $stmt->execute(array(
                ':username'=>$username,
                ':activities' => $activity,
                ':startact' => $start,
                ':endact' => $end,
                ':category' => $category,
                ':stress' => $stresslevel,
             ));
           
           
    } catch(PDOException $e) {
            $error[] = $e->getMessage();
        }
        } else {
        echo "<script type='text/javascript'>alert('Not more than 6 activites per day');</script>";
    }
}

if(isset($_POST['update'])){

    $memberID= $_SESSION['memberID'];
    $username=$_POST['newusername'];
     $stmt=("UPDATE members SET username='$username' where memberID='$memberID'");
        $result = $db->query($stmt);
        echo $_SESSION['memberID'];
}
?>
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/datepicker/tempusdominus-bootstrap-4.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
   
    <script type="text/javascript">
     function toggle_visibility(id) {
                   var e = document.getElementById(id);
                   if(e.style.display == 'block')
                      e.style.display = 'none';
                   else
                      e.style.display = 'block';
                }
     </script>  
    <style type="text/css">

            #popupBoxOnePosition{
                top: 0; left: 0; position: fixed; width: 100%; height: 120%;
                background-color: rgba(0,0,0,0.7); display: none;
            }
            .popupBoxWrapper{
                 width: 600px; margin: 100px auto; position: center; text-align: left; 
            }
            .popupBoxContent{
                background-color: #FFF; padding: 30px;
            }
    </style> 
     <style type="text/css">

            #popupBoxOnePosition2{
                top: 0; left: 0; position: fixed; width: 100%; height: 120%;
                background-color: rgba(0,0,0,0.7); display: none;
            }
            .popupBoxWrapper2{
                 width: 500px; margin: 100px auto; position: center; text-align: left; 
            }
            .popupBoxContent2{
                background-color: #FFF; padding: 15px;
            }
    </style> 
    <style type="text/css">

            #popupBoxOnePosition3{
                top: 0; left: 0; position: fixed; width: 100%; height: 120%;
                background-color: rgba(0,0,0,0.7); display: none;
            }
            .popupBoxWrapper3{
                 width: 500px; margin: 100px auto; position: center; text-align: left; 
            }
            .popupBoxContent3{
                background-color: #FFF; padding: 15px;
            }
    </style> 
    <style type="text/css">
            .gradient-text{
                font-size: 30px;
                background: -webkit-linear-gradient(#eee, #0000ff);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .test {
                height: fixed;
                background: linear-gradient(to bottom, #33ccff 0%, #ff99cc 100%)

}
    </style>
    <style type="text/css">
      #chart-container {
        width: 640px;
        height: auto;
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
alert('Time to do your task');
}
tt=display_c();
}
    </script>
    <style>
        #time {
            font-size:20px;
            font-family:  Arial;
               }
    </style>
<title>Breathe</title>
</head>
<body onload=display_ct();>
    
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
          <div class="dashboard-header">
            <nav class="navbar bg-white navbar-expand-lg fixed-top">
                <a class="navbar-brand gradient-text " href="home.php">Breathe</a>
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
                                <a class="dropdown-item" href="javascript:void(0)" onclick="toggle_visibility('popupBoxOnePosition3');"><i class="fas fa-power-off mr-2"></i>Edit profile</a>
                               
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
                                <a class="nav-link active" href="#" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success"></span></a>           
                            </li>                          
                            <br>
                            <li class="nav-item ">
                                <a class="nav-link active" href="javascript:void(0)" onclick="toggle_visibility('popupBoxOnePosition');"><i class="fa fa-fw fa-tasks"></i>Add activities</a>
                            </li>
                            <br>
                            <li class="nav-item ">
                                <a class="nav-link active" href="manage.php""><i class="fa fa-fw fa-calendar-alt"></i>Manage Activities</a>
                            </li>
                            <br>
                            <li class="nav-item ">
                                <a class="nav-link active" href="javascript:void(0)" onclick="toggle_visibility('popupBoxOnePosition2');"><i class="fa fa-fw fa-user-circle"></i>Add reminder</a>
                            </li>
                            <br>
                             <li class="nav-item ">
                                <a class="nav-link active" href="suggestion.php"><i class="fa fa-fw fa-heart"></i>Suggestion</a>
                            </li>
                        
                    </div>
                </nav>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== --> 
                    <div class="row">
                        
                    </div>
                    <div class="row">
                    <!-- ============================================================== -->
                    <!-- line chart  -->
                    <!-- ============================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script type="text/javascript" src="js/bar.js"> </script>
                        <div class = "card">
                            <h5 class="card-header">Activities Bar Chart</h5>
                            <div id="chart-container">
                    <canvas id="mycanvas"></canvas>
                    </div>
                        </div>
                    </div>      
                    <form role="form" method="post" action="" autocomplete="off">
                            <div id="popupBoxOnePosition3">
                                 <div class="popupBoxWrapper3">
                                     <div class="popupBoxContent3">
                                            <h3>Edit user name</h3>
                                         
                                            <p>New user name <input type="text" size="20" maxlength="15" name="newusername" id="activities" required="" ></p>
                                                                                     
                                           <br>
                                           <input type="hidden" name="hidden_id">
                                            <input type="submit" name="update" value="Update" class="btn btn-success"></button>
                                            <button type="button" class="btn btn-primary btn-danger" href="javascript:void(0)" onclick="toggle_visibility('popupBoxOnePosition3');">Close</button>
                                    </div>
                                    </div>
                                    </div>        
                                        </form>
                            
                              <form role="form" method="post" action="" autocomplete="off">
                            <div id="popupBoxOnePosition2">
                                 <div class="popupBoxWrapper2">
                                     <div class="popupBoxContent2">
                                     <h1>Set timer</h1><table><tr><td><a href=# OnClick=update_alarm('h','up')><img src=images/up.jpg border='0'></a></td><td><a href=# OnClick=update_alarm('m','up')><img src=images/up.jpg border='0'></a></td><td><a href=# OnClick=update_alarm('s','up')><img src=images/up.jpg border='0'></a></td></tr>

<tr><td><input type=text size=2 id='h1' name='h1' value=00 onBlur=update_alarm('h','none')></td><td><input type=text size=2 id='m1' name='m1' value=00 onBlur=update_alarm('m','none')></td><td><input type=text size=2 id='s1' name='s1' value=00 onBlur=update_alarm('s','none')></td></tr>
<tr><td><a href=# OnClick=update_alarm('h','down')><img src=images/down.jpg border='0'></a></td><td><a href=# OnClick=update_alarm('m','down')><img src=images/down.jpg border='0'></a></td><td><a href=# OnClick=update_alarm('s','down')><img src=images/down.jpg border='0'></a></td></tr>
</table>
<br><br>
<span id='ct3'></span><br><br><input type=button class="btn btn-success" onClick=set_alarm() value='Set Alarm'> <span id='ct4'></span>
                                          
                                            <button type="button" class="btn btn-primary btn-danger" href="javascript:void(0)" onclick="toggle_visibility('popupBoxOnePosition2');">Close</button>
                                        </div>
                                    </div>  
                                </div>
                                        </form>


                                        <form role="form" method="post" action="" autocomplete="off">
                            <div id="popupBoxOnePosition">
                                 <div class="popupBoxWrapper">
                                     <div class="popupBoxContent">
                                            <h3>Add activities</h3>
                                         
                                            <p>Activities <input type="text" size="20" maxlength="15" name="activities" id="activities" required="" ></p>
                                                                                     
                                   <h5>Date start & Date end</h5>

                                    <div class="form-group">
                                        <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                                            <input type="text" name=startact class="form-control datetimepicker-input" data-target="#datetimepicker7" required="" />
                                            <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group date" id="datetimepicker8" data-target-input="nearest">
                                            <input type="text" name=endact class="form-control datetimepicker-input" data-target="#datetimepicker8" required=""   />
                                            <div class="input-group-append" data-target="#datetimepicker8" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <h5>Category</h5>
                                     <div class="form-group">
                                    <select name="category" class="selectpicker">
                                    <option>Sports</option>
                                    <option>Study</option>
                                    <option>House Chores</option>
                                </select>
                                    </div>
                                    <h5>Stress level</h5>
                                     <div class="form-group">
                                    <select name="stresslevel" class="selectpicker" placeholder="stresslevel">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                                    </div>                                     

                                            <input type="submit" name="submit" value="Add" class="btn btn-success"></button>
                                            <button type="button" class="btn btn-primary btn-danger" href="javascript:void(0)" onclick="toggle_visibility('popupBoxOnePosition');">Close</button>
                                        </div>
                                        </div>
                                    </div>


                                        </form>
 
    <!-- jquery 3.3.1 -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
        <script src="assets/vendor/charts/charts-bundle/Chart.bundle.js"></script>
    <script src="assets/vendor/charts/charts-bundle/chartjs.js"></script>
    
    <!-- main js -->
    <script src="assets/libs/js/main-js.js"></script>   
      <script src="assets/vendor/datepicker/moment.js"></script>
    <script src="assets/vendor/datepicker/tempusdominus-bootstrap-4.js"></script>
    <script src="assets/vendor/datepicker/datepicker.js"></script>  
    <!-- chart chartist js -->
    <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="assets/libs/js/dashboard-ecommerce.js"></script>
  

</body>

 
</html>


