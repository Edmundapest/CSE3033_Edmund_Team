$(document).ready(function() {
    $("#ea").DataTable({
        ajax: {
            url: "getTask.php",
            dataSrc: ""
        },
        columns: [
            { data: "activities" },
            { data: "ActStart" },
            { data: "ActEnd" },
             { data: "Priority" },  
             { data: "stressLevel" },          
        ],          
       
        iDisplayStart: 0
    });
});