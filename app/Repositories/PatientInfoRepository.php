<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class PatientInfoRepository
{
    /**
     * Haal alle patiëntinformatie op via de stored procedure.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getPatientInfo()
    {
        // Roep de stored procedure aan en zet het resultaat om naar een collectie
        $patients = DB::select('CALL spGetAllPatientInfo()');

        // Zet de array om naar een collectie
        return collect($patients);
    }
}
