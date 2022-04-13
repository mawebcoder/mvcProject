<?php

namespace App\Models;

class Article extends Model
{

    const TABLE_NAME = 'articles';

    public function __construct()
    {

        parent::__construct();

        $this->createTable();
    }

    protected function createTable(): void
    {
        $query = "create table if not exists users (
        id bigint unsigned primary key auto_increment,
        title varchar(255) not null unique,
        text text not null,
        image_url varchar(255))";

        self::$connection->exec($query);
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return 'articles';
    }

}