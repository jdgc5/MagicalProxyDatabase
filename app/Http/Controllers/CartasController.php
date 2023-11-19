<?php

namespace App\Http\Controllers;

use App\Models\Cartas;
use Illuminate\Http\Request;

class CartasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartas = Cartas::all(); //eloquent
        //dd($cartas);
        return view('carta.index', ['cartas' => $cartas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('carta.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    try {
        $imagePath = null;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->image->store('carta_images', 'carta_images');
        }

        $cartaData = $request->except('image');
        $cartaData['image'] = $imagePath;

        $carta = Cartas::create($cartaData);

        $afterInsert = session('afterInsert', 'show cartas');
        $target = 'carta';

        if ($afterInsert !== 'show cartas') {
            $target = 'carta/create';
        }

        return redirect()->route($target)->with('success', $carta->name . ' has been created');
    } catch (\Exception $e) {
        return back()->withInput()->withErrors(['message' => 'The Card has not been saved.']);
    }
}




    /**
     * Display the specified resource.
     */
    public function show(Cartas $cartum)
    {
        
        return view('carta.show',['carta'=> $cartum]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cartas $cartum)
    {
        return view('carta.edit',['carta'=> $cartum]);
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Cartas $cartum)
{
    
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $imagePath = $request->image->store('carta_images', 'carta_images');

        $cartum->image = $imagePath;
    }

    try {
        $cartum->fill($request->except('image')); 
        $result = $cartum->save();

        $afterEdit = session('afterEdit', 'carta');
        $target = 'carta'; 
        if ($afterEdit == 'carta') {
            $target = 'carta';
        } else if ($afterEdit == 'edit') {
            $target = 'carta/' . $cartum->id . '/edit';
        } else {
            $target = 'carta/' . $cartum->id; 
        }
        return redirect($target)->with('success', $cartum->name .' has been updated');
    } catch(\Exception $e) {
        \Log::error($e);
        return back()->withInput()->withErrors(['message' => 'The card has not been updated.']);
    }
}

public function updateImage(Request $request, Cartas $cartum)
{
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        try {
            // Eliminar imagen actual si existe
            if ($cartum->image) {
                Storage::disk('carta_images')->delete($cartum->image);
            }

            $imagePath = $request->image->store('carta_images', 'carta_images');
            
            $cartum->image = $imagePath;
            $cartum->save();

            return redirect()->route('carta.show', ['cartum' => $cartum])->with('success', 'Carta image has been updated');
        } catch (\Exception $e) {
            \Log::error($e);
            return back()->withErrors(['message' => 'Failed to update carta image']);
        }
    }

    return back()->withErrors(['message' => 'Invalid image or image not provided']);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cartas $cartum)
    {
        try {
            $cartum->delete();
            return redirect('carta')->with(['message' => 'The card has been deleted.']);
        } catch(\Exception $e) {
             return back()->withErrors(['message' => 'The card has not been deleted.']);
        }
    
    }
    
    function view(Request $request, $id){
        
        $carta=Cartas::find($id);
        dd([$id,$movie]);
        if ($carta == null){
            return abort(404);
        }
        
    }
    
        
}
