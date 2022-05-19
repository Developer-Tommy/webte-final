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
                <textarea name="octave" id="octave" class="area-box"></textarea>
            </div>
            <input class="sub" type="submit" value="Show">
        </form>
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
    </div>
</section>
<script>
    const submit = document.getElementById("submit")
    const form1 = document.getElementById("r-form")
    const form2 = document.getElementById("octave-form")
    const value = document.getElementById("r")

    form2.addEventListener('submit', (event) => {
        event.preventDefault()
    })

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