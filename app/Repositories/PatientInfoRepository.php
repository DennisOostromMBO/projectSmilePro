<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class PatientInfoRepository
{
    public function getPatientInfo()
    {
        $patients = DB::select('CALL spGetAllPatientInfo()');
        
        return collect($patients)->map(function ($patient, $index) {
            $patient->id = $index + 1; 
            return $patient;
        });
    }
}

