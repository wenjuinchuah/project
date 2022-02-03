<?php
    include_once 'adminHeader.php'; 
    date_default_timezone_set("Asia/Kuala_Lumpur");

    //products sales
    $sql = "SELECT * FROM products ORDER BY Sales DESC";
    $result =  mysqli_query($conn, $sql);
    $id = $sales = $pic = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $sales[] = $row['Sales'];
        $id[] = $row['ID'];
        $pic[] = $row['image'];
    }

     //RM Sales
     $i = 0; $ctr = 29;
     $sum = $dates = array();
     while($i<30){
         $dates[$i] = date("Y-m-d",strtotime("now - ".$ctr."days"));
         $sql = "SELECT SUM(Total) AS sumValue FROM transaction WHERE CAST(TransactionDate as DATE) = '$dates[$i]' ";
         $result = mysqli_query($conn,$sql);
         $run = mysqli_fetch_assoc($result);
         $sum[$i] = round($run["sumValue"],2);
         $dates[$i] = date("M-d",strtotime("now - ".$ctr."days"));
         $i++; $ctr--;
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
    <!-- Google Chart-->
    <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>

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

        #chart4{
            height:400px;
            width:600px;
            margin:auto;
        }
        
        .w3-button{
            padding:5px 10px; 
            margin:8px 15px auto auto;
        }
    </style>
</head>

<body class="w3-light-grey">

    <div style="margin-left: 15px;">
        <h5 style="display: inline-block"><b><i class="fa fa-bar-chart"></i> Analytics</b></h5>
    </div>

    <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-half">
            <h4 style="display:inline-block;">Top 5 Best Selling Products</h4>
            <button class="w3-right w3-button w3-black w3-round-xxlarge"
            onclick='showModal("allSales");'>All Product</button>
            <div class="chartContainer w3-padding-16">
                <canvas id="chart1"></canvas>
            </div>
        </div>
        <div class="w3-half">
            <h4 style="display:inline-block;">Past 7 Days Sales</h4>
            <button class="w3-right w3-button w3-black w3-round-xxlarge"
            onclick='showModal("30days");'>30 Days</button>
            <div class="chartContainer w3-padding-16">
                <canvas id="chart2"></div>
           </div>
        </div>
    </div>    

    <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-half">
            <h4>User Gender Proportion</h4>
            <div class="chartContainer w3-padding-16">
                <canvas id="chart3"></canvas>
            </div>
        </div>
        <div class="w3-half">
            <h4>User Demographic (State)</h4>
            <div class="chartContainer w3-padding-16">
                <div id="chart4"></div>
            </div>
        </div>
    </div>

    <div id='allSales' class='w3-modal'>
        <div class='w3-modal-content'>
            <header class="w3-container w3-lightblue"> 
                <span onclick="closeModal('allSales');" 
                class="w3-button w3-display-topright w3-xlarge">&times;</span>
                <h2 style="text-align:center;">All Product Sales</h2>
            </header>
            <div class="w3-container">
                <canvas id="chart5"></canvas>
            </div>
        </div>
    </div>

    <div id='30days' class='w3-modal'>
        <div class='w3-modal-content'>
            <header class="w3-container w3-lightblue"> 
                <span onclick="closeModal('30days');" 
                class="w3-button w3-display-topright w3-xlarge">&times;</span>
                <h2 style="text-align:center;">Past 30 Days Sales</h2>
            </header>
            <div class="w3-container">
                <canvas id="chart6"></canvas>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="w3-container w3-padding-16 w3-light-grey">
        <h4>FOOTER</h4>
        <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
    </footer>

    <script>
        //Best selling products
        //Encode data into JSON format
        id = <?php echo json_encode($id); ?>;
        sales = <?php echo json_encode($sales); ?>; 

        var maxValue = sales.reduce(function(a,b){
            return Math.max(a,b);
        },0);
        //Setup data
        const data = {
            labels: id.slice(0,5),
            datasets: [{
                label: 'Number of Sales',
                data: sales.slice(0,5),
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'blue',
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
                        min:0,
                        max:maxValue+2,
                        title: {
                            display: true,
                            text: 'Sold Quantity'
                        },
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


        //Past 7 days sales
        dates = <?php echo json_encode($dates); ?>;
        sum = <?php echo json_encode($sum); ?>;

        const year = new Date().getFullYear();
        var maxSum = sum.reduce(function(a,b){
            return Math.max(a,b);
        },0);
        const data2 = {
            labels: dates.slice(23),
            datasets: [{
                label:'Sales (RM)',
                data: sum.slice(23),
                fill:false,
                borderColor: '#110971',
                borderWidth: 1,
                tension:0.3
            }]
        };

        const config2 = {
            type: 'line',
            data: data2,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date (' +year+ ')',
                        }
                    },
                    y: {
                        min:0,
                        max: Math.ceil(maxSum+5),
                        title: {
                            display: true,
                            text: 'Sales (RM)'
                        },
                        ticks:{
                            stepSize:5
                        }
                    }
                },
                plugins:{
                    datalabels:{
                        anchor: 'end',
                        align: 'end'
                    }
                }
            },
            plugins: [ChartDataLabels], 
        };
        //Render
        const chart2 = new Chart(
            document.getElementById("chart2"),
            config2
        );


        //Gender proportion
        male = <?php echo json_encode($male); ?>;
        female = <?php echo json_encode($female); ?>;

        const data3 = {
            labels: ['Male','Female'],
            datasets:[{
                label: 'Gender',
                data:[male,female],
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)',
                ],
                hoverOffset: 4 
            }]
        };

        const config3 = {
            type:'doughnut',
            data:data3,
            options: {
                responsive:true,
                maintainAspectRatio: false,
                plugins: {
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
        
        const chart3 = new Chart(
            document.getElementById("chart3"),
            config3
        );
        
        //User state
        state = <?php echo json_encode($state); ?>;
        stateUser = <?php echo json_encode($stateUser); ?>; 
        google.charts.load('visualization', '1', {'packages': ['geochart']});
        google.charts.setOnLoadCallback(drawRegionsMap);
        function drawRegionsMap() {
            var data4 = new google.visualization.DataTable();
            data4.addColumn('string', 'State');
            data4.addColumn('number', 'Data');
            data4.addRows([
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
                colorAxis: {colors:['e4f8ff','#3d309c']},
                datalessRegionColor: 'lightgrey',
            };

            var chart4 = new google.visualization.GeoChart(document.getElementById('chart4'));
            chart4.draw(data4,options);
        }

        //all products
        const data5 = {
            labels: id,
            datasets: [{
                label: 'Number of Sales',
                data: sales,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'blue',
                borderWidth:1,
            }]
        };

        //Config
        const config5 = {
            type: 'bar',
            data: data5,
            options: {
                indexAxis:'y',
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Sold Quantity'
                        }
                    },
                    y: {
                        min:0,
                        max:maxValue,
                        title: {
                            display: true,              
                            text: 'Product ID'
                        },
                    }
                }
            },
            plugins: [ChartDataLabels],
        };
        //Render
        const chart5 = new Chart(
            document.getElementById("chart5"),
            config5
        );

        //30days
        const data6 = {
            labels: dates,
            datasets: [{
                label:'Sales (RM)',
                data: sum,
                fill:false,
                borderColor: '#110971',
                borderWidth: 1,
                tension:0.3
            }]
        };

        const config6 = {
            type: 'line',
            data: data6,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date (' +year+ ')',
                        }
                    },
                    y: {
                        min:0,
                        max: Math.ceil(maxSum+5),
                        title: {
                            display: true,
                            text: 'Sales (RM)'
                        },
                        ticks:{
                            stepSize:5
                        }
                    }
                },
                plugins:{
                    datalabels:{
                        anchor: 'end',
                        align: 'end'
                    }
                }
            },
            plugins: [ChartDataLabels], 
        };
        //Render
        const chart6 = new Chart(
            document.getElementById("chart6"),
            config6
        );

        //modal function
        function showModal(id){
            document.getElementById(id).style.display = 'block';
        }

        function closeModal(id){
            document.getElementById(id).style.display='none'
        }

    </script>

</body>


</html>