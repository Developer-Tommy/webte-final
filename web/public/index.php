<?php

include "server.php";
$tmp = null;
$tmp_r = null;
$result = null;
$selected = "sk";

if(isset($_POST['submit'])) {
    if (!empty($_POST['lang'])) {
        $selected = $_POST['lang'];
    }
}
if (isset($_SESSION['http'])) {
    $page = $_SESSION['http'];
    if ($page == "index") {
        unset($_SESSION['output']);
        unset($_SESSION['active']);
        echo "unset";
    }
}

$_SESSION['http'] = "index";

if (isset($_SESSION['out'])) {
    $tmp = $_SESSION['out'];
    unset($_SESSION['out']);
    foreach ($tmp as $item) {
        $result = trim($item);
    }
}
if (isset($_SESSION['output'])) {
    $tmp_r = $_SESSION['output'];
    unset($_SESSION['output']);
}

if (isset($_SESSION['email'])) {
    if ($_SESSION['email'] == "success"){
        $message = "Email sent successfully!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        unset($_SESSION['email']);
    }
    else {
        $message = "Email failed! Try again.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        unset($_SESSION['email']);
    }
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/521/fabric.min.js"></script>
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    <title>CAS API</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&family=Open+Sans:ital,wght@1,300&display=swap"
          rel="stylesheet">
</head>

<body>


<div id="mainHeader">
    <h1>CAS API</h1>

    <form action="index.php" method="post">
        <label for="lang-switch">
            <span lang="sk">Jazyk</span>
            <span lang="en">Language</span>
        </label>
        <select id="lang-switch" name="lang" onchange="this.form.submit()">
            <option value="en">English</option>
            <option value="sk">Slovensky</option>
        </select>
        <input lang="sk" type="submit" class="dropbtn" name="submit" value="Potvrď jazyk">
        <input lang="en" type="submit" class="dropbtn" name="submit" value="Confirm language">
    </form>

    <div class="dropdown">
        <button class="dropbtn">Menu</button>
        <div class="dropdown-content">
            <a href="manual.php?lang=<?php echo $selected?>"><div class="button-holder">Manual</div></a>
            <a lang="sk" href="documentation.php?lang=<?php echo $selected?>"><div class="button-holder">Dokumentácia</div></a>
            <a lang="en" href="documentation.php?lang=<?php echo $selected?>"><div class="button-holder">Documentation</div></a>
            <form action="server.php" method="post">
                <input lang="sk" type="submit" class="menu-item" name="toCSV" value="Export do CSV">
                <input lang="en" type="submit" class="menu-item" name="toCSV" value="Export to CSV">
            </form>
            <form action="server.php" method="post">
                <input lang="sk" type="submit" class="menu-item" name="sendEmail" value="Odošli email">
                <input lang="en" type="submit" class="menu-item" name="sendEmail" value="Send Email">
            </form>

        </div>
    </div>


</div>

<div id="mainContent">
    <section>
        <div>
            <h2>Octave CLI</h2>
            <form action="server.php" id="octave-form" class="inventors-form" method="post"
                  enctype="multipart/form-data">
                <div class="box">
                    <label class="myLabel" lang="en" for="octave">Input: </label>
                    <label class="myLabel" lang="sk" for="octave">Vstup: </label>
                    <textarea name="octave" id="octave" class="area-box"></textarea>
                </div>
                <input lang="en" class="sub dropbtn" type="submit" value="Show">
                <input lang="sk" class="sub dropbtn" type="submit" value="Zobraz">
            </form>
            <hr>
            <h2 lang="en">Output</h2>
            <h2 lang="sk">Výstup</h2>
            <p><?php echo $result ?></p>
        </div>
        <div>
            <hr>
            <h2 lang="en">Enter size of obstacle</h2>
            <h2 lang="sk">Zadaj veľkosť prekážky</h2>
            <form id="r-form" action="server.php" class="inventors-form" method="post" enctype="multipart/form-data">
                <div class="box">
                    <label class="myLabel" lang="en" for="r">Input r: </label>
                    <label class="myLabel" lang="sk" for="r">Vstup r: </label>
                    <input type="number" step="0.01" name="r" id="r" required min="-0.1" max="0.1">
                </div>
                <input lang="en" class="sub dropbtn" type="submit" value="Show" id="submit">
                <input lang="sk" class="sub dropbtn" type="submit" value="Zobraz" id="submit">
            </form>
        </div>
    </section>

    <section>
        <hr>
        <h2 lang="en">Choose visualisation:</h2>
        <h2 lang="sk">Vyber spôsob vizualizácie:</h2>
        <div class="controls">
            <input type="checkbox" id="graph" value="graph" onclick="validate()" checked/>
            <label lang="en" for="graph">Graph</label>
            <label lang="sk" for="graph">Graf</label>
            <br>
            <input type="checkbox" id="anim" value="anim" onclick="validate()" checked/>
            <label for="anim" lang="en">Animation</label>
            <label for="anim" lang="sk">Animácia</label>
            <br>
        </div>

        <hr id="gLine">
        <div id="g">
            <h2 lang="sk">Graf</h2>
            <h2 lang="en">Graph</h2>
            <div id="chart"></div>
        </div>

        <hr id="aLine">
        <div id="a">
            <h2 lang="sk">Animácia</h2>
            <h2 lang="en">Animation</h2>
            <canvas id="canvas"></canvas>
        </div>
    </section>
</div>
<script>
    var newCanvas = document.querySelector("#canvas");
    var canvas = new fabric.Canvas(newCanvas, {width: 700, height: 400});

    fabric.Image.fromURL('/img/car.png', function (img) {
        var oImg = img.set({left: 260, top: 35}).scale(0.4);
        img.set({selectable : false});
        canvas.add(oImg);
    });

    fabric.Image.fromURL('/img/wheel.png', function (img) {
        var oImg = img.set({left: 302, top: 165}).scale(0.13);
        img.set({selectable : false});
        canvas.add(oImg);
    });

    function getCookie(cname) {
        //https://www.w3schools.com/js/js_cookies.asp
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
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
    } else {
        langSwitch.value = lang;
        switchLang(lang);
    }

    $('#lang-switch').change(function () {
        lang = $(this).val();
        document.cookie = "lang=" + lang;
        switchLang(lang);
        loadGraph();
    });

    function switchLang(lang) {
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
    var chart, arr, time;
    let carLabel, wheelLabel, loadingLabel, timeLabel, obstacleLabel;


    submit.addEventListener('click', () => {
        console.log(value.value)
        if (value.value < -0.1 || value.value > 0.1) {
            alert("Wrong input! Obstacle is too deep or high.")
            window.location.href = "index.php"
        } else {
            form1.submit()
        }

    })

    loadGraph();

    function loadGraph() {

        if (lang === "en") {
            carLabel = "Car";
            wheelLabel = "Wheel";
            loadingLabel = "Loading...";
            timeLabel = "Time(s)";
            obstacleLabel = "Obstacle height(m)";
        }
        if (lang === "sk") {
            carLabel = "Auto";
            wheelLabel = "Koleso";
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
                    tickAmount: 5,
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

        chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        arr = '<?php echo json_encode($tmp_r)?>';
        arr = JSON.parse(arr);

        if (arr !== null)
            update()
    }

    function update() {
        const wheel = [];
        const car = [];

        let item_array = [];
        arr.shift()
        arr.shift()

        document.addEventListener("DOMContentLoaded", function () {
            let counter = 0
            let prevCarVal, prevWheelVal;

            arr.forEach((item) => {
                time = setTimeout(function () {
                    item = item.trim()
                    item_array = item.split(" ");
                    const results = item_array.filter(element => {
                        return element !== '';
                    });
                    wheel.push(results[0])
                    car.push(results[1])

                    let carAdd = Math.abs(parseFloat(results[1]) * 100).toFixed(4);
                    let wheelAdd = Math.abs(parseFloat(results[0]) * 10).toFixed(4);
                    let carStr, wheelStr;

                    if (prevCarVal !== carAdd)
                        carStr = results[0].substring(0, 1) === "-" ? "-=" + carAdd.toString() : "+=" + carAdd.toString();
                    else
                        carStr = "+=0";

                    if (prevWheelVal !== wheelAdd)
                        wheelStr = results[1].substring(0, 1) === "-" ? "-=" + wheelAdd.toString() : "+=" + wheelAdd.toString();
                    else
                        wheelStr = "+=0";

                    prevCarVal = carAdd;
                    prevWheelVal = wheelAdd;

                    chart.updateSeries([
                        {
                            name: wheelLabel,
                            data: wheel
                        },
                        {
                            name: carLabel,
                            data: car
                        }
                    ])

                    canvas.item(0).animate('top', carStr, {
                        onChange: canvas.renderAll.bind(canvas),
                        duration: 1
                    });
                    canvas.item(1).animate('top', wheelStr, {
                        onChange: canvas.renderAll.bind(canvas),
                        duration: 1
                    });
                }, 50 * counter)
                counter++
            })
            clearTimeout(time)
        });
        validate()
    }

    function validate() {
        if (document.getElementById('graph').checked) {
            document.querySelector("#g").style.display = "block";
            document.querySelector("#gLine").style.display = "block";

        } else {
            document.querySelector("#g").style.display = "none";
            document.querySelector("#gLine").style.display = "none";

        }
        if (document.getElementById('anim').checked) {
            document.querySelector("#a").style.display = "block";
            document.querySelector("#aLine").style.display = "block";

        } else {
            document.querySelector("#a").style.display = "none";
            document.querySelector("#aLine").style.display = "none";

        }
    }
</script>
</body>
</html>