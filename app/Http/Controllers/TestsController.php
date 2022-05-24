<?php

namespace App\Http\Controllers;

use App\Models\TestResult;
use Illuminate\Http\Request;

class TestsController extends Controller
{
    public function index()
    {
        $result = TestResult::all();
        if ($result->count()) {
            return response()->json(TestResult::all());
        }
        return response()->json(['mensagem' => 'Não há registros no banco de dados!']);
    }

    public function show(int $id)
    {
        if ($id == 0) {
            return $this->index();
        }
        $test = TestResult::find($id);
        if ($test) {
            return response()->json($test);
        }
        return response()->json(['mensagem' => 'Registro não encontrado!'], 404);
    }

    public function store(Request $request)
    {
        TestResult::create([
            'name' => $request->name
        ]);
        return response()->json(['mensagem' => 'Registro adicionado com sucesso!'], 201);
    }

    public function update(int $id, Request $request)
    {
        $test = TestResult::find($id);
        if ($test) {
            $test->fill($request->all());
            $test->save();
            return response()->json(['mensagem' => 'Registro alterado com sucesso!']);
        }
        return response()->json(['mensagem' => 'Registro não encontrado!'],404);
    }

    public function destroy(int $id)
    {
        $test = TestResult::find($id);
        if ($test) {
            $test->delete();
            return response()->json(['mensagem' => 'Registro excluído com sucesso!']);
        }
        return response()->json(['mensagem' => 'Registro não encontrado!'],404);
    }
}
