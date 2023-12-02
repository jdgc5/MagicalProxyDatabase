<?php

namespace App\Http\Controllers;

use App\Models\Cartas;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

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
        $cartaData = $this->validateCartaData($request);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $archivo = $request->file('image');
            $tipoArchivo = $archivo->getClientMimeType();
            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];

            if (in_array($tipoArchivo, $tiposPermitidos)) {
                $cartaData['image'] = $this->processAndSaveImage($archivo);
            } else {
                throw new \Exception('Tipo de archivo no permitido');
            }
        }

        $carta = Cartas::create($cartaData);
        
        $afterInsert = session('afterInsert', 'show cartas');
        $target = 'carta.index';

        if ($afterInsert !== 'show cartas') {
            $target = 'carta.create';
        }

        return redirect()->route($target)->with('success', 'La carta ha sido creada correctamente.');
    } catch (\Exception $e) {
        return back()->withInput()->withErrors(['message' => $e->getMessage()]);
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
            $image = $request->file('image');
            
        if ($cartum->image) {
            Storage::disk('carta_images')->delete($cartum->image);
        }
        
        $imagePath = $this->processAndSaveImage($image);
        
        $cartum->image = $imagePath;
        $cartum->save();
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

function view(Request $request, $id)
{
    $carta=Cartas::find($id);
    dd([$id,$movie]);
    if ($carta == null){
        return abort(404);
    }
}
    
private function processAndSaveImage($image)
{
    $img = Image::make($image);
    $img->resize(300, 300, function ($constraint) {
        $constraint->aspectRatio(); 
        $constraint->upsize();
    });
    $imagePath = 'carta_images/' . uniqid('image_') . '.' . $image->getClientOriginalExtension();
    Storage::disk('carta_images')->put($imagePath, (string) $img->encode());
    return $imagePath;
}

private function validateCartaData($request)
{
    return $request->validate([
        'name' => 'required|string|max:60',
        'color' => 'required|string|max:20',
        'type' => 'required|string|max:20',
        'rarity' => 'required|string|max:20',
        'edition' => 'required|string|max:20',
        'year' => 'nullable|integer',
    ]);
}
    
        
}


