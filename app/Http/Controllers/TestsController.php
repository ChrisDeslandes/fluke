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
            return response()->json(TestResult::all(), 200,
                ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
        }
        return response()->json(['mensagem' => 'Não há registros no banco de dados!'], 200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function show(int $id)
    {
        if ($id == 0) {
            return $this->index();
        }
        $test = TestResult::find($id);
        if ($test) {
            return response()->json($test, 200,
                ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
        }
        return response()->json(['mensagem' => 'Registro não encontrado!'], 404,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function store(Request $request)
    {
        TestResult::create([
            'name' => $request->name
        ]);
        return response()->json(['mensagem' => 'Registro adicionado com sucesso!'], 200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function update(int $id, Request $request)
    {
        $test = TestResult::find($id);
        if ($test) {
            $test->fill($request->all());
            $test->save();
            return response()->json(['mensagem' => 'Registro alterado com sucesso!'], 200,
                ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
        }
        return response()->json(['mensagem' => 'Registro não encontrado!'],404,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function destroy(int $id)
    {
        $test = TestResult::find($id);
        if ($test) {
            $test->delete();
            return response()->json(['mensagem' => 'Registro excluído com sucesso!'], 200,
                ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
        }
        return response()->json(['mensagem' => 'Registro não encontrado!'],404,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }
}
