<?php
$lg = $_GET['lang'];
?>
<!doctype html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
    <title>CAS API</title>
    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&family=Open+Sans:ital,wght@1,300&display=swap"
          rel="stylesheet">
</head>
<body>
<div id="mainHeader">
    <h1>CAS API</h1>
    <div class="dropdown">
        <button class="dropbtn">Menu</button>
        <div class="dropdown-content">
            <a lang="sk" href="manual.php?lang=<?php echo $lg ?>"><div class="button-holder">Návod</div></a>
            <a lang="en" href="manual.php?lang=<?php echo $lg ?>"><div class="button-holder">Guide</div></a>
            <a lang="sk" href="documentation.php?lang=<?php echo $lg ?>"><div class="button-holder">Dokumentácia</div></a>
            <a lang="en" href="documentation.php?lang=<?php echo $lg ?>"><div class="button-holder">Documentation</div></a>
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
<section id="desc">
    <h1 lang="sk">Technická dokumentácia</h1>
    <h1 lang="en">Technical documentation</h1>

    <a lang="sk" href="index.php">
        <button class="dropbtn pdf" data-html2canvas-ignore="true">Domovská stránka</button>
    </a>
    <a lang="en" href="index.php">
        <button class="dropbtn pdf" data-html2canvas-ignore="true">Homepage</button>
    </a>

    <div id="content">
        <p lang="sk">
            Vitajte na našej stránke, ktorá poskytuje API pre animáciu dynamického systému <strong>„tlmič
                automobilu"</strong>. API
            generuje graf a spúšťa animáciu na
            základe vstupných hodnôt. Hodnota <strong>r</strong> poskytuje veľkosť zvolenej prekážky, na ktorú auto s
            kolesom nabieha. Na
            základe vypočítaných hodnôt sa graf aj animáciu aktualizujú.
        </p>
        <p lang="en">
            Welcome to our page, which provides an API for the animation of the dynamic system <strong>"car
                damper"</strong>. The
            API generates a graph and starts the animation based on the input values. The value of <strong>r</strong>
            provides the size
            of the selected obstacle that the car with the wheel is approaching. Based on the calculated values, both
            the graph and the animation are updated.
        </p>

        <h2 lang="sk">Využité technológie</h2>
        <h2 lang="en">Technologies used</h2>
        <p lang="sk">
            Nginx, PHP-FPM, Composer, MySQL, PHPMyAdmin, Octave, Docker, Git
        </p>
        <p lang="en">
            Nginx, PHP-FPM, Composer, MySQL, PHPMyAdmin, Octave, Docker, Git
        </p>

        <h2 lang="sk">Inštalácia</h2>
        <h2 lang="en">Installation</h2>
        <p lang="sk">
            Inštalácia prebieha pomocou terminálu. Je potrebné mať predinštalovaný Git, Docker a Docker Compose. <br>
            Naklonujeme si repozitár kde je pripravený docker so systémom Nginx, PHP-FPM, Composer, MySQL,PHPMyAdmin a
            Octave. <br>
        </p>
        <p lang="en">
            The installation is performed using a terminal. You need to have Git, Docker and Docker Compose
            pre-installed. <br>
            We clone a repository where a docker with Nginx, PHP-FPM, Composer, MySQL, PHPMyAdmin and Octave is ready.
            <br>
        </p>
        <a href="https://github.com/matej172/php-docker-example/tree/octave"
           style="color: black; font-size: large; font-weight: bold">https://github.com/matej172/php-docker-example/tree/octave</a>

        <h2 lang="sk">Náš repozitár</h2>
        <h2 lang="en">Our repository</h2>
        <a href="https://github.com/Developer-Tommy/webte-final"
           style="color: black; font-size: large; font-weight: bold">https://github.com/Developer-Tommy/webte-final</a>

        <h2 lang="sk">Spustenie</h2>
        <h2 lang="en">Initialisation</h2>
        <p lang="sk">
            Spuste terminál v priečinku, kde sa nachádza repozitár. <strong>../webte-final</strong> <br>
            Zadajte príkaz: <strong>docker-compose up</strong> <br>
            Počkajte dokým zbehne build celého projektu a naštartuje sa aplikácia. <br>
            Otvorte prehliadač a pripojte sa na adresu: <strong>http://localhost:8000/index.php</strong> <br> <br>
            Pre prácu s databázou je potrebné sa pripojiť na adresu: <strong>http://localhost:8080/</strong> <br>
            Prihlasovacie údaje do phpMyAdmin: <br>
        <ul lang="sk">
            <li><i> Server: </i> <strong> mysql </strong></li>
            <li><i> Používateľ: </i> <strong> dev </strong></li>
            <li><i> Heslo: </i> <strong> dev </strong></li>
        </ul>
        </p>
        <p lang="en">
            Start the terminal in the folder where the repository is located. <strong> ../webte-final </strong> <br>
            Enter the command: <strong> docker-compose up </strong> <br>
            Wait until the build of the whole project runs and the application starts. <br>
            Open a browser and connect to: <strong> http://localhost:8000/index.php </strong> <br> <br>
            To work with the database, you need to connect to: <strong> http://localhost:8080/</strong> <br>
            The login details for phpMyAdmin: <br>
        <ul lang="en">
            <li><i> Server: </i> <strong> mysql </strong></li>
            <li><i> User: </i> <strong> dev </strong></li>
            <li><i> Password: </i> <strong> dev </strong></li>
        </ul>
        </p>

        <h2 lang="sk">Potrebná databáza</h2>
        <h2 lang="en">Database needed</h2>
        <p lang="sk">
            Pre účely tohto projektu bola vytvorená databáza s jednou tabuľkou: <strong>logs</strong>. <br>
            Tabuľka obsahuje tieto stĺpce: <br>
        <ul lang="sk">
            <li><i>int</i> <strong> id </strong> (primárny klúč)</li>
            <li><i>text</i> <strong> command </strong></li>
            <li><i>timestamp</i> <strong> timestamp </strong></li>
            <li><i>varchar(64)</i> <strong> info </strong></li>
        </ul>
        </p>

        <p lang = "en">
            A single table database was created for this project: <strong> logs </strong>. <br>
            The table contains the following columns: <br>
        <ul lang = "en">
            <li> <i> int </i> <strong> id </strong> (primary key) </li>
            <li> <i> text </i> <strong> command </strong> </li>
            <li> <i> timestamp </i> <strong> timestamp </strong> </li>
            <li> <i> varchar (64) </i> <strong> info </strong> </li>
        </ul>
        </p>

        <h2 lang="sk" style="text-align: center">Rozdelenie úloh medzi členmi tímu</h2>
        <h2 lang="en" style="text-align: center">Division of tasks among team members</h2>
        <table>
            <thead>
            <tr>
                <th>Meno</th>
                <th>Úloha</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Miriam Šiškovičová</td>
                <td>dvojjazyčnosť</td>
            </tr>
            <tr>
                <td>Tomáš Knapčok, Ivan Lejko</td>
                <td>API ku CASzabezpečené API kľúčom alebo tokenom</td>
            </tr>
            <tr>
                <td>Daniel Šterbák</td>
                <td>animácia</td>
            </tr>
            <tr>
                <td>Daniel Šterbák</td>
                <td>graf synchronizovaný s animáciou</td>
            </tr>
            <tr>
                <td>Tomáš Knapčok</td>
                <td>overenie API cez formulár vrozsahu špecifikovanom vúlohe 5</td>
            </tr>
            <tr>
                <td>Ivan Lejko</td>
                <td>logovanie a export do csv+ odoslanie mailu</td>
            </tr>
            <tr>
                <td>Ivan Lejko</td>
                <td>export popisu API do pdf</td>
            </tr>
            <tr>
                <td>*neimplementované*</td>
                <td>synchrónne sledovanie experimentovania</td>
            </tr>
            <tr>
                <td>Miriam Šiškovičová</td>
                <td>docker balíček</td>
            </tr>
            <tr>
                <td>Tomáš Knapčok</td>
                <td>používanie verzionovacieho systému všetkými členmi tímu</td>
            </tr>
            <tr>
                <td>Daniel Šterbák, Miriam Šiškovičová</td>
                <td>finalizácia aplikácie</td>
            </tr>
            </tbody>
        </table>
    </div>
</section>
</div>
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