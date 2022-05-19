<?php
include "server.php";
$tmp = null;
$tmp_r = null;
if (isset($_SESSION['out'])) {
    $tmp = $_SESSION['out'];
    unset($_SESSION['out']);
}
if (isset($_SESSION['r'])) {
    $tmp_r = $_SESSION['r'];
    unset($_SESSION['r']);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <title>CAS API</title>
</head>
<body>
<section>
    <div>
        <hr>
        <h2>Octave CLI</h2>
        <form action="server.php" id="octave-form" class="inventors-form" method="post" enctype="multipart/form-data">
            <div class="box">
                <label for="octave">Octave CLI: </label>
                <textarea name="octave" id="octave" class="area-box" style="min-width: 300px; height: 300px"></textarea>
            </div>
            <input class="sub" type="submit" value="Show">
        </form>
        <hr>
        <h2>Output</h2>
        <p><?php var_dump($tmp)?></p>
    </div>
    <div>
        <hr>
        <h2>Enter size of obstacle</h2>
        <form id="r-form" action="server.php" class="inventors-form" method="post" enctype="multipart/form-data">
            <div class="box">
                <label for="r">Input r: </label>
                <input type="number" step="0.01" name="r" id="r" required min="-0.1" max="0.1">
            </div>
            <input class="sub" type="submit" value="Show" id="submit">
        </form>
        <hr>
        <h2>Output</h2>
        <p><?php var_dump($tmp_r)?></p>
    </div>
</section>
<section>
    <hr>
    <h2>Choose visualisation:</h2>
    <div id="chart"></div>
    <div class="controls">
        <input type="checkbox" id="graph" value="graph" onclick="validate()" checked/>
        <label>Graph</label> <br>
        <input type="checkbox" id="anim" value="anim" onclick="validate()" checked/>
        <label>Animation</label> <br>
    </div>
</section>
<script>
    const submit = document.getElementById("submit")
    const form1 = document.getElementById("r-form")
    const form2 = document.getElementById("octave-form")
    const value = document.getElementById("r")

    submit.addEventListener('click', () => {
        console.log(value.value)
        if (value.value < -0.1 || value.value > 0.1) {
            alert("Wrong input! Obstacle is too deep or high.")
            window.location.href = "index.php"
        }
        else form1.submit()

    })

    var options = {
        chart: {
            height: 400,
            type: "line",
            stacked: false
        },
        dataLabels: {
            enabled: false
        },
        colors: ["#FF1654", "#247BA0"],
        series: [{
            data: [],
            data: [],
        }],
        noData: {
            text: 'Loading...'
        },
        stroke: {
            curve: 'smooth',
            width: [4, 4]
        },
        plotOptions: {
            bar: {
                columnWidth: "20%"
            }
        },
        xaxis: {
            categories: [],
            title: {
                text: "Time (s)"
            },
            labels: {
                rotate: 0,
                hideOverlappingLabels: true,
            }
        },
        yaxis: [
            {
                axisTicks: {
                    show: true
                },
                axisBorder: {
                    show: true,
                },
                title: {
                    text: "Obstacle"
                },
            }
        ],
        tooltip: {
            shared: false,
            intersect: true,
            x: {
                show: false
            }
        },
        legend: {
            horizontalAlign: "left",
            offsetX: 100
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    const sin = [];
    const cos = [];
    let amplitude = 1;
    this.addEventListener('update-amplitude', (event) => {
        amplitude = event.detail.value
    })

    const evtSource = new EventSource("https://iolab.sk/evaluation/sse/sse.php")

    function update () {
        const data = JSON.parse(event.data)
        sin.push(amplitude * data.y1)
        cos.push(amplitude * data.y2)
        chart.updateSeries([
            {
                name: "Sin(x)",
                data: sin
            },
            {
                name: "Cos(x)",
                data: cos
            }
        ])
        validate()
    }

    function validate(){
        if (document.getElementById('chart').checked){
            chart.style.display = block;
        }else{
            chart.style.display = none;
        }
        if (document.getElementById('anim').checked){
            chart.style.display = block;
        }else{
            chart.style.display = none;
        }
    }
    evtSource.addEventListener("message", update)
    document.getElementById('stop').addEventListener('click', function () {
        evtSource.removeEventListener('message', update)
    })
</script>
</body>
</html>