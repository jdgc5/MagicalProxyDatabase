<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;

class SettingController extends Controller
{
    public function index()
    {
        // parte superior con el radio button
        $checkedList = '';
        $checkedCreate = '';
        $afterInsert = session('afterInsert', 'show cartas');
        if ($afterInsert == 'show cartas') {
            $checkedList = 'checked';
        } else {
            $checkedCreate = 'checked';
        }
        
        // parte inferior con el select
        $afterEdit = session('afterEdit','edit');
        $afterEditOptions = [
            "carta" => 'Show all cartas list',
            "edit" => 'Show edit cartas form',
            "show" => 'Show cartas'
        ];

        return view('setting.index', [
            'checkedList' => $checkedList,
            'checkedCreate' => $checkedCreate,
            'afterEditOptions' => $afterEditOptions,
            'editOption' => $afterEdit
        ]);
    }
    
    public function update(Request $request)
    {
        session(['afterInsert' => $request->afterInsert, 'afterEdit' => $request->afterEdit]);

        return redirect('carta')->with(['message' => 'Settings have been updated.']);
        return back()->with(['message' => 'Settings have been updated.']);
    }
}

