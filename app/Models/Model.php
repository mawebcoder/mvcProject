<?php

namespace App\Models;

use PDO;
use PDOException;

class Model
{

    public static PDO $connection;

    public function __construct()
    {


        try {

            $username = DB_USERNAME;
            $password = DB_PASSWORD;
            $host = DB_HOST;
            $dbname = DB_DATABASE;

            $dsn = "mysql:host=$host;dbname=$dbname";

            self::$connection = new PDO($dsn, $username, $password);

            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $exception) {

            echo $exception->getMessage();

            die();
        }

        $query = "set character set utf8";

        self::$connection->exec($query);
    }

    protected function query(string $query, array $values = null)
    {
        try {

            $statement = self::$connection->prepare($query);

            if ($values) {
                $counter = 1;
                foreach ($values as $value) {

                    $statement->bindValue($counter, $value);
                }
            }

            $statement->execute();

            return $statement;

        } catch (PDOException $exception) {
            echo $exception->getMessage();
            die();
        }
    }

    /**
     * @param string $query
     * @param array|null $values
     * @return bool|array
     */
    protected function select(string $query, array $values = null): bool|array
    {
        $statement = $this->query($query, $values);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }



}