<?php

namespace App\Models\Traits;

trait CrudTrait
{
    use ColumnAndResultSearchTrait;

    protected $fetchMode = \PDO::FETCH_ASSOC;

    final public function scopeInstance()
    {
        return $this;
    }

    final public function scopeCount(array $args =[])
    {
        $data = $this->where($args);

        return $this->one("SELECT COUNT(*) AS nCount FROM {$this->schema}.{$this->table} {$data['where']}", $data['params']);
    }

    final public function scopeAll($orderBy = '')
    {
        if ($orderBy === '') {
            $orderBy = "{$this->key} DESC";
        }

        return $this->db->query("SELECT * FROM {$this->schema}.{$this->table} ORDER BY {$orderBy}")->fetchAll($this->fetchMode);
    }

    final public function scopeSearch(array $args = [], $callback = null)
    {
        $data = $this->where($args);

        $sql = "SELECT * FROM {$this->schema}.{$this->table} {$data['where']} ";

        if (! is_null($callback)) {
            $sql = $callback($sql);
        }

        return $this->results($sql, $data['params']);
    }

    final public function scopeFind($search)
    {
        $data = $this->where($search);

        return $this->row("SELECT * FROM {$this->schema}.{$this->table} {$data['where']}", $data['params']);
    }

    final public function scopeInsert(array $args = [])
    {
        $sql = sprintf("INSERT INTO {$this->schema}.{$this->table}(%s) VALUES (:%s)", implode(', ', array_keys($args)), implode(', :', array_keys($args)));
        $result = $this->db->prepare($sql)->execute($args);
        if ($result) {
            if ((int) $this->db->lastInsertId() === 0) {
                return $result;
            } else {
                return (int) $this->db->lastInsertId();
            }
        }

        return 0;
    }

    final public function scopeUpdate($search, array $args = [])
    {
        $values = [];

        foreach ($args as $column => $value) {
            array_push($values, sprintf('%s = :%s', $column, $column));
        }

        $data = $this->where($search);

        $sql = sprintf("UPDATE {$this->schema}.{$this->table} SET %s {$data['where']}", implode(', ', $values));

        return $this->db->prepare($sql)->execute(array_merge($args, $data['params']));
    }

    final public function scopeDelete($search)
    {
        $data = $this->where($search);

        return $this->db->prepare("DELETE FROM {$this->schema}.{$this->table} {$data['where']}")->execute($data['params']);
    }
}
