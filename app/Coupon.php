<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public static function findByCode($param)
    {
        return self::where('code', $param)->first();
    }

    public function discount($total)
    {
        if ($this->type == 'fixed') {
            return $this->value;
        } else if ($this->type == 'percent') {
            return round(($this->percent_off) * $total);
        } else {
            return 0;
        }
    }
}
