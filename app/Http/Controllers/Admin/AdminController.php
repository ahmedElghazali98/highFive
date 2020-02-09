<?php

namespace App\Http\Controllers\Admin;

use App\Models\System_Constants;
use App\Models\Seasons;
use App\Models\Setting;
use App\Models\Flights;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Routing\Controller as BaseController;


class AdminController extends BaseController
{
    public static $data = [];

    public function __construct()
    {
    }


}
