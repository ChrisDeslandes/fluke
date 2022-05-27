<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = ['test_element', 'test_type', 'procedure', 'test_record_id'];
    public $timestamps = false;
    protected $appends = ['test_items', 'links'];

    public function getTestItemsAttribute()
    {
        return TestItem::query()->where('test_result_id', $this->id)->get();
    }

    public function getLinksAttribute() : array
    {
        return [
            'record' => '/records/' . $this->test_record_id . '/',
            'self' => '/results/' . $this->id . '/',
            'items' => '/results/' . $this->id . '/items/'
        ];
    }
}
