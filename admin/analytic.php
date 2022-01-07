<?php
    include_once 'adminHeader.php'; 

    $sql = "SELECT * FROM products ORDER BY Sales DESC LIMIT 5";
    $result =  mysqli_query($conn, $sql);
    $id = $sales = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $sales[] = $row['Sales'];
        $id[] = $row['ID'];
    }

?>

<!DOCTYPE html>

<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chartContainer {
            width: 500;
            height: auto;
            border: 2px solid lightgray;
        }

        #chart1 {
            margin: 10px;
        }
    </style>
</head>

<body class="w3-light-grey">
    <div style="margin-left: 15px;">
        <h5 style="display: inline-block"><b><i class="fa fa-bar-chart"></i> Analytics</b></h5>
    </div>
    <div class="chartContainer">
        <canvas id="chart1"></canvas>
    </div>

    <script>
        //Encode data into JSON format
        sales = <?php echo json_encode($sales); ?>;
        id = <?php echo json_encode($id); ?>;
        //Setup data
        const data = {

            labels: id,
            datasets: [{
                label: 'Number of Sales',
                data: sales,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        }
        //Config
        const config = {
            type: 'bar',
            data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        }
        //Render
        const chart1 = new Chart(
            document.getElementById("chart1"),
            config
        );
    </script>

</body>


</html>