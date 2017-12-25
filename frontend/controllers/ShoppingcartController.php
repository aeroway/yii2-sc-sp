<?php

namespace frontend\controllers;

use Yii;
use yii\web\Session;

//use frontend\models\OrderSearch;
//use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use frontend\models\Order;
use frontend\models\Payment;
use frontend\models\Delivery;
use frontend\models\OrderDetail;
use frontend\models\Product;

class ShoppingcartController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionAddcart($id, $num)
    {
        $data = new Product();
        $dataProduct = $data->getInfoProductBy($id);

        //Если сессия не была создана ни разу
        if(!isset(Yii::$app->session['cart']))
        {
            $cart[$id] =
            [
                'name' => $dataProduct['name'],
                'price' => $dataProduct['price'],
                'img' => $dataProduct["img"],
                'pro_sl' => $dataProduct["min_qty"],
                'qty_multiplier' => $dataProduct["qty_multiplier"],
            ];
        }
        else
        {
            $cart = Yii::$app->session['cart'];

            if(array_key_exists($id, $cart))
            {
                $cart[$id] =
                [
                    'name' => $dataProduct['name'],
                    'price' => $dataProduct['price'],
                    'img' => $dataProduct["img"],
                    'pro_sl' => (int)$cart[$id]['pro_sl'] + $dataProduct["qty_multiplier"],
                    'qty_multiplier' => $dataProduct["qty_multiplier"],
                ];
            }
            else
            {
                $cart[$id] =
                [
                    'name' => $dataProduct['name'],
                    'price' => $dataProduct['price'],
                    'img' => $dataProduct["img"],
                    'pro_sl' => $dataProduct["min_qty"],
                    'qty_multiplier' => $dataProduct["qty_multiplier"],
                ];
            }
        }

        Yii::$app->session['cart'] = $cart;
    }

    public function actionListcart()
    {
        $this->layout = 'cart';
        $cart = Yii::$app->session['cart'];

        return $this->render('cartitem', ['cart' => $cart]);
    }

    public function actionUpdatecartdown($id, $num)
    {
        $cart = Yii::$app->session['cart'];

        if(array_key_exists($id, $cart))
        {
            if($num)
            {
                if($num < (int)$cart[$id]['pro_sl'])
                    $pro_sl = (int)$cart[$id]['pro_sl'] - $cart[$id]['qty_multiplier'];

                if(!empty($pro_sl))
                {
                    $cart[$id] =
                    [
                        'name' => $cart[$id]['name'],
                        'price' => $cart[$id]['price'],
                        'img' => $cart[$id]['img'],
                        'pro_sl' => $pro_sl,
                        'qty_multiplier' => $cart[$id]['qty_multiplier'],
                    ];
                }
            }
            else
            {
                unset($cart[$id]);
            }

            Yii::$app->session['cart'] = $cart;
        }

        return $this->renderPartial('cartitem', ['cart' => Yii::$app->session['cart']]);
    }

    public function actionUpdatecartup($id, $num)
    {
        $cart = Yii::$app->session['cart'];

        if(array_key_exists($id, $cart))
        {
            if($num)
            {
                if($num > (int)$cart[$id]['pro_sl'])
                    $pro_sl = (int)$cart[$id]['pro_sl'] + $cart[$id]['qty_multiplier'];

                if(!empty($pro_sl))
                {
                    $cart[$id] =
                    [
                        'name' => $cart[$id]['name'],
                        'price' => $cart[$id]['price'],
                        'img' => $cart[$id]['img'],
                        'pro_sl' => $pro_sl,
                        'qty_multiplier' => $cart[$id]['qty_multiplier'],
                    ];
                }
            }
            else
            {
                unset($cart[$id]);
            }
        }

        Yii::$app->session['cart'] = $cart;

        return $this->renderPartial('cartitem', ['cart' => Yii::$app->session['cart']]);
    }

    public function actionUpdatecart($id, $num)
    {
        $cart = Yii::$app->session['cart'];

        if(array_key_exists($id, $cart))
        {
            if($num)
            {
                if($num > (int)$cart[$id]['pro_sl'])
                    $pro_sl = (int)$cart[$id]['pro_sl'] + $cart[$id]['qty_multiplier'];
                else
                    $pro_sl = (int)$cart[$id]['pro_sl'] - $cart[$id]['qty_multiplier'];

                $cart[$id] =
                [
                    'name' => $cart[$id]['name'],
                    'price' => $cart[$id]['price'],
                    'img' => $cart[$id]['img'],
                    'pro_sl' => $pro_sl,
                    'qty_multiplier' => $cart[$id]['qty_multiplier'],
                ];
            }
            else
            {
                unset($cart[$id]);
            }
        }

        Yii::$app->session['cart'] = $cart;

        return $this->renderPartial('cartitem', ['cart' => Yii::$app->session['cart']]);
    }

    public function actionCheckout()
    {
        $this->layout = 'cart';
        $cart = Yii::$app->session['cart'];

        if(empty($cart))
            return $this->render('empty');

        $total = 0;
        $time = time();

        foreach($cart as $value)
        {
            $total += $value["pro_sl"] * number_format($value["price"], 0, "", " ");
        }

        $model = new Order();
        $model->total = number_format($total, 0, "", " ");
        $model->created_at = $time;
        $model->user_id = 0;
        $model->status = 1;

        if(!Yii::$app->user->isGuest)
        {
            $model->user_name = Yii::$app->user->identity->full_name;
            $model->email = Yii::$app->user->identity->email;
            $model->mobile = Yii::$app->user->identity->mobile;
            $model->address = Yii::$app->user->identity->address;
            $model->user_id = Yii::$app->user->id;
        }

        if($model->load(Yii::$app->request->post()) && $model->save())
        {
            $Body = 
            '<table style="border-collapse: collapse; border: 1px solid #E6E4DF;">
                <thead>
                    <tr style="background: #FE980F; color: #fff; text-align: center;">
                        <td style="width: 15%;"></td>
                        <td style="width: 40%;">Описание</td>
                        <td style="width: 10%;">Цена</td>
                        <td style="width: 15%;">Кол-во</td>
                        <td style="width: 10%;">Всего</td>
                    </tr>
                </thead>
                <tbody>';
            $subtotal = 0;
            foreach($cart as $key => $value)
            {
                $Body .= 
                '<tr style="border-bottom: 1px solid #F7F7F0;">
                    <td><img src="' . $value["img"] . '"/></td>
                    <td><p>' . $value["name"] . '</p></td>
                    <td style="text-align: center"><p>₽' . number_format($value["price"], 0, "", " ") . '</p></td>
                    <td style="text-align: center"><p>' . $value["pro_sl"] . '</p></td>
                    <td style="text-align: center"><p>₽' . number_format($value["price"], 0, "", " ") * $value["pro_sl"] . '</p></td>
                </tr>';
                $subtotal += number_format($value["price"], 0, "", " ") * $value["pro_sl"];

                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $model->order_id;
                $orderDetail->pro_id = $key;
                $orderDetail->pro_price = number_format($value["price"], 0, "", " ");
                $orderDetail->pro_amount = $value["pro_sl"];
                $orderDetail->status = 1;
                $orderDetail->created_at = $time;
                $orderDetail->save();
            }

            $Body .= '
                    <tr>
                        <td colspan="5" style="text-align: right; padding-right: 15px;">Итого: <b>₽' . $subtotal . '</b></td>
                    </tr>
                </tbody>
            </table>';

            $mail = new \PHPMailer();
            $mail->isSMTP();
            //$mail->SMTPDebug = 3;
            $mail->Debugoutput = 'html';
            $mail->Host = 'smtp.yandex.ru';
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth = true;
            $mail->Username = Yii::$app->params['login'];
            $mail->Password = Yii::$app->params['password'];
            $mail->setFrom(Yii::$app->params['mail'], Yii::$app->params['mail_name']);
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Информация о заказе';
            $mail->Body = $Body;

            $infoPost = Yii::$app->request->post();
            $emailSend = 
            [
                $infoPost["Order"]["email"],
                $infoPost["Order"]["email_ship"]
            ];

            if(is_array($emailSend))
            {
                foreach($emailSend as $value)
                {
                    $mail->addAddress($value); // Add a recipient
                }
            }
            else
            {
                $mail->addAddress($emailSend); // Add a recipient
            }

            if(!$mail->send())
            {
                $message = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
            else
            {
                $message = 'Message has been sent';
            }

            return $this->render('finish', ['message' => $message]);
        }

        $payment = new Payment();
        $payment = ArrayHelper::map($payment->getAllPayment(), 'pay_id', 'pay_name');

        $delivery = new Delivery();
        $delivery = ArrayHelper::map($delivery->getAllDelivery(), 'deli_id', 'deli_name');

        return $this->render('checkout',
        [
            'cart' => $cart, 
            'model' => $model, 
            'payment' => $payment, 
            'delivery' => $delivery
        ]);
    }
}
