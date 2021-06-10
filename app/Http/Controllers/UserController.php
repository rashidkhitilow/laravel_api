<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $req)
    {
        $all = $this->all($req);
        $mode = 'all';
        return view('users.index', compact('all', 'mode'));
    }
    public function filter(Request $req)
    {
        $all = $this->all($req);
        return view('users.tbl', compact('all'));
    }
    public function all(Request $req)
    {
        // MyUtils::dbEnableLog();

        $page = $req->input('page', 1);
        $per_page = 50;
        $offset = ($page - 1) * $per_page;
        $pages = 0;


        $items =  new User();


        if ($req->input('ff__id') != '') $items = $items->where('users.id', $req->input('ff__id'));
        if ($req->input('ff__name') != '') $items = $items->where('users.name', $req->input('ff__name'));

        $items = $items->select(
            'users.*'
        );

        $items = $items->orderBy('id', 'desc');
        $items = $items->offset($offset)
                        ->limit($per_page)
                        ->get()
                        ->map(function ($item){
                            
                            return [
                                        'id' => $item->id,
                                        'name' => $item->name,
                                        'email' => $item->email,
                                        'phone' => $item->phone,
                                        'created_at' => $item->created_at->format('d.m.Y'),
                                        'handled_by' => $item->user,
                                ];
                        })
                        ;
        // dd(MyUtils::dbLog());
        return compact('per_page', 'page', 'offset', 'items', 'pages');
    }
    public function save(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        DB::beginTransaction();
        try {


            $item = User::findOrFail($req->id);

            $item->enquiry_type_id = $req->enquiry_type_id;
            $item->department_id = $req->department_id;
            $item->client_id = $req->client_id;
            $item->client_reference = $req->client_reference;
            $item->save();

            DB::commit();
            $result = 'success';
            $message = 'User was successfully updated!';
            return compact('result', 'message');
        } catch(Exception $e) {
            DB::rollBack();
            $result = 'fail';
            $message = $e->getMessage();
            return compact('result', 'message');
        }
    }
    public function new(Request $req)
    {
        $req->validate([
            'client_id' => 'required|integer',
            'enquiry_type_id' => 'required|numeric',
            'client_reference' => 'required',
            'date' => 'required|date',
        ]);
        DB::beginTransaction();
        try {
            $item = new User();
            $item->client_id = $req->client_id;
            $item->enquiry_type_id = $req->enquiry_type_id;
            $item->department_id = $req->department_id;
            $item->client_reference = $req->client_reference;
            $item->user_id = auth()->user()->id;
            $item->save();

            DB::commit();
            $result = 'success';
            $message = 'User was successfully created!';
            return compact('result', 'message', 'item');
        } catch(Exception $e) {
            DB::rollBack();
            $result = 'fail';
            $message = $e->getMessage();
            return compact('result', 'message');
        }
    }

    public function remove(Request $req)
    {
        DB::beginTransaction();
        try {

            $item = User::findOrFail($req->id);
            $item->delete();
            DB::commit();
            $result = 'success';
            return compact('result');
        } catch(Exception $e) {
            DB::rollBack();
            $result = 'fail';
            $message = $e->getMessage();
            return compact('result', 'message');
        }
    }


    public function autocomplete(Request $req)
    {
        $term = $req->input('term') ?? '';
        $page = $req->page ?? 1;
        $per_page = 10;
        $offset = ($page - 1) * $per_page;
        if ($term) {
            // DB::connection()->enableQueryLog();
            $a = User::where('id', 'like', '%' . $term . '%')
                ->offset($offset)
                ->limit($per_page)
                ->orderBy('id')
                ->get()
                ->map(function ($item) {
                    $label = $item->name;
                    return [
                        'value' => $label,
                        'id' => $item->id,
                        'text' => $label,
                        'label' => $label,
                        'title' => $item->name,
                    ];
                });
            // dd(DB::getQueryLog());
            return $a;
        } else {
            return [];
        }
    }
}
