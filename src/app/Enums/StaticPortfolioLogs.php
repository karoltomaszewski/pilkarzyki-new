<?php

namespace App\Enums;

enum StaticPortfolioLogs: string
{
    case CREATED = 'created';
    case SET_VALUE = 'set_value';
    case SET_NAME = 'set_name';
    case SET_CURRENCY = 'set_currency';
    case SET_DELETED = 'deleted';
}
