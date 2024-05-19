<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\EnderecoVisita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\isNull;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $page = 1)
    {
        try {
            $page = $page < 1 ? 1 : $page;
            $registros = $page * 10;
            $enderecos = Endereco::paginate($registros);

            return view('endereco.index', compact('enderecos'));
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Ocorreu um erro ao recuperar endereços!');
        }

    }

    public function view(int $id)
    {
        try {
            $endereco = Endereco::find($id);
            $visitas = DB::table('enderecos_visitas')
                    ->where('rota', $endereco->slug)
                    ->count();

            return view('endereco.view', compact(['endereco','visitas']));
        }catch (\Exception $e){
            dd($e->getMessage());
            Log::error($e->getMessage());
            return redirect()->route('endereco')->withErrors(['error' => 'Ocorreu um erro ao recuperar o endereço!']);
        }

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
        try {
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
                    return redirect()->route('endereco.view', ['id' => $endereco->id])->with('success', 'endereco cadastrado com sucesso!');
                }
            }
            return view('endereco.create');
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('endereco.create')->with('error', $e->getMessage());
        }

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        try {
            $endereco = Endereco::find($id);
            return view('endereco.edit', compact('endereco'));
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('endereco.view', ['id' => $id])->with('error', 'Ocorreu um erro ao recuperar o endereco!');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $endereco, Request $request)
    {
        try {
            $validated = (object)$request->validate([
                'id' => 'required',
                'slug' => 'required|max:255',
                'slug_para' => 'required|max:255',
                'nome' => 'required|max:255',
            ]);

            $endereco = Endereco::find($validated->id);
            $user = auth()->user();
            $endereco->id = $validated->id;
            $endereco->nome = $validated->nome;
            $endereco->slug = $validated->slug;
            $endereco->slug_para = $validated->slug_para;
            $endereco->id_usuario = $user->id;
            $resultado = $endereco->update();

            if ($resultado) {
                return redirect()->route('endereco.view', ['id' => $endereco->id])->with('success', 'endereco atualizado com sucesso!');
            }
            return view('endereco.edit', compact('endereco'));
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return view('endereco.edit', compact('endereco'))->with('error', 'Ocorreu um erro ao atualizar o endereco!');
        }

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
            Log::error($e->getMessage());
            return response()->json(['resultado' => '', 'erro' => true], 500);
        }
    }
}
