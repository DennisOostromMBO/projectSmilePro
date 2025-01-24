<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class PatientInfoRepository
{
    public function getPatientInfo()
    {
        $patients = DB::select('CALL spGetAllPatientInfo()');
    
        return collect($patients)->map(function ($patient) {
            return $patient; // Geen wijzigingen nodig, originele ID blijft behouden
        });
    }
}

