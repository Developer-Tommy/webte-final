<?php

namespace App\Controller;

use App\Helper\MyPDO;
use App\Model\Log;

//use MyPDO;
use PDO;

class LogController
{

    private PDO $conn;
    protected $db;

    public function __construct()
    {
        //$this->conn = (new Database())->getConnection();
        $this->db = MyPDO::instance();
    }

    public function getAllPeople()
    {
        $stmt = $this->conn->prepare("select osoby.*, count(p.placing) as gold_count from osoby left outer join (select * from umiestnenia where placing=1) p on p.person_id = osoby.id group by osoby.id;");
        $stmt->execute();

        $people = $stmt->fetchAll(PDO::FETCH_CLASS, "App\Model\Person");

        foreach ($people as $person) {
            $stmt = $this->conn->prepare("select umiestnenia.*, city from umiestnenia join oh on umiestnenia.oh_id = oh.id where person_id = :personId;");
            $stmt->bindParam(":personId", $person->getId(), PDO::PARAM_INT);
            $stmt->execute();
            $placements = $stmt->fetchAll(PDO::FETCH_CLASS, "App\Model\Placement");
            $person->setPlacements($placements);
        }

        return $people;
    }

    public function getPerson($id)
    {
        $stmt = $this->conn->prepare("select osoby.*, count(p.placing) as gold_count from osoby left outer join (select * from umiestnenia where placing=1) p on p.person_id = osoby.id where osoby.id = :personId;");
        $stmt->bindParam(":personId", $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "App\Model\Person");
        $person = $stmt->fetch();

        $stmt = $this->conn->prepare("select umiestnenia.*, city from umiestnenia join oh on umiestnenia.oh_id = oh.id where person_id = :personId;");
        $stmt->bindParam(":personId", $person->getId(), PDO::PARAM_INT);
        $stmt->execute();
        $placements = $stmt->fetchAll(PDO::FETCH_CLASS, "App\Model\Placement");
        $person->setPlacements($placements);

        return $person;
    }

    public function insertLog(Log $log)
    {
        $command = $log->getCommand();
        $info = $log->getInfo();
        $this->db->run("INSERT into logs (`command`, `info`) values (?, ?)", [$command, $info,]);

//        echo $info;
//        try {
//            $stmt = $this->conn->prepare("insert into logs (`command`, `info`) values (:commad, :info)");
//            //$stmt->bindParam(":command", $command);
//            //$stmt->bindParam(":info", $info);
//            $stmt->execute(array(':command' => $command, ':info' => $info));
//        }
//        catch (PDOException $e) {
//            echo "<br>" . $e->getMessage();
//        }

    }

    public function updatePerson(Log $person)
    {
        $stmt = $this->conn->prepare("update osoby set name=:name, surname=:surname where id=:personId");
        $name = $person->getName();
        $id = $person->getId();
        $surname = $person->getSurname();
        $stmt->bindParam(":personId", $id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
        $stmt->execute();
    }

}
