<?php
    require_once 'include/connection.php';
include("dashboard.php");
?>  
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->

                    <div class="ecommerce-widget">

                        <div class="row">
                            <!-- ============================================================== -->
                      
                            <!-- ============================================================== -->

                                          <!-- recent orders  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card" style="width: 57rem;">
                                    <h5 class="card-header">All Activities </h5>
                                    <div class="card-body p-10">
                                      
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


<script>
 $(document).ready(function() {
    $('#example').DataTable();
} );
</script>  
                                            <table class="table table-striped table-bordered" border=0 id="example" style="width:100%">
                                            <thead>
                                            <tr>
                                            <th>Activities</th> 
                                            <th>StartTime</th>
                                            <th>EndTime</th>   
                                            <th>Category</th>
                                            <th>StressLevel</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                            
                                          
   <?php
   $username=$_SESSION['username'];

    $statement = "SELECT * FROM task WHERE username='$username'";
if ($result = $db->query($statement)) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {  
     echo "<tr>";
echo "<td>".$row['activities']."</td>";
echo "<td>".$row['ActStart']."</td>";
echo "<td>".$row['ActEnd']. "</td>";
echo "<td>".$row['category']. "</td>";
echo "<td>".$row['stressLevel']. "</td>";
echo "<td><a class='btn btn-primary custom' href=\"edit.php?id=$row[ActID]\">Edit</a> | <a class='btn btn-danger custom' href=\"delete.php?id=$row[ActID]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</button></td>"; 
}
}
?>   
</table>     
                
                             <form method="post" action="pdf.php">  
                          <input type="submit" name="generate_pdf" class="btn btn-success" value="Generate PDF" />  
                     </form>  
<?php 
require_once 'phpmailer/class.phpmailer.php';
$mail = new PHPMailer();
// Now you only need to add the necessary stuff
// HTML body
$body = "</pre>
<div>";
$body .= " Attached is my timetable. Thank you.
";
$body .= "</div>" ;
 
// And the absolute required configurations for sending HTML with attachement
if(isset($_POST['submit'])){
$email= $_POST['email'];
$mail->AddAddress("$email");
$mail->Subject = "Breathe App";
$mail->AddAttachment($_FILES['file']['tmp_name'],$_FILES['file']['name']);
$mail->MsgHTML($body);
if(!$mail->Send()) {
echo "<script type=\"text/javascript\">window.alert('Email failed to sent.');
window.location.href = 'manage.php';</script>"; 
exit;
}

echo "Message was sent successfully";
 }
?>   
<style>
#stylized{
border:solid 8px #b7ddf2;
background:#ebf4fb;
}
#stylized label{
display:block;
font-weight:bold;
text-align:right;
width:140px;
float:left;
}
#stylized .small{
color:#666666;
display:block;
font-size:11px;
font-weight:normal;
text-align:left;
width:140px;
}
#stylized input{
float:left;
font-size:12px;
padding:4px 5px;
border:solid 1px #aacfe4;
width:200px;
margin:0px 0 10px 5px;
}

#stylized textarea {
loat:left;
font-size:12px;
padding:4px 2px;
border:solid 1px #aacfe4;
width:200px;
margin:2px 0 20px 10px;
}
</style>
                      
                            <div id="popupBoxOnePosition">
                                 <div class="popupBoxWrapper">
                                     <div class="popupBoxContent">   
                                        <div id="stylized" class="assestment-form">
                                        <form id="form" action="" method="POST" enctype="multipart/form-data">
                                             <h3>Send Timetable</h3>
                                             <p> </p>                              
                                       <label>Email:</label>
                                       <input type="text" name="email" required="" placeholder="youremail@email.com" size="30">  
                                                                  
                                       <label>File:</label><input id="file" name="file" type="file" />
                                        
                                        <div align="center">
                                      <input type="submit" class="btn btn-primary btn-success" name="submit" value="Send">
                                      <button type="button" class="btn btn-primary btn-danger" href="javascript:void(0)" onclick="toggle_visibility('popupBoxOnePosition');">Close</button>
                                       </div>
                                </form>
                                    </div>
                                </div>
                            </div>


                                                     

                                        </div>

                                    </div>

                                </div>
     


                            </div>
                    
                            
                        </div>
                    
                        </div>

                      
                           
                    
                        </div>
                    </div>
                </div>
-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
</body>
</html>
