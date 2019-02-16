<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ParenthesisHelper;

class ValidateController extends Controller
{
    public function __construct(ParenthesisHelper $parenthesisHelper){
        $this->parenthesisHelper = $parenthesisHelper;
    }

    public function checkParenthesis(Request $request) {

        return $this->parenthesisHelper->findClosingParenthesis($request->input, $request->parenthesis_index);
    }
}
