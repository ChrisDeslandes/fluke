<?php

namespace App\Http\Controllers;

use App\Models\{ ItemResult, TestItem, TestRecord, TestResult };
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function jsonResponse($data, $code)
    {
        return response()->json($data, $code,
            ['Content-Type' => 'application/json;'],
            JSON_UNESCAPED_UNICODE
        );
    }

    protected function newTestRecord($record)
    {
        $newRecord = TestRecord::create([
            'date' => $record['date'],
            'record' => $record['record'],
            'template' => $record['template'],
            'template_version' => $record['template_version'],
            'ansur_version' => $record['ansur_version'],
            'plugin' => $record['plugin'],
            'plugin_version' => $record['plugin_version'],
            'device_serial_number' => $record['device_serial_number'],
            'device_model' => $record['device_model'],
            'mti_test_instrument' => $record['mti_test_instrument'],
            'mti_serial_number' => $record['mti_serial_number'],
            'mti_firmware_version' => $record['mti_firmware_version']
        ]);
        for ($i = 0; $i < count($record['test_results']); $i++) {
            $this->newTestResult($record['test_results'][$i], $newRecord->id);
        }
    }

    protected function newTestResult($result, $test_record_id)
    {
        if (TestRecord::find($test_record_id)) {
            $newResult = TestResult::create([
                'test_element' => $result['test_element'],
                'test_type' => $result['test_type'],
                'procedure' => $result['procedure'],
                'test_record_id' => $test_record_id
            ]);
            for ($i = 0; $i < count($result['test_items']); $i++) {
                $this->newTestItem($result['test_items'][$i], $newResult->id);
            }
        }
    }

    protected function newTestItem($testItem, $test_result_id)
    {
        if (TestResult::find($test_result_id)) {
            $newItem = TestItem::create([
                'name' => $testItem['name'],
                'success' => $testItem['success'],
                'test_result_id' => $test_result_id
            ]);
            for ($i = 0; $i < count($testItem['item_results']); $i++) {
                $this->newItemResult($testItem['item_results'][$i], $newItem->id);
            }
        }
    }

    protected function newItemResult($itemResult, $test_item_id)
    {
        if (TestItem::find($test_item_id)) {
            ItemResult::create([
                'lead' => $itemResult['lead'],
                'value' => $itemResult['value'],
                'unit' => $itemResult['unit'],
                'high_limit' => $itemResult['high_limit'],
                'low_limit' => $itemResult['low_limit'],
                'standard' => $itemResult['standard'],
                'test_item_id' => $test_item_id
            ]);
        }
    }

    protected function destroyTestRecord(int $test_record_id) {
        $testResults = TestResult::query()->where('test_record_id', $test_record_id)->get();
        foreach ($testResults as $testResult) {
            $this->destroyTestResult($testResult->id);
        }
        $test_record = TestRecord::find($test_record_id);
        if ($test_record) {
            $test_record->delete();
            return $this->jsonResponse(['mensagem' => 'Registro excluído com sucesso!'],200);
        } else {
            return $this->jsonResponse(['erro' => 'Registro não encontrado!'],404);
        }
    }

    protected function destroyTestResult(int $test_result_id) {
        $testItems = TestItem::query()->where('test_result_id', $test_result_id)->get();
        foreach ($testItems as $testItem) {
            $this->destroyTestItem($testItem->id);
        }
        $testResult = TestResult::find($test_result_id);
        if ($testResult) {
            $testResult->delete();
            return $this->jsonResponse(['mensagem' => 'Registro excluído com sucesso!'],200);
        } else {
            return $this->jsonResponse(['erro' => 'Registro não encontrado!'],404);
        }
    }

    protected function destroyTestItem(int $test_item_id) {
        $itemResults = TestItem::query()->where('test_item_id', $test_item_id)->get();
        foreach ($itemResults as $itemResult) {
            $this->destroyItemResult($itemResult->id);
        }
        $testItem = TestItem::find($test_item_id);
        if ($testItem) {
            $testItem->delete();
            return $this->jsonResponse(['mensagem' => 'Registro excluído com sucesso!'],200);
        } else {
            return $this->jsonResponse(['erro' => 'Registro não encontrado!'],404);
        }
    }

    protected function destroyItemResult(int $item_result_id) {
        $itemResult = ItemResult::find($item_result_id);
        if ($itemResult) {
            $itemResult->delete();
            return $this->jsonResponse(['mensagem' => 'Registro excluído com sucesso!'],200);
        } else {
            return $this->jsonResponse(['erro' => 'Registro não encontrado!'],404);
        }
    }
}
