<?php

namespace App\Http\Controllers;

use App\Models\Depoimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Image;

class DepoimentoController extends Controller
{
    public function index()
    {
        return Depoimento::all();
    }

    public function getDepoimentosHome()
    {
        $depoimentos = Depoimento::inRandomOrder()->limit(3)->get();

        return $depoimentos;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'depoimento' => 'required',
            'nome' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('images/' . $filename);

            $data['foto'] = $filename;
        }

        return Depoimento::create($data);
    }

    public function show(Depoimento $depoimento)
    {
        return $depoimento;
    }

    public function update(Request $request, Depoimento $depoimento)
    {
//        $depoimento->update($request->all());
//
//        return $depoimento;

        $validator = Validator::make($request->all(), [
            'foto' => 'nullable',
            'depoimento' => 'required|',
            'nome' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Validação falhou', 422, $validator->errors()]);
        }

        $validated = $validator->validated();


        $update = $depoimento->update([
            'foto' => $validated['foto'],
            'depoimento' => $validated['depoimento'],
            'nome' => $validated['nome'],
        ]);

        if ($update) {
            return response()->json('Feito com sucesso!');
        }

        response()->json('nao foi possivel atualizar');

    }

    public function destroy(Depoimento $depoimento)
    {
        $depoimento->delete();

        return response()->json(['message' => 'Deletado com sucesso!']);

    }
}
