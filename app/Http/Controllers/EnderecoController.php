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

    public function view(int $id)
    {
        $endereco = Endereco::find($id);

        return view('endereco.view', compact('endereco'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('endereco.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = (object)$request->validate([
            'slug' => 'required|max:255',
            'slug_para' => 'required|max:255',
            'nome' => 'required|max:255',
        ]);

        $jaExiste = Endereco::where('slug_para', $validated->slug_para)->first();
        if ($jaExiste == null) {
            $user = auth()->user();
            $endereco = new Endereco();
            $endereco->nome = $validated->nome;
            $endereco->slug = $validated->slug;
            $endereco->slug_para = $validated->slug_para;
            $endereco->id_usuario = $user->id;
            $resultado = $endereco->save();

            if ($resultado) {
                return redirect()->route('endereco.view', ['id'=>$endereco->id])->with('success', 'Endereco cadastrado com sucesso!');
            }
        }
        return view('endereco.create');
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
