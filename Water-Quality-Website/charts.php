<?php
include ('./config.php');

// session_start();
// if (array_key_exists('loginId', $_SESSION)) {
    $con = mysqli_connect('localhost',$username,$password) 
    or die('Cannot connect to the DB');

    mysqli_select_db($con, $database_name);

    $dataPoints1 = array();
    $dataPoints2 = array();
    $dataPoints3 = array();
    $result = mysqli_query($con,"SELECT * FROM reading ORDER BY time LIMIT 12");
    while($row = $result->fetch_assoc()) {
            array_push($dataPoints1, array("label" => $row['time'], "y" => $row['temperature']));
            array_push($dataPoints2, array("label" => $row['time'], "y" => $row['turbidity']));
            array_push($dataPoints3, array("label" => $row['time'], "y" => $row['ph']));
    }
// }
?>
<!-- <!DOCTYPE HTML>
<html>
<head> -->
<script>
window.onload = function () {
    
    var dps1 = <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>;
    var dps2 = <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>;
    var dps3 = <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>;

    var chart = new CanvasJS.Chart("chartContainer", {
        title: {
            text: "Data Reading"
        },
        animationEnabled: false,
        axisY: {
            titleFontFamily: "arial",
            titleFontSize: 12,
            includeZero: false
        },
        toolTip: {
            shared: true
        },
        data: [
        {
            type: "line",
            name: "Temperature",
            showInLegend: true,
            dataPoints: dps1
        },
        {
            type: "line",
            name: "Turbidity",
            showInLegend: true,
            dataPoints: dps2
        },
        {
            type: "line",
            name: "pH",
            showInLegend: true,
            dataPoints: dps3
        }
        ],
        legend: {
            cursor: "pointer",
            itemclick: function (e) {
                if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                }
                else {
                    e.dataSeries.visible = true;
                }
                chart.render();
            }
        }
    });

    chart.render();
 
}
</script>
<!-- </head>
<body> -->
<div id="chartContainer" style="height: 370px; width: 90%; margin: auto;">
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div>
<!-- </body>
</html> -->