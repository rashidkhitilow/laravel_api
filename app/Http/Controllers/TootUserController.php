<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TootUserController extends Controller
{
    public function index(Request $req)
    {
        $all = $this->all($req);
        $mode = 'all';
        return view('toot_users.index', compact('all', 'mode'));
    }
    public function filter(Request $req)
    {
        $all = $this->all($req);
        return view('toot_users.tbl', compact('all'));
    }
    public function all(Request $req)
    {
        // MyUtils::dbEnableLog();
        $url = config('app.TOOT_BACKEND_URL', 'https://be1.toot.events').'/api/v1/users/browse?term=';
        if ($req->input('page') != '') $url=$url.'&page='.$req->input('page');
        if ($req->input('ff__first_name') != '') $url=$url.'&first_name='.$req->input('ff__first_name');
        if ($req->input('ff__last_name') != '') $url=$url.'&last_name='.$req->input('ff__last_name');
        if ($req->input('ff__email') != '') $url=$url.'&email='.$req->input('ff__email');
        if ($req->input('ff__matrix_user_id') != '') $url=$url.'&matrix_user_id='.$req->input('ff__matrix_user_id');
        $response = Http::get($url);
        $items = json_decode($response->body());
        return compact('items');
    }
}
