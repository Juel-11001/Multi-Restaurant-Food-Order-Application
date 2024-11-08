<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    protected $user_id;

    public function __construct($guard = 'client')
    {
        $this->user_id = Auth::guard($guard)->id();
    }
}
