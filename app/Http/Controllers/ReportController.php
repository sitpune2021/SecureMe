<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function ReportsAndLogsList(){
        return view('admin.reports_and_logs_list');
    }
}
