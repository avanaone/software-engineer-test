<?php

namespace App\Helpers;

class ParenthesisHelper {

    public function findClosingParenthesis($input, $parenthesis_index)
    {
        if ($input[$parenthesis_index] !== "(") {
            $error = [
                    "code" => 0,
                    "message" => "Index of opening parenthesis is invalid"
            ];
            return response()->json($error, 422);
        }

        $i = 1;

        while ($i > 0) {
            $parenthesis_index += 1;
            $char = $input[$parenthesis_index];
            if ($char === '(') {
                $i++;
            } else if ($char === ')') {
                $i--;
            }
        }

        return $parenthesis_index;
    }

}
