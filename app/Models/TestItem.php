<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestItem extends Model
{
    protected $fillable = ['name', 'success', 'test_result_id'];
    public $timestamps = false;
    protected $appends = ['item_results', 'links'];

    public function getItemResultsAttribute()
    {
        return ItemResult::query()->where('test_item_id', $this->id)->get();
    }

    public function getLinksAttribute() : array
    {
        $test_result = TestResult::find($this->test_result_id);
        $test_record_id = $test_result->test_record_id;
        return [
            'record' => '/records/' . $test_record_id . '/',
            'result' => '/results/' . $this->test_result_id . '/',
            'self' => '/items/' . $this->id . '/',
            'item_results' => '/items/' . $this->id . '/item_results/'
        ];
    }
}
