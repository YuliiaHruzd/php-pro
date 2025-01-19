<?php

trait Sql
{
    private array $fields = ['*'];
    private string $from;
    private array $where = [];
    private string|null $orderByField = null;
    private string|null $orderByDirection = null;

    public function select(array $fields): Sql
    {
        $this->fields = $fields;

        return $this;
    }

    public function from(string $table): Sql
    {
        $this->from = $table;

        return $this;
    }

    public function where(array $conditions): Sql
    {
        $this->where = $conditions;

        return $this;
    }

    public function orderBy($field = 'id', $direction = 'DESC'): Sql
    {
        $this->orderByField = $field;
        $this->orderByDirection = $direction;

        return $this;
    }

    public function find($id): string
    {
        $this->where = ['id' => $id];

        return $this->get();
    }

    public function findBy(string $field, $value): string
    {
        $this->where = [$field => $value];

        return $this->get();
    }

    public function update(array $values): string
    {
        $where = $this->buildWhere();
        $valuesSql = $this->buildUpdate($values);

        return "UPDATE $this->from SET $valuesSql$where";
    }

    public function create(array $values): string
    {
        $fields = join(', ', array_keys($values));
        $values = join(', ', array_values($values));

        return "INSERT INTO $this->from ($fields) VALUES ($values)";
    }

    public function delete(): string
    {
        $where = $this->buildWhere();

        return "DELETE FROM $this->from$where";
    }

    public function get(): string
    {
        return sprintf(
            'SELECT %s FROM %s%s%s',
            empty($this->fields) ? '' : join(', ', $this->fields),
             $this->from,
            empty($this->where) ? '' : $this->buildWhere(),
            $this->orderByField == null ? '' : " ORDER BY $this->orderByField $this->orderByDirection",
        );
    }

    public function buildWhere(): string
    {
        $sql = ' WHERE';
        $keyNumber = 0;

        foreach ($this->where as $key => $value) {

            if (0 == $keyNumber) {
                $sql = $sql . " $key=$value";
            } else {
                $sql = $sql . " AND $key=$value";
            }

            $keyNumber++;
        }

        return $sql;
    }

    public function buildUpdate(array $values): string
    {
        $sql = '';

        $countElements = count($values);
        $keyNumber = 1;

        foreach ($values as $key => $value) {
            if ($countElements != $keyNumber) {
                $sql = $sql . "$key=$value,";
            } else {
                $sql = $sql . "$key=$value";
            }

            $keyNumber++;
        }

        return $sql;
    }
}
