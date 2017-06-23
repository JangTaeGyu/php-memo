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
        return view('memo/create.php');
    }

    public function store()
    {
        $request = request('POST', [
            'memo' => ''
        ]);

        try {
            $validation = \Validation::make($request, ['memo' => '메모::required'])->validate();
            if (! $validation['result']) {
                throw new \Exception($validation['messages'][0]);
            }

            $result = Memo::insert([
                'memo' => tagAllowable($request['memo']), 'user_id' => session('id'), 'created_at' => date('Y-m-d H:i:s')
            ]);
            if ((int) $result === 0) {
                throw new \Exception("메모 작성에 실패하였습니다. 다시 시도해 주세요.");
            }

        } catch (\Exception $e) {

            \Session::flash('fail', $e->getMessage());

            redirect('/memo/create');
        }

        \Session::flash('success', '메모 작성에 성공하셨습니다.');

        redirect(APP_URL);
    }

    public function view()
    {
        $request = request('GET', [
            'search_word' => '', 'id' => ''
        ]);
    }
}
