<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Lang;
use Illuminate\Support\Facades\Config;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const ACTIVE_STATUS = "active";

    const INACTIVE_STATUS = "blocked";

    const DEFAULT_LANG_ID = "1";

    public function getLocalId()
    {
        $locale = Config::get('app.locale');

        $find = Lang::where('lang_code',$locale)->first();

        return $find->count() ? self::DEFAULT_LANG_ID : $find->id;
        
    }
}
