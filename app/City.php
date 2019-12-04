<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'id',
        'district',
        'amphoe',
        'province',
        'zipcode',
        'district_code',
        'amphoe_code',
        'province_code'
    ];

    public static function loadData($fileName){
        $cityRecords = loadCSV($fileName);
        foreach($cityRecords as $cityRecord){
            City::create($cityRecord);
        }
    }
    public function scopeSearchCities($query,$search){
            return $query->where('district','like','%' . $search . '%')
                ->orWhere('amphoe','like','%' . $search . '%')
                ->orWhere('province','like','%' . $search . '%')
                ->orWhere('zipcode','like','%' . $search . '%');
               
    }
}
