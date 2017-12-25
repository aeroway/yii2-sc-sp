<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use frontend\models\Product;
use frontend\models\ItemCategories;

class ItemController extends Controller
{
    private $countBodyItems = 1;
    private $photoSizes = array('140', '280', '400', '700-nw');
    private $keyId = 0;
    private $photoIndexes;

    public function actionIndex()
    {
        //Авторизация Сима
        $client = new \SimaLand\API\Rest\Client(
            [
                'login' => Yii::$app->params['login'],
                'password' => Yii::$app->params['password'],
            ]
        );

        //Проход по каждой странице
        while($this->countBodyItems)
        {
            //Запрос
            $response = $client->get('item',
                [
                    'per-page' => 100,
                    'id-greater-than' => $this->keyId,
                    'with_adult' => 1,
                    'expand' => 'categories',
                    'is_disabled' => 0,
                    'has_balance' => 1,
                ]
            );

            //Обработка ответа
            $body = json_decode($response->getBody(), true);

            //Данных больше нет
            if(empty($body['items']) and $body['status'] == '404')
                break;

            //Для цикла while
            $this->countBodyItems = count($body['items']);

            foreach($body['items'] as $k1 => $v1)
            {
                //Товара достаточно в наличии
                if(!isset($body['items'][$k1]['balance']))
                    $body['items'][$k1]['balance'] = -1;

                //Искать товар в БД
                $items = Product::findOne($body['items'][$k1]['id']);

                //Начальная точка для следующего прохода
                $this->keyId = $body['items'][$k1]['id'];

                //Товар в наличии
                if($body['items'][$k1]['balance'] !== 0 and $body['items'][$k1]['is_disabled'] != 1)
                {
                    //Товара нет в БД
                    if(empty($items))
                        $items = new Product();
                    else
                        unset($items->balance);

                    foreach($v1 as $key => $value)
                    {
                        //Если значение в массиве
                        if(is_array($value))
                        {
                            //Например: "Объем" для ведра
                            if($key == 'modifier' and !empty($value['id']))
                                $items->$key = $value['name'];

                            //Связь товара с каталогами
                            if($key == 'categories' and !empty($value))
                            {
                                foreach($value as $v2)
                                {
                                    if(!ItemCategories::find()->where("item_id = $this->keyId AND category_id = $v2")->one())
                                    {
                                        $itemCategories = new ItemCategories;
                                        $itemCategories->item_id = $this->keyId;
                                        $itemCategories->category_id = $v2;
                                        $itemCategories->insert();
                                    }
                                }
                            }

                            if($key == 'photoIndexes' and !empty($value))
                                $this->photoIndexes = implode(",", $value);
                            if($key == 'photoIndexes' and empty($value))
                                $this->photoIndexes = '';

                            /* запись в папку items */
                            /*
                            if(count($value) >= 1 and $key == 'photos')
                            {
                                for($y = 0; $y <= (count($value)-1); $y++)
                                {
                                    $dirPath = 'frontend\\web\\items\\' . $this->keyId . '\\' . $y . '\\';

                                    for($z = 0; $z <= (count($this->photoSizes)-1); $z++)
                                    {
                                        if (is_dir ($dirPath . '..'))
                                        {
                                            // Сравнить количество каталогов
                                        }

                                        if(!is_dir($dirPath))
                                        {
                                            if ( !mkdir($dirPath, 0755, true) )
                                                die('Error create directory.');
                                        }

                                        if ( !file_exists ($dirPath . $this->photoSizes[$z] . '.jpg') )
                                        {
                                            copy($value[$y]['url_part'] . $this->photoSizes[$z] . '.jpg', $dirPath . $this->photoSizes[$z] . '.jpg');
                                        }
                                        else
                                        {
                                            // Сравнивать хэш суммы файлов и заменить если не совпадает
                                        }
                                    }
                                }
                            }
                            */
                        }
                        else
                        {
                            if(empty($value) and $value !== 0)
                                $value = '';

                            //обработка неоднозначных ответов от сервера
                            if($key == 'has_radiocontrol' or 
                               $key == 'is_inertial' or 
                               $key == 'has_light' or 
                               $key == 'has_sound' or 
                               $key == 'has_rus_voice' or 
                               $key == 'has_rus_pack' or 
                               $key == 'has_usb' or 
                               $key == 'is_licensed' or 
                               $key == 'has_battery' or 
                               $key == 'has_termostat' or 
                               $key == 'has_clockwork')
                            {
                                switch ($value)
                                {
                                    case 'Нет':
                                        $value = 0;
                                        break;
                                    case 'Да':
                                        $value = 1;
                                        break;
                                    case 'no':
                                        $value = 0;
                                        break;
                                    case 'yes':
                                        $value = 1;
                                        break;
                                }
                            }

                            //Почистить хвосты в URL
                            if($key == 'itemUrl' and strpos($value, '?per-page=100'))
                                $value = stristr($value, '?per-page=100', true);

                            //Исключение полей
                            if(
                                $key != 'trademark' and // достаточно trademark_id
                                $key != 'series' and // достаточно series_id
                                $key != 'offer' and // достаточно offer_id
                                $key != 'is_prepay_needed' and // предоплата
                                $key != 'is_imprintable' and // печать на товаре
                                $key != 'is_need_rigid_packaging' and
                                $key != 'can_buy_by_credit' and
                                $key != 'comments_count' and
                                $key != 'mean_rating' and
                                $key != 'minQty' and //достаточно min_qty
                                $key != 'minimum_order_quantity' and // достаточно min_qty тоже
                                $key != 'qtyRule' and // достаточно qty_rules
                                $key != 'isAddToCartMultiple' and // достаточно is_add_to_cart_multiple
                                $key != 'has_volume_discount'
                              )
                            {
                                $items->$key = $value;
                            }

                            //echo $key . ' - ' . $value . "\r\n";
                        }
                    }

                    $items->is_top = 1;
                    $items->photoIndexes = $this->photoIndexes;
                    if(!isset($items->balance))
                        $items->balance = '';

                    if(!$items->save())
                    {
                        echo $this->keyId . "\n\r";
                        print_r($items->getErrors());
                        die;
                    }
                }
                else
                {
                    //Деактуализировать запись о товаре
                    if(!empty($items))
                    {
                        $items->balance = 0;
                        $items->is_disabled = 1;
                        $items->save();
                    }
                }
            }
        }

        Product::updateAll(['is_disabled' => 1, 'balance' => 0], 'is_top != 1');
        Product::updateAll(['is_top' => 0], 'is_top = 1');
    }
}
?>