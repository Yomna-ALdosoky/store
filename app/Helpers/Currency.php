<?php
namespace App\Helpers;

use NumberFormatter;

class Currency
{
    public function __invoke(...$params)
    {
        return static::format(...$params);
    }

    public  static function format($amaunt, $currency = null) {
        $formatter= new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);

        if($currency === null) {
            $currency =config('app.currency');
        }

        return $formatter->formatCurrency($amaunt,  $currency);

    }
}