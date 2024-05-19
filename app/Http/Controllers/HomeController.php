<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\EnderecoVisita;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class HomeController extends Controller
{
    public function index(Request $request, string $slug = "")
    {
        try {
            $visita = new EnderecoVisita();
            $visita->ip = $request->ip();
            $visita->navegador = $request->header('User-Agent');
            $visita->rota = $slug;
            $visita->save();

            $endereco = Endereco::where('slug', $slug)->firstOrFail();

            return redirect()->away($endereco->slug_para);
        }catch (\Exception $exception){
            return redirect()->away(Env('APP_URL_FALLBACK'));
        }
    }
}
