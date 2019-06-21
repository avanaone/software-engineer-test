<?php

namespace Test2\Models;

class WorksheetA extends Worksheet{
    public $RULES_COL_NUM = 5;
    public $RULES_HEADERS_NAMES = [
        'Field_A*',
        '#Field_B',
        'Field_C',
        'Field_D*',
        'Field_E*',
    ];
}
