<?php
$lg = $_GET['lang'];
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

<script>
    let lang = "<?php echo $lg?>";

    console.log(lang)

    if (lang === "") {
        langSwitch.value = "sk";
        $('[lang="sk"]').show();
        $('[lang="en"]').hide();
    }

    switchLang(lang)

    function switchLang(lang) {
        switch (lang) {
            case "en":
                $('[lang="en"]').show();
                $('[lang="sk"]').hide();
                break;
            case "sk":
                console.log("debil")
                $('[lang="sk"]').show();
                $('[lang="en"]').hide();
                break;
        }
    }
</script>
</body>
</html>