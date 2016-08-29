<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $navName;

    /**
     * Controller constructor.
     *
     * @param null $navName
     */
    public function __construct($navName = null)
    {
        if (is_null($navName)) {
            $this->navName = config('common.user.menu.default_menu');
        } else {
            $this->navName = $navName;
        }

        view()->share([
            'navName' => $this->navName,
        ]);
    }
}
