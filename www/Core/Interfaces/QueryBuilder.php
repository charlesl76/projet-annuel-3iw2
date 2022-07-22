<?php
namespace App\Core\Interfaces;

interface QueryBuilder
{
    //Select
    public function select(string $table, array $columns): QueryBuilder;

    //Insert
    public function insert(string $table, array $columns): QueryBuilder;

    //Update
    public function update(string $table, array $columns): QueryBuilder;

    //Where
    public function where(string $column, ?string $value, string $operator = "="): QueryBuilder;

    //WhereOr
    public function whereOr(string $column, ?string $value, string $operator = "="): QueryBuilder;

    //LeftJoin
    public function leftJoin(string $table, string $fk, string $pk): QueryBuilder;

    //InnerJoin
    public function innerJoin(string $table, string $fk, string $pk): QueryBuilder;

    //RightJoin
    public function rightJoin(string $table, string $fk, string $pk): QueryBuilder;

    //GroupBy
    public function groupBy(array $columns): QueryBuilder;

    //OrderBy
    public function orderBy(string $column, string $direction = "ASC"): QueryBuilder;
    
    //Limit
    public function limit(int $from, int $offset): QueryBuilder;

    //Get
    public function get(): string;

    //Fetch
    public function fetch(string $called_classes);

    //FetchAll
    public function fetchAll(string $called_classes);

    //Count
    public function count();
}