<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;
    protected $appends = ['links'];

    public function getLinksAttribute($links) : array
    {
        return [
            'self' => '/equipamentos/' . $this->id
        ];
    }
}
