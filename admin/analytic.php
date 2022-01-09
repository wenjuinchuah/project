<?php
    include_once 'adminHeader.php'; 
    date_default_timezone_set("Asia/Kuala_Lumpur");

    //top 5 products
    $sql = "SELECT * FROM products ORDER BY Sales DESC LIMIT 5";
    $result =  mysqli_query($conn, $sql);
    $id = $sales = $pic = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $sales[] = $row['Sales'];
        $id[] = $row['ID'];
        $pic[] = $row['image'];
    }

    //gender proportion
    $gender = ["Male","Female"];
    $i = 0;
    while($i < 2){
        $sql = "SELECT Gender FROM user WHERE Gender='$gender[$i]'";
        $result = mysqli_query($conn,$sql);
        if($i==0){
            $male = mysqli_num_rows($result);
        } else{
            $female = mysqli_num_rows($result);
        }
        $i++;
    }

    //state
    $state = ["Johor","Kedah","Kelantan","Melaka","Negeri Sembilan","Pahang","Perak", "Perlis",
    "Pulau Pinang","Sabah","Sarawak","Selangor","Terengganu","Kuala Lumpur","Labuan","Putrajaya"];
    $stateUser = array();

    $i = 0;
    while($i < 16){
        $sql = "SELECT State FROM user WHERE State = '$state[$i]'";
        $result = mysqli_query($conn,$sql);
        $stateUser[$i] = mysqli_num_rows($result);
        // echo $state[$i] ."->". $stateUser[$i]."</br>";
        $i++;
    }
    
?> 

<!DOCTYPE html>

<html>

<head>
    <!-- Chart.js-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js"
     integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" 
     crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
    <!-- Google Chart API-->
    <script type='text/javascript'src='https://www.gstatic.com/charts/loader.js'></script>

    <style>
        .chartContainer {
            background:white;
            position:relative;
            border: 2px solid lightgray;
            margin:auto;
            height:450px;
        }

        #chart1,#chart2 {
            margin: 10px;
        }

        #chart3{
            height:400px;
            width:600px;
            margin:auto;
        }
    </style>
</head>

<body class="w3-light-grey">

    <div style="margin-left: 15px;">
        <h5 style="display: inline-block"><b><i class="fa fa-bar-chart"></i> Analytics</b></h5>
    </div>

    <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-half">
            <h4>Top 5 Best Selling Products</h4>
            <div class="chartContainer w3-padding-16">
                <canvas id="chart1"></canvas>
            </div>
        </div>
        <div class="w3-half">
            <h4>Chart Title</h4>
            <div class="chartContainer w3-padding-16">
                <div id="chart4"></div>
            </div>
        </div>
    </div>    

    <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-half">
            <h4>User Gender Proportion</h4>
            <div class="chartContainer w3-padding-16">
                <canvas id="chart2"></canvas>
            </div>
        </div>
        <div class="w3-half">
            <h4>User Demographic (State)</h4>
            <div class="chartContainer w3-padding-16">
                <div id="chart3"></div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="w3-container w3-padding-16 w3-light-grey">
        <h4>FOOTER</h4>
        <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
    </footer>

    <script>
        //Encode data into JSON format
        id = <?php echo json_encode($id); ?>;
        sales = <?php echo json_encode($sales); ?>; 
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
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        }

        //Config
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Product ID'
                        }
                    },
                    y: {
                        suggestedMin:0,
                        suggestedMax:10,
                        title: {
                            display: true,
                            text: 'Sold Quantity'
                        },
                        ticks:{
                            stepSize:1
                        }
                    }
                }
            },
            plugins: [ChartDataLabels],
        };
        //Render
        const chart1 = new Chart(
            document.getElementById("chart1"),
            config
        );


        //Gender proportion
        male = <?php echo json_encode($male); ?>;
        female = <?php echo json_encode($female); ?>;

        const data2 = {
            labels: ['Male','Female'],
            datasets:[{
                label: 'Gender',
                data:[male,female],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                ],
                hoverOffset: 4 
            }]
        };

        const config2 = {
            type:'doughnut',
            data:data2,
            options: {
                responsive:true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        enabled: false
                    },
                    datalabels: {
                        formatter: (value, context) => {
                            const datapoints = context.chart.data.datasets[0].data;
                            function sum(total,datapoint){
                                return total+datapoint;
                            }
                            const totalValue = datapoints.reduce(sum,0);
                            const percentage = (value/totalValue * 100).toFixed(2);
                            return `${percentage}%`;
                       },
                        color: '#fff',
                    }
                }
            },
            plugins: [ChartDataLabels]
        };
        
        const chart2 = new Chart(
            document.getElementById("chart2"),
            config2
        );

        //User state
        var i = 0;
        state = <?php echo json_encode($state); ?>;
        stateUser = <?php echo json_encode($stateUser); ?>; 
        google.charts.load('visualization', '1', {'packages': ['geochart']});
        google.charts.setOnLoadCallback(drawRegionsMap);
        function drawRegionsMap() {
            var data3 = new google.visualization.DataTable();
            data3.addColumn('string', 'State');
            data3.addColumn('number', 'Data');
            data3.addRows([
                [{v:'MY-01', f:' Johor'},stateUser[0]],
                [{v:'MY-02', f:' Kedah'}, stateUser[1]],
                [{v:'MY-03', f:' Kelantan'}, stateUser[2]],
                [{v:'MY-04', f:' Melaka'}, stateUser[3]],
                [{v:'MY-05', f:' Negeri Sembilan'}, stateUser[4]],
                [{v:'MY-06', f:' Pahang'}, stateUser[5]],
                [{v:'MY-08', f:' Perak'}, stateUser[6]],
                [{v:'MY-09', f:' Perlis'}, stateUser[7]],
                [{v:'MY-07', f:' Pulau Pinang'}, stateUser[8]],
                [{v:'MY-12', f:' Sabah'}, stateUser[9]],
                [{v:'MY-13', f:' Sarawak'}, stateUser[10]],
                [{v:'MY-10', f:' Selangor'}, stateUser[11]],
                [{v:'MY-11', f:' Terengganu'}, stateUser[12]],
                [{v:'MY-14', f:' Wilayah Persekutuan Kuala Lumpur'}, stateUser[13]],
                [{v:'MY-15', f:' Wilayah Persekutuan Labuan'}, stateUser[14]],
                [{v:'MY-16', f:' Wilayah Persekutuan Putrajaya'},stateUser[15]],
            ]);

            var options = {
                region: 'MY',
                displayMode: 'regions',
                resolution: 'provinces',
                // backgroundColor: '#81d4fa', 
                colorAxis: {colors:['e4f8ff','#3d309c']},
                datalessRegionColor: 'lightgrey',
            };

            var chart = new google.visualization.GeoChart(document.getElementById('chart3'));
            chart.draw(data3,options);
        }
    </script>

</body>


</html>