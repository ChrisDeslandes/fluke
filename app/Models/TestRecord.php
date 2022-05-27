<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast\Object_;

class TestRecord extends Model
{
    protected $fillable = [
        'date',
        'record',
        'template',
        'template_version',
        'ansur_version',
        'plugin',
        'plugin_version',
        'device_serial_number',
        'device_model',
        'mti_test_instrument',
        'mti_serial_number',
        'mti_firmware_version'
    ];
    public $timestamps = false;
    protected $appends = ['test_results', 'links'];

    public function getTestResultsAttribute()
    {
        return TestResult::query()->where('test_record_id', $this->id)->get();
    }

    public function getLinksAttribute() : array
    {
        return [
            'self' => '/records/' . $this->id . '/',
            'results' => '/records/' . $this->id . '/results/'
        ];
    }
}
