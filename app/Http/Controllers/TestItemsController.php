<?php

namespace App\Http\Controllers;

use App\Models\TestItem;

class TestItemsController extends Controller
{
    public function index(int $test_result_id)
    {
        $testItems = TestItem::query()->where('test_result_id', $test_result_id)->get();
        if (count($testItems)) {
            return $this->jsonResponse($testItems,200);
        }
        return $this->jsonResponse(null,200);
    }

    public function show(int $test_item_id)
    {
        $testItem = TestItem::find($test_item_id);
        if ($testItem) {
            return $this->jsonResponse($testItem,200);
        }
        return $this->jsonResponse(['erro' => 'Registro não encontrado!'],404);
    }

    public function destroy(int $test_item_id)
    {
        return $this->destroyTestItem($test_item_id);
    }
}
