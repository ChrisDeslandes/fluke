<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemResult extends Model
{
    protected $fillable = ['lead', 'value', 'unit', 'high_limit', 'low_limit', 'standard', 'test_item_id'];
    public $timestamps = false;
    protected $appends = ['links'];

    public function getLinksAttribute() : array
    {
        $test_item = TestItem::find($this->test_item_id);
        $test_result = TestResult::find($test_item->test_result_id);
        $test_result_id = $test_result->id;
        $test_record_id = $test_result->test_record_id;
        return [
            'record' => '/records/' . $test_record_id . '/',
            'result' => '/results/' . $test_result_id . '/',
            'item' => '/items/' . $this->test_item_id . '/',
            'self' => '/item_results/' . $this->id . '/'
        ];
    }
}
