<?php
class Database
{
    public function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "BankingApp";
        $port = 3306;

        try {
            return new mysqli($servername, $username, $password, $dbname, $port);
        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception("Error Processing Request", $th->getCode(), $th);
        }
    }
}
?>