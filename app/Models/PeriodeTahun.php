<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeTahun extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['tahun'];

    public function data()
    {
        return $this->hasMany(Data::class);
    }
}
