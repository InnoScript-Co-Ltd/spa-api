<?php

namespace App\Http\Controllers;

use App\Traits\JsonResponder;
use App\Traits\HttpApiResponse;

abstract class Controller
{
    use HttpApiResponse;
}
