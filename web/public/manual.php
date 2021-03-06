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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
            integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    <h1 lang="sk">Popis Api služby</h1>
    <h1 lang="en">Description of Api service</h1>

    <button class="dropbtn pdf" lang="sk" onclick="savePDF()" data-html2canvas-ignore="true">Ulož ako PDF</button>
    <button class="dropbtn pdf" lang="en" onclick="savePDF()" data-html2canvas-ignore="true">Save as PDF</button>

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
        <h2 lang="sk">Dvojjazyčná stránka</h2>
        <h2 lang="en">Bilingual site</h2>
        <p lang="sk">
            Táto aplikácia je dostupná v dvoch jazykoch, a to v <strong>Slovenčine</strong> a <strong>Angličtine</strong>.
            Vo vrchnej lište hlavnej stránky je možnosť si zvoliť v akom jazyku sa má stránka zobrazovať.
            Svoj výber potvrdíte stlačením tlačidla "Potvrď jazyk".
        </p>
        <p lang="en">
            This app is available in two languages, <strong> Slovak </strong> and <strong> English </strong>.
            In the top bar of the main page there is an checkbox to choose in which language the page should be displayed.
            To confirm your selection, press the "Confirm language" button.
        </p>
        <h2 lang="sk">Octave príkazový riadok</h2>
        <h2 lang="en">Octave Command Line Interface</h2>
        <p lang="sk">
            Prvý formulár s názvom "Octave CLI" poskytuje textové pole pre zadávanie príkazov. Serverová strana
            aplikácie príjme odoslanú požiadavku a vytvorí spúšťací script s daným príkazom, ktorý
            odošle na nainštalovaný octave server pomocou príkazu <i><strong>"octave cli --evel 'meno vytvoreného script
                    súboru'"</strong></i>.
            Vrátená požiadavka sa vracia zo strany servera späť na klientskú časť a je zobrazená
            uživateľovi, ktorý požiadavku odoslal.
        </p>
        <p lang="en">
            The first form, called "Octave CLI", provides a text box for entering commands. The server side of the
            application receives the sent request and creates a startup script with the given command, which is sent to
            the installed octave server using the command <i><strong>"octave cli --evel 'name of the created script
                    file'"</strong></i>. The
            returned request is returned by the server to the client and is displayed to the user who sent the
            request.
        </p>
        <h2 lang="sk">Nábeh na prekážku</h2>
        <h2 lang="en">Obstacle course</h2>
        <p lang="sk">
            Formulár číslo dva poskytuje vstupný bod pre veľkosť požadovanej prekážky, na ktorú auto s kolesom môže
            nabehnúť. Táto hodnota je udávaná v metroch v rozsahu <-0,1 ; 0,1>. Po zadaní a potvrdení,
            sa na strane servera príjme pomocou POST funkcie zvolená hodnota <strong>r</strong>. Hodnota v premennej
            <strong>r</strong> sa vloží do
            príkazu, ktorý sa odošle na octave server v podobe script súboru, podobne ako v predošlom prípade pomocou
            PHP
            funkcie exec().
            Server príjma výstup z octave servera a uloží ho do session premennej, ktorá sa vracia späť na klienskú
            stranu aplikácie. Server zároveň ukladá dáta, ktoré sa pri druhom spustení použijú ako počiatočné podmienky
            pre ďalšiu simuláciu.
        </p>
        <p lang="en">
            Form number two provides an entry point for the size of the obstacle required on which the car with the
            wheel can run. This value is given in meters in the range <-0.1; 0.1>. After entering and confirming, the
            selected value <strong>r</strong> is accepted on the server side using the post function. The value in the
            variable <strong>r</strong> is
            inserted into the command, which is sent to the octave server as a script file similarly to the previous
            case using the PHP function exec (). Server receives the output from the octave server and stores it in a
            session
            variable that returns to the client side of the application, and the server stores data that will be used as
            initial conditions for further simulation on the second run.
        </p>
        <h3 lang="sk">Príkaz odosielaný na octave server:</h3>
        <h3 lang="en">Command sent to octave server:</h3>
        <i>"m1 = 2500; m2 = 320;k1 = 80000; k2 = 500000;b1 = 350; b2 = 15020;A=[0 1 0 0;-(b1*b2)/(m1*m2) 0
            ((b1/m1)*((b1/m1)+(b1/m2)+(b2/m2)))-(k1/m1) -(b1/m1);b2/m2 0 -((b1/m1)+(b1/m2)+(b2/m2)) 1;k2/m2 0
            -((k1/m1)+(k1/m2)+(k2/m2)) 0];B=[0 0;1/m1 (b1*b2)/(m1*m2);0 -(b2/m2);(1/m1)+(1/m2) -(k2/m2)];C=[0 0 1 0];
            D=[0
            0];Aa = [[A,[0 0 0 0]'];[C, 0]];Ba = [B;[0 0]];Ca = [C,0]; Da = D;K = [0 2.3e6 5e8 0 8e6];sys =
            ss(Aa-Ba(:,1)*K,Ba,Ca,Da);t = 0:0.01:5;r =<strong>"zvolená hodnota r"</strong>;initX1=0; initX1d=0;initX2=0;
            initX2d=0;[y,t,x]=lsim(sys*[0;1],r*ones(size(t)),t,[initX1;initX1d;initX2;initX2d;0]);</i>
        <h2 lang="sk">Logovanie dát zo simulácie</h2>
        <h2 lang="en">Simulation data logging</h2>
        <p lang="sk">
            Všetky požiadavky posielané na server su ukladané do databázy. Pri prijatí novej požiadavky, server vykoná
            komunikáciu so serverom octave. Použité príkazy a aj informácie či všetko prebehlo v poriadku sú vkladané do
            databázy aj s aktuálnym dátumom vykonania požiadavky.
        </p>
        <p lang="en">
            All requests sent to the server are stored in the database. When a new request is received, the server
            executes communication with the octave server. The command used and also the information on whether
            everything went well are inserted into database with the current execution date of the request.
        </p>
        <h2 lang="sk">Export dát do CSV súboru</h2>
        <h2 lang="en">Export to CSV file</h2>
        <p lang="sk">
            Hlavná strana klienskej aplikácie umožňuje stiahnutie logov z databázy do csv súboru, kde sú dáta zapisané
            vo formáte <strong>("ID", "Command", "Timestamp", "Info")</strong>.
            Po stlačení tlačidla "Export to CSV" server stiahne z databázy všetky logy a umožní uživateľovi zvoliť
            umiestnenie pre sťahovaný CSV súbor.
        </p>
        <p lang="en">
            The main page of the client application allows downloading logs from the database to a csv file, where the
            data is written in the format <strong>("ID", "Command", "Timestamp", "Info")</strong>. After pressing the
            "Export to CSV"
            button, the server downloads all logs from the database and allows the user to select a location for the
            downloaded CSV file.
        </p>
        <h2 lang="sk">Uloženie manuálu do PDF súboru</h2>
        <h2 lang="en">Save manual to PDF file</h2>
        <p lang="sk">
            Táto podstranka aplikácie umožňuje stiahnutie manuálu do PDF súboru.
            Po stlačení tlačidla "Ulož ako PDF" server vygeneruje optimalizovaný PDF súbor, ktorý si je možné stiahnuť na vami zvolené miesto.
        </p>
        <p lang="en">
            This subpage of the application allows you to download the manual to a PDF file.
            After pressing the "Save as PDF" button, the server will generate an optimized PDF file that can be downloaded to a location of your choice.
        </p>
    </div>

</section>
</div>
<script>

    function savePDF() {
        var element = document.getElementById('desc');
        var opt = {
            margin: 10,
            filename: 'manual.pdf',
            image: {type: 'jpeg', quality: 0.98},
            html2canvas: {scale: 10},
        };
        html2pdf().set(opt).from(element).save();
    }

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