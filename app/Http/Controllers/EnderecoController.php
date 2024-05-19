<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $page = 1)
    {
        $page = $page < 1 ? 1 : $page;
        $registros = $page * 10;
        $enderecos = Endereco::paginate($registros);

        return view('endereco.index', compact('enderecos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        dd($request->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|max:255',
            'slug_para' => 'required|max:255',
        ]);
        dd($validated);
        $jaExiste = Endereco::where('slug_para', $slug_para)->first();
        if ($jaExiste == null) {
            $usuario = auth()->user();
            $endereco = new Endereco();
            $endereco->slug = $slug;
            $endereco->slug_para = $slug_para;
            $endereco->id_usuario = $usuario->id;
            $endereco->save();
        }
        return redirect()->route('endereco');
    }

    /**
     * Display the specified resource.
     */
    public function show(Endereco $endereco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Endereco $endereco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Endereco $endereco)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $endereco)
    {
        try {
            $resultado = Endereco::destroy($endereco);
            return response()->json(['resultado' => $resultado, 'erro' => false], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['resultado' => '', 'erro' => true], 500);
        }
    }
}
