<?php

namespace App\Models;

class Category extends Model
{

    public function __construct()
    {
        parent::__construct();

        $this->generateTable();
    }


    public function generateTable()
    {
        $query = "create table if not exists categories (
                        id bigint unsigned primary key auto_increment,
                        title varchar (250) not null unique)";

        self::$connection->exec($query);
    }

    /**
     * @return bool|array
     */
    public function all(): bool|array
    {
        $query = "select * from categories";

        $stmt = $this->query($query);

        return $stmt->fetchAll();
    }


    public function find(int $id)
    {
        $query = "select * from categories where id =?";

        $stmt = $this->query($query, [$id]);

        return $stmt->fetch();

    }

    public function insert(array $values)
    {
        $query = "insert into categories (title) values(?)";

        $this->query($query, [$values['title']]);
    }

    public function update(int $id, array $values)
    {
        $query = "UPDATE categories SET title = ? where id = ?";

        $this->query($query, [$values['title'], $id]);
    }

    public function delete(int $id)
    {
        $query = "delete from categories where id =?";

        $this->query($query, [$id]);
    }



}