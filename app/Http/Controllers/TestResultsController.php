<?php

namespace App\Http\Controllers;

use App\Models\TestResult;
use Illuminate\Http\Request;

class TestResultsController extends Controller
{
    public function index(int $test_record_id)
    {
        $testResults = TestResult::query()->where('test_record_id', $test_record_id)->get();
        if (count($testResults)) {
            return $this->jsonResponse($testResults,200);
        }
        return $this->jsonResponse(null,200);
    }

    public function show(int $test_result_id)
    {
        $testResult = TestResult::find($test_result_id);
        if ($testResult) {
            return $this->jsonResponse($testResult,200);
        }
        return $this->jsonResponse(['erro' => 'Registro não encontrado!'],404);
    }

    public function update(int $test_result_id, Request $request)
    {
        $testResult = TestResult::find($test_result_id);
        if ($testResult) {
            if ($request->test_element) {
                $testResult->test_element = $request->test_element;
            }
            if ($request->procedure) {
                $testResult->procedure = $request->procedure;
            }
            $testResult->save();
            return $this->jsonResponse(["mensagem" => "Campo(s) 'test_element' e/ou 'procedure' alterado(s) com sucesso!"],200);
        }
        return $this->jsonResponse(['erro' => 'Registro não encontrado!'],404);
    }

    public function destroy(int $test_result_id)
    {
        return $this->destroyTestResult($test_result_id);
    }
}
