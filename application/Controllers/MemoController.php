<?php

namespace App\Controllers;

use App\Models\Memo;

class MemoController extends Controller
{
    public function index()
    {
        $request = request('GET', [
            'search_word' => ''
        ]);

        return view('memo/index.php', [
            'request' => $request,
            'memos' => Memo::instance()->getSearchAndUserJoin(['like|memo' => $request['search_word']])
        ]);
    }

    public function create()
    {
    }

    public function view()
    {
        $request = request('GET', [
            'search_word' => '', 'id' => ''
        ]);
    }
}
