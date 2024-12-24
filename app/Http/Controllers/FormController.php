<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function view()
    {

        return view('RPL.FormRpl');
    }
    public function formEval()
    {
        return view('RPL.FormEval');
    }

    public function formCV()
    {
        return view('RPL.FormCV');
    }

    public function testEval()
    {
        return view('RPL.cetakFormEval');
    }

    public function testCV()
    {
        return view('RPL.cetakFormCV');
    }
}
