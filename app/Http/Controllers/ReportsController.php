<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\CompileReports;

class ReportsController extends Controller
{
    //

    public function index()
    {
    	$job = new CompileReports();
    	$this->dispatch($job);

    	return 'done';
    }
}
