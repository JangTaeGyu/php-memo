<?php

namespace App\Models;

class Session extends Model
{
    protected $schema = 'memo';

    protected $table = 'sessions';

    protected $key = 'session_id';

    public function info()
    {
        $sql = 'SELECT user.* FROM sessions AS session INNER JOIN users AS user ON user.id = session.user_id WHERE session.session_id = :session_id';

        return $this->row($sql, ['session_id' => session_id()]);
    }
}
