<?php

use App\Controller\PersonController;
use App\Model\Person;

include '../app/vendor/autoload.php';

$personController = new PersonController();

if (isset($_POST['octave'])){
    $script = fopen("script.m", "w");
    fwrite($script, "pkg load control;");
    fwrite($script, $_POST['octave']);
    $output = null;
    $val = "octave-cli --eval script";
    exec($val, $output);
    var_dump($output);
    fclose($script);
}

if (isset($_POST['r'])){
    $script = fopen("script2.m", "w");
    fwrite($script, "pkg load control;");
    $r = $_POST['r'];
    $val = "m1 = 2500; m2 = 320;k1 = 80000; k2 = 500000;b1 = 350; b2 = 15020;A=[0 1 0 0;-(b1*b2)/(m1*m2) 0 ((b1/m1)*((b1/m1)+(b1/m2)+(b2/m2)))-(k1/m1) -(b1/m1);b2/m2 0 -((b1/m1)+(b1/m2)+(b2/m2)) 1;k2/m2 0 -((k1/m1)+(k1/m2)+(k2/m2)) 0];B=[0 0;1/m1 (b1*b2)/(m1*m2);0 -(b2/m2);(1/m1)+(1/m2) -(k2/m2)];C=[0 0 1 0]; D=[0 0];Aa = [[A,[0 0 0 0]'];[C, 0]];Ba = [B;[0 0]];Ca = [C,0]; Da = D;K = [0 2.3e6 5e8 0 8e6];sys = ss(Aa-Ba(:,1)*K,Ba,Ca,Da);t = 0:0.01:5;r =$r;initX1=0; initX1d=0;initX2=0; initX2d=0;[y,t,x]=lsim(sys*[0;1],r*ones(size(t)),t,[initX1;initX1d;initX2;initX2d;0]);save out.txt x y t";
    fwrite($script, $val);
    $octave = "octave-cli --eval script2";
    $out = null;
    exec($octave, $out);
    var_dump($out);

}

if(isset($_POST['name'])){

    if(isset($_POST['id']) && $_POST['id']){
        $person = $personController->getPerson($_POST['id']);
        $person->setName($_POST['name']);
        $person->setSurname($_POST['surname']);
        $personController->updatePerson($person);
    }else{

        $person = new Person();
        $person->setName($_POST['name']);
        $person->setSurname($_POST['surname']);

        $id = $personController->insertPerson($person);
        $person = $personController->getPerson($id);
    }

}else if(isset($_GET['id'])) {
    $person = $personController->getPerson($_GET['id']);
}

