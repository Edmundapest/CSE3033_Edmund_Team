<?php
// including the database connection file
include_once("include/connection.php");
 
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $activities=$_POST['activities'];
    $date=$_POST['startact'];
    $time=$_POST['endact'];    
    $category=$_POST['stressLevel'];
    
    // checking empty fields
    if(empty($activities) || empty($date) || empty($time)|| empty($category)) {            
        if(empty($activities)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($date)) {
            echo "<font color='red'>Age field is empty.</font><br/>";
        }
        
        if(empty($time)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        } 
        if(empty($category)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        }          
    } else {    
        //updating the table
        $stmt=("UPDATE task SET activities='$activities',ActStart='$date',ActEnd='$time',stressLevel='$category' WHERE ActID=$id");
        $result = $db->query($stmt);
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: manage.php");
    }
}
?>
<?php
//getting id from url
$id = $_GET['id'];
 
//selecting data associated with this particular id
$stmt=('SELECT * FROM task WHERE ActID="$id"');
$result = $db->query($stmt);
 
while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
{
    $activities = $row['activities'];
    $date = $row['startact'];
    $time = $row['endact'];
  $category=$row['stressLevel'];
}
?>
<html>
<head>    
     <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
   
     <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/datepicker/tempusdominus-bootstrap-4.css" />
       
    <title>Edit Data</title>
</head>
 
<body>
    <br/><br/>
    
     <form role="form" method="post" action="" autocomplete="off">
                            <div id="popupBoxOnePosition">
                                 <div class="popupBoxWrapper">
                                     <div class="popupBoxContent">
                                            <h3>Add activities</h3>
                                         
                                            <p>Activities <input type="text" size="20" maxlength="15" name="activities" id="activities" required="" ></p>
                                              
                                
                                   <h5>Date start & Date end</h5>

                                    <div class="form-group">
                                        <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                                            <input type="text" name=startact class=" datetimepicker-input" data-target="#datetimepicker7" size="25" required="" />
                                            <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group date" id="datetimepicker8" data-target-input="nearest">
                                            <input type="text" name=endact class="datetimepicker-input" data-target="#datetimepicker8" size="25" required=""   />
                                            <div class="input-group-append" data-target="#datetimepicker8" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                         <div class="form-group">
                                     <h5>Stress level</h5>
                                     <div class="form-group">
                                    <select name="stressLevel" class="selectpicker" placeholder="stresslevel">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                                    </div>                   
                                          
                                    </div>
                                        <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
                                            
                                            <br>
                                            <input type="submit" name="update" value="Update" class="btn btn-success"></button>
                                            <button type="button" class="btn btn-primary btn-danger" href="manage.php">Close</button>
                                        </form>
</body>

<script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
        <script src="assets/vendor/charts/charts-bundle/Chart.bundle.js"></script>
    <script src="assets/vendor/charts/charts-bundle/chartjs.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
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
</html>