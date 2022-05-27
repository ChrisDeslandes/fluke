<?php

namespace App\Http\Controllers;

use App\Models\ItemResult;

class ItemResultsController extends Controller
{
    public function index(int $test_item_id)
    {
        $itemResults = ItemResult::query()->where('test_item_id', $test_item_id)->get();
        if (count($itemResults)) {
            return $this->jsonResponse($itemResults,200);
        }
        return $this->jsonResponse(null,200);
    }

    public function show(int $item_result_id)
    {
        $itemResult = ItemResult::find($item_result_id);
        if ($itemResult) {
            return $this->jsonResponse($itemResult,200);
        }
        return $this->jsonResponse(['erro' => 'Resultado de item não encontrado!'],404);
    }

    public function destroy(int $item_result_id)
    {
        return $this->destroyItemResult($item_result_id);
    }
}
