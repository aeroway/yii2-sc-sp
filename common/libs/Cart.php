<?php

namespace common\libs;

use Yii;
use yii\web\Session;
use frontend\models\Product;

class Cart
{
    /*
	public function addCart($id, $num = 1)
	{
		$data = new Product();
		$dataProduct = $data->getInfoProductBy($id);
		if(!isset(Yii::$app->session['cart']))
		{
			$cart[$id] = [
				'name' => $dataProduct['name'],
				'price' => $dataProduct['price'],
                'img' => $dataProduct["img"],
				'pro_sl' => $num,
			];
		} else {
			$cart = Yii::$app->session['cart'];

			if(array_key_exists($id, $cart))
			{
				$cart[$id] = [
					'name' => $dataProduct['name'],
					'price' => $dataProduct['price'],
                    'img' => $dataProduct["img"],
					'pro_sl' => (int)$cart[$id]['pro_sl'] + $num,
				];
			} else {
				$cart[$id] = [
					'name' => $dataProduct['name'],
					'price' => $dataProduct['price'],
                    'img' => $dataProduct["img"],
					'pro_sl' => $num,
				];
			}
		}
		Yii::$app->session['cart'] = $cart;
	}
*/
/*
    public function updateCart($id, $num)
    {
        if(isset(Yii::$app->session['cart']))
        {
			$cart = Yii::$app->session['cart'];

			if(array_key_exists($id, $cart))
            {
                if($num) {
                    $cart[$id] = [
                        'name' => $cart[$id]['name'],
                        'price' => $cart[$id]['price'],
                        'img' => $cart[$id]['img'],
                        'pro_sl' => $num,
                    ];
                } else {
                    unset($cart[$id]);
                }
            }
            Yii::$app->session['cart'] = $cart;
        }
    }
*/
    function convert_number_to_words($number)
    {
        $hyphen      = ' ';
        $conjunction = '  ';
        $separator   = ' ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'ноль',
            1                   => 'один',
            2                   => 'два',
            3                   => 'три',
            4                   => 'четыре',
            5                   => 'пять',
            6                   => 'шесть',
            7                   => 'семь',
            8                   => 'восемь',
            9                   => 'девять',
            10                  => 'десять',
            11                  => 'одиннадцать',
            12                  => 'двенадцать',
            13                  => 'тринадцать',
            14                  => 'четырнадцать',
            15                  => 'пятнадцать',
            16                  => 'шестнадцать',
            17                  => 'семнадцать',
            18                  => 'восемнадцать',
            19                  => 'девятнадцать',
            20                  => 'двадцать',
            30                  => 'тридцать',
            40                  => 'сорок',
            50                  => 'пятьдесят',
            60                  => 'шестьдесят',
            70                  => 'семьдесят',
            80                  => 'восемьдесят',
            90                  => 'девяносто',
            100                 => 'сто',
            1000                => 'тысяча',
            1000000             => 'миллион',
            1000000000          => 'миллиард',
            1000000000000       => 'триллион',
        );

        if(!is_numeric($number))
        {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) 
        {
            // overflow
            trigger_error('convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING);

            return false;
        }

        if ($number < 0)
        {
            return $negative . self::convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) 
        {
            list($number, $fraction) = explode('.', $number);
        }

        switch(true) 
        {
            case $number < 21:
                $string = $dictionary[$number];
            break;

            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];

            if($units)
            {
                $string .= $hyphen . $dictionary[$units];
            }

            break;

            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];

            if($remainder) 
            {
                $string .= $conjunction . self::convert_number_to_words($remainder);
            }
            break;

            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = self::convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];

            if($remainder)
            {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= self::convert_number_to_words($remainder);
            }
            break;
        }

        if(null !== $fraction && is_numeric($fraction))
        {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) 
            {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }
}