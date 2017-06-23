<?php

namespace App\Models;

class Memo extends Model
{
    protected $schema = 'memo';

    protected $table = 'memos';

    protected $key = 'id';

    public function getSearchAndUserJoin(array $args = [])
    {
        $data = $this->where($args);

        $sql = " SELECT memo.*, user.name AS user_name, user.email AS user_email FROM memos AS memo ";
        $sql.= " INNER JOIN users AS user ON user.id = memo.user_id ";
        $sql.= " {$data['where']} ";
        $sql.= " ORDER BY memo.created_at DESC ";

        return $this->results($sql, $data['params']);
    }
}
