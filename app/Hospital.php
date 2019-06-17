<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\ValidationException;

class Hospital extends Model {

    /**
     * Create a hospital
     * @param string $name The hospital name
     * @param string $address The address of the hospital
     * @param int $numberOfBeds The number of beds in the hospital 
     * @param int $numberOfDoctors The number of doctors in the hospital
     */
    static function create($name, $address, $numberOfBeds, $numberOfDoctors) {
        if (is_null($name) || strlen($name) == 0) {
           throw new ValidationException('Invalid name');
        }
        $model = new Hospital;
        $model->name = $name;
        $model->address = $address;
        $model->numberOfBeds = is_numeric($numberOfBeds) && $numberOfBeds > 0 ? intval($numberOfBeds) : 0;
        $model->numberOfDoctors = is_numeric($numberOfDoctors) && $numberOfDoctors > 0 ? intval($numberOfDoctors) : 0;
        return $model;
    }
}

