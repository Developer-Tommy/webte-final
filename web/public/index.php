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
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
    <title>CAS API</title>
</head>
<body>
<section>
    <form>
        <label for="lang-switch">
            <span lang="sk">Jazyk</span>
            <span lang="en">Language</span>
        </label>
        <select id="lang-switch">
            <option value="en">English</option>
            <option value="sk">Slovensky</option>
        </select>
    </form>
    <div>
        <hr>
        <h2>Octave CLI</h2>
        <form action="server.php" id="octave-form" class="inventors-form" method="post" enctype="multipart/form-data">
            <div class="box">
                <label for="octave">Octave CLI: </label>
                <textarea name="octave" id="octave" class="area-box" style="min-width: 300px; height: 300px"></textarea>
            </div>
            <input lang="en" class="sub" type="submit" value="Show">
            <input lang="sk" class="sub" type="submit" value="Zobraz">

        </form>
        <hr>
        <h2 lang="en">Output</h2>
        <h2 lang="sk">Výstup</h2>
        <p><?php var_dump($tmp)?></p>
    </div>
    <div>
        <hr>
        <h2 lang="en">Enter size of obstacle</h2>
        <h2 lang="sk">Zadaj veľkosť prekážky</h2>
        <form id="r-form" action="server.php" class="inventors-form" method="post" enctype="multipart/form-data">
            <div class="box">
                <label lang="en" for="r">Input r: </label>
                <label lang="sk" for="r">Vstup r: </label>
                <input type="number" step="0.01" name="r" id="r" required min="-0.1" max="0.1">
            </div>
            <input lang="en" class="sub" type="submit" value="Show" id="submit">
            <input lang="sk" class="sub" type="submit" value="Zobraz" id="submit">

        </form>
        <hr>
        <h2 lang="en">Output</h2>
        <h2 lang="sk">Výstup</h2>
        <p><?php var_dump($tmp_r)?></p>
    </div>
</section>
<section>
    <hr>
    <h2 lang="en">Choose visualisation:</h2>
    <h2 lang="sk">Vyber spôsob vizualizácie:</h2>
    <div style="display: none" id="chart"></div>
    <div class="controls">
        <input type="checkbox" id="graph" value="graph" onclick="validate()"/>
        <label lang="en" for="graph">Graph</label>
        <label lang="sk" for="graph">Graf</label>
        <br>
        <input type="checkbox" id="anim" value="anim" onclick="validate()"/>
        <label for="anim" lang="en">Animation</label>
        <label for="anim" lang="sk">Animácia</label>
        <br>
    </div>
</section>
<script>
    function getCookie(cname) {
        //https://www.w3schools.com/js/js_cookies.asp
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i <ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) === 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    let langSwitch = document.getElementById("lang-switch");
    let lang = getCookie("lang");
    if (lang === "") {
        langSwitch.value = "sk";
        $('[lang="sk"]').show();
        $('[lang="en"]').hide();
    }
    else {
        langSwitch.value = lang;
        switchLang(lang);
    }

    $('#lang-switch').change(function () {
        lang = $(this).val();
        document.cookie = "lang="+lang;
        switchLang(lang);
        loadGraph();
    });

    function switchLang (lang){
        switch (lang) {
            case 'en':
                $('[lang="en"]').show();
                $('[lang="sk"]').hide();
                break;
            case 'sk':
                $('[lang="sk"]').show();
                $('[lang="en"]').hide();
                break;
        }
    }

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
        else {
            form1.submit()
        }

    })

    loadGraph();

    function loadGraph() {
        let carLabel, wheelLabel, loadingLabel, timeLabel, obstacleLabel;

        if (lang === "en") {
            carLabel = "Car(x1)";
            wheelLabel = "Wheel(x3)";
            loadingLabel = "Loading...";
            timeLabel = "Time(s)";
            obstacleLabel = "Obstacle height(m)";
        }
        if (lang === "sk") {
            carLabel = "Auto(x1)";
            wheelLabel = "Koleso(x3)";
            loadingLabel = "Načítavanie...";
            timeLabel = "Čas(s)";
            obstacleLabel = "Výška prekážky(m)";
        }

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
                text: loadingLabel
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
                tickAmount: 5,
                overwriteCategories: [
                    "0",
                    "1",
                    "2",
                    "3",
                    "4",
                    "5",
                ],
                title: {
                    text: timeLabel
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
                        text: obstacleLabel
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

        const car = [];
        const wheel = [];


        let arr = '<?php echo json_encode($tmp_r)?>';

        arr = JSON.parse(arr);


        let item_array = [];
        arr.shift()
        arr.shift()

        arr.forEach((item) => {
            item = item.trim()
            item_array = item.split(" ");
            const results = item_array.filter(element => {
                return element !== '';
            });
            car.push(results[0])
            wheel.push(results[1])
        })

        chart.updateSeries([
            {
                name: carLabel,
                data: car
            },
            {
                name: wheelLabel,
                data: wheel
            }
        ])
        validate()
    }

    function validate(){
        if (document.getElementById('graph').checked){
            document.querySelector("#chart").style.display = "block";
        }else{
            document.querySelector("#chart").style.display = "none";
        }
    }

</script>
</body>
</html>