<?php

namespace App\Http\Controllers;

use App\Models\TestRecord;
use Illuminate\Http\Request;

class TestRecordsController extends Controller
{
    public function index()
    {
        $testRecords = TestRecord::all();
        if (count($testRecords)) {
            return $this->jsonResponse($testRecords,200);
        }
        return $this->jsonResponse(null,200);
    }

    public function show(int $test_record_id)
    {
        $testRecord = TestRecord::find($test_record_id);
        if ($testRecord) {
            return $this->jsonResponse($testRecord,200);
        }
        return $this->jsonResponse(['erro' => 'Registro não encontrado!'],404);
    }

    public function store(Request $request)
    {
        for ($i = 0; $i < count($request->records); $i++) {
            $this->newTestRecord($request->records[$i]);
        }
        return $this->jsonResponse(['mensagem' => 'Registro(s) adicionado(s) com sucesso!'],200);
    }

    public function destroy(int $test_record_id)
    {
        return $this->destroyTestRecord($test_record_id);
    }
}
