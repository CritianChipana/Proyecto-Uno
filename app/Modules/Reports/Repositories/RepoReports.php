<?php

namespace App\Modules\Reports\Repositories;

use App\Modules\Reports\Contracts\IReports;

class RepoReports implements IReports {

    protected $model ;
    public function __construct($model){
        $this->model = $model;
    }

    public function getReports(){
        $results = $this->model::table('reports')->get();
        return $results;
    }


}


?>