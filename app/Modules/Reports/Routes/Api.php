<?php

namespace App\Modules\Reports\Routes;
// namespace App\Modules\Reports\Controller;

use App\Modules\Reports\Controllers\ReportsController;

use Illuminate\Support\Facades\Route;
 
Route::get("/reports",[ReportsController::class, "getReports"]);
Route::post("/register",[ReportsController::class, "register"]);

?>