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
<script>
    const submit = document.getElementById("submit")
    const form1 = document.getElementById("r-form")
    const form2 = document.getElementById("octave-form")
    const value = document.getElementById("r")

    submit.addEventListener('click', (e) => {
        console.log(value.value)
        if (value.value < -0.1 || value.value > 0.1) {
            alert("Too big or small")
            window.location.href = "index.php"
        }
        else form1.submit()

    })

</script>
</body>
</html>