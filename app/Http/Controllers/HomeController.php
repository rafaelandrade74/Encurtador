<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class HomeController extends Controller
{
    public function index(string $slug)
    {
        try {
            $endereco = Endereco::where('slug', $slug)->firstOrFail();
            return redirect()->away($endereco->slug_para);
        }catch (\Exception $exception){
            return redirect()->away(Env('APP_URL_FALLBACK'));
        }
    }
}
