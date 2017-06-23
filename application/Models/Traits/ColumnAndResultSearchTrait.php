<?php

namespace App\Models\Traits;

trait ColumnAndResultSearchTrait
{
    final public function where($args)
    {
        $params = [];

        $where = 'WHERE 1 = 1';

        if (is_array($args)) {
            foreach ($args as $column => $value) {
                if ($value !== '') {
                    if (strpos($column, '|') === false) {
                        $params = array_merge($params, [$column => $value]);

                        $where .= ' AND ' . $column . ' = :' . $column;
                    } else {
                        $arr = explode('|', $column);

                        switch ($arr[0]) {
                            case '=':
                            case '<>':
                            case '<':
                            case '>':
                            case '<=':
                            case '>=':
                                $params = array_merge($params, [$arr[1] => $value]);

                                $where .= ' AND ' . $arr[1] . ' ' . $arr[0] . ' :' . $arr[1];
                                break;

                            case 'in':
                            case 'notIn':
                                $prefix = $arr[1] . 'Param';

                                foreach ($value as $subKey => $subValue) {
                                    $params[$prefix . $subKey] = $subValue;
                                }

                                $arr[0] = $arr[0] === 'in' ? 'IN' : 'NOT IN';

                                $where .= sprintf(' AND %s %s (:%s%s) ', $arr[1], $arr[0], $prefix, implode(',:' . $prefix, array_keys($value)));
                                break;

                            case 'like':
                                $params = array_merge($params, [$arr[1] => '%' . $value . '%']);

                                $where .= ' AND ' . $arr[1] . ' LIKE :' . $arr[1];
                                break;

                            case 'between':
                                $params = array_merge($params, ['first' => $arr[1][0], 'second' => $arr[1][1]]);

                                $where .= ' AND ' . $arr[1] . ' BETWEEN :first AND :second';
                                break;
                        }
                    }
                }
            }
        } else {
            if ($args != '') {
                $params = ['id' => $args];

                $where = "WHERE {$this->key} = :id";
            }
        }

        return [
            'params' => $params, 'where' => $where,
        ];
    }

    final public function one($sql = '', array $params = [])
    {
        $data = $this->row($sql, $params, \PDO::FETCH_NUM);
        if (is_array($data)) {
            return $data[0];
        }

        return '';
    }

    final public function row($sql = '', array $params = [], $mode = null)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetch(is_null($mode) ? $this->fetchMode : $mode);
    }

    final public function results($sql = '', array $params = [], $mode = null)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(is_null($mode) ? $this->fetchMode : $mode);
    }
}
