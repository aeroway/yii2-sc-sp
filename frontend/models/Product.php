<?php

namespace frontend\models;

use Yii;

use yii\data\Pagination;
use yii\db\Command;
/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $sid
 * @property string $uid
 * @property string $name
 * @property string $slug
 * @property integer $balance
 * @property integer $is_disabled
 * @property string $reason_of_disabling
 * @property double $qty_multiplier
 * @property double $price
 * @property double $price_max
 * @property double $price_per_square_meter
 * @property double $price_per_linear_meter
 * @property string $currency
 * @property string $created_at
 * @property string $updated_at
 * @property integer $boxtype_id
 * @property double $box_depth
 * @property double $box_height
 * @property double $box_width
 * @property integer $in_box
 * @property double $in_set
 * @property double $depth
 * @property integer $unit_id
 * @property integer $nested_unit_id
 * @property double $width
 * @property double $height
 * @property double $weight
 * @property integer $trademark_id
 * @property integer $country_id
 * @property double $cart_min_diff
 * @property integer $keep_package
 * @property integer $per_package
 * @property string $video_file_name
 * @property string $video_file_url
 * @property string $supplier_code
 * @property integer $series_id
 * @property integer $is_hit
 * @property integer $is_licensed
 * @property integer $is_price_fixed
 * @property integer $is_exclusive
 * @property integer $is_motley
 * @property integer $is_adult
 * @property integer $is_protected
 * @property integer $offer_id
 * @property integer $certificate_type_id
 * @property integer $has_usb
 * @property integer $has_battery
 * @property integer $has_clockwork
 * @property integer $has_sound
 * @property integer $has_radiocontrol
 * @property integer $is_inertial
 * @property integer $is_on_ac_power
 * @property integer $has_rus_voice
 * @property integer $has_rus_pack
 * @property integer $has_light
 * @property integer $is_day_offer
 * @property string $page_title
 * @property string $page_keywords
 * @property string $page_description
 * @property integer $parent_item_id
 * @property integer $modifier_id
 * @property string $modifier_value
 * @property integer $gift_id
 * @property double $surface_area
 * @property double $linear_meters
 * @property integer $is_loco
 * @property string $novelted_at
 * @property integer $is_paid_delivery
 * @property double $package_volume
 * @property integer $min_age
 * @property double $power
 * @property double $volume
 * @property integer $transport_condition_id
 * @property integer $has_discount
 * @property integer $is_gift
 * @property integer $is_boxed
 * @property double $product_volume
 * @property double $box_volume
 * @property integer $box_capacity
 * @property double $packing_volume_factor
 * @property integer $is_tire_spike
 * @property integer $is_tire_run_flat
 * @property integer $tire_season_id
 * @property integer $tire_diameter_id
 * @property integer $tire_width_id
 * @property integer $tire_section_height_id
 * @property integer $tire_load_index_id
 * @property integer $tire_speed_index_id
 * @property integer $wheel_lz_id
 * @property integer $wheel_width_id
 * @property integer $wheel_diameter_id
 * @property integer $wheel_dia_id
 * @property integer $wheel_pcd_id
 * @property integer $wheel_et_id
 * @property integer $has_body_drawing
 * @property integer $has_cord_case
 * @property integer $has_teapot
 * @property integer $has_termostat
 * @property string $isbn
 * @property integer $page_count
 * @property integer $is_add_to_cart_multiple
 * @property integer $supply_period
 * @property integer $has_action
 * @property integer $has_jewelry_action
 * @property integer $has_3_pay_2_action
 * @property integer $has_best_fabric
 * @property integer $has_number_one_made_in_russia
 * @property string $audio_filename
 * @property integer $photo_3d_count
 * @property integer $is_markdown
 * @property integer $is_paid_delivery_ekb
 * @property string $currencySign
 * @property integer $isEnough
 * @property integer $min_qty
 * @property integer $max_qty
 * @property string $qty_rules
 * @property string $pluralNameFormat
 * @property string $inBoxPluralNameFormat
 * @property string $balancePluralNameFormat
 * @property integer $photos
 * @property integer $country
 * @property integer $discountPercent
 * @property string $img
 * @property integer $hasGift
 * @property integer $hasGiftAssignee
 * @property integer $isNovelty
 * @property string $itemUrl
 * @property string $modifier
 * @property string $size
 * @property string $stuff
 * @property string $ecommerce_variant
 * @property integer $category_id
 * @property integer $hasVolumeDiscount
 * @property integer $loan_category_id
 * @property integer $markdown_reason
 * @property integer $is_top
 * @property string $photoIndexes
 */
class Product extends \yii\db\ActiveRecord
{
    public $strCat;
    //public $data, $ct;
    public $ct;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sid', 'balance', 'is_disabled', 'boxtype_id', 'in_box', 'unit_id', 'nested_unit_id', 'trademark_id', 'country_id', 'keep_package', 'per_package', 'series_id', 'is_hit', 'is_licensed', 'is_price_fixed', 'is_exclusive', 'is_motley', 'is_adult', 'is_protected', 'offer_id', 'certificate_type_id', 'has_usb', 'has_battery', 'has_clockwork', 'has_sound', 'has_radiocontrol', 'is_inertial', 'is_on_ac_power', 'has_rus_voice', 'has_rus_pack', 'has_light', 'is_day_offer', 'parent_item_id', 'modifier_id', 'gift_id', 'is_loco', 'is_paid_delivery', 'min_age', 'transport_condition_id', 'has_discount', 'is_gift', 'is_boxed', 'box_capacity', 'is_tire_spike', 'is_tire_run_flat', 'tire_season_id', 'tire_diameter_id', 'tire_width_id', 'tire_section_height_id', 'tire_load_index_id', 'tire_speed_index_id', 'wheel_lz_id', 'wheel_width_id', 'wheel_diameter_id', 'wheel_dia_id', 'wheel_pcd_id', 'wheel_et_id', 'has_body_drawing', 'has_cord_case', 'has_teapot', 'has_termostat', 'page_count', 'is_add_to_cart_multiple', 'supply_period', 'has_action', 'has_jewelry_action', 'has_3_pay_2_action', 'has_best_fabric', 'has_number_one_made_in_russia', 'photo_3d_count', 'is_markdown', 'is_paid_delivery_ekb', 'isEnough', 'min_qty', 'max_qty', 'photos', 'country', 'discountPercent', 'hasGift', 'qty_multiplier', 'hasGiftAssignee', 'isNovelty', 'category_id', 'hasVolumeDiscount', 'loan_category_id', 'is_top'], 'integer'],
            [['name'], 'required'],
            [['price', 'price_max', 'price_per_square_meter', 'price_per_linear_meter', 'box_depth', 'box_height', 'box_width', 'in_set', 'depth', 'width', 'height', 'weight', 'cart_min_diff', 'surface_area', 'linear_meters', 'package_volume', 'power', 'volume', 'product_volume', 'box_volume', 'packing_volume_factor'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['uid'], 'string', 'max' => 36],
            [['name', 'slug', 'reason_of_disabling', 'video_file_name', 'video_file_url', 'supplier_code', 'page_title', 'page_keywords', 'page_description', 'modifier_value', 'novelted_at', 'isbn', 'audio_filename', 'currencySign', 'pluralNameFormat', 'inBoxPluralNameFormat', 'balancePluralNameFormat', 'img', 'itemUrl', 'size', 'ecommerce_variant'], 'string', 'max' => 255],
            [['currency'], 'string', 'max' => 3],
            [['qty_rules'], 'string', 'max' => 30],
            [['modifier'], 'string', 'max' => 50],
            [['markdown_reason', 'photoIndexes'], 'string', 'max' => 100],
            [['stuff'], 'string', 'max' => 645],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sid' => 'Sid',
            'uid' => 'Uid',
            'name' => 'Name',
            'slug' => 'Slug',
            'balance' => 'Balance',
            'is_disabled' => 'Is Disabled',
            'reason_of_disabling' => 'Reason Of Disabling',
            'qty_multiplier' => 'Qty Multiplier',
            'price' => 'Price',
            'price_max' => 'Price Max',
            'price_per_square_meter' => 'Price Per Square Meter',
            'price_per_linear_meter' => 'Price Per Linear Meter',
            'currency' => 'Currency',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'boxtype_id' => 'Boxtype ID',
            'box_depth' => 'Box Depth',
            'box_height' => 'Box Height',
            'box_width' => 'Box Width',
            'in_box' => 'In Box',
            'in_set' => 'In Set',
            'depth' => 'Depth',
            'unit_id' => 'Unit ID',
            'nested_unit_id' => 'Nested Unit ID',
            'width' => 'Width',
            'height' => 'Height',
            'weight' => 'Weight',
            'trademark_id' => 'Trademark ID',
            'country_id' => 'Country ID',
            'cart_min_diff' => 'Cart Min Diff',
            'keep_package' => 'Keep Package',
            'per_package' => 'Per Package',
            'video_file_name' => 'Video File Name',
            'video_file_url' => 'Video File Url',
            'supplier_code' => 'Supplier Code',
            'series_id' => 'Series ID',
            'is_hit' => 'Is Hit',
            'is_licensed' => 'Is Licensed',
            'is_price_fixed' => 'Is Price Fixed',
            'is_exclusive' => 'Is Exclusive',
            'is_motley' => 'Is Motley',
            'is_adult' => 'Is Adult',
            'is_protected' => 'Is Protected',
            'offer_id' => 'Offer ID',
            'certificate_type_id' => 'Certificate Type ID',
            'has_usb' => 'Has Usb',
            'has_battery' => 'Has Battery',
            'has_clockwork' => 'Has Clockwork',
            'has_sound' => 'Has Sound',
            'has_radiocontrol' => 'Has Radiocontrol',
            'is_inertial' => 'Is Inertial',
            'is_on_ac_power' => 'Is On Ac Power',
            'has_rus_voice' => 'Has Rus Voice',
            'has_rus_pack' => 'Has Rus Pack',
            'has_light' => 'Has Light',
            'is_day_offer' => 'Is Day Offer',
            'page_title' => 'Page Title',
            'page_keywords' => 'Page Keywords',
            'page_description' => 'Page Description',
            'parent_item_id' => 'Parent Item ID',
            'modifier_id' => 'Modifier ID',
            'modifier_value' => 'Modifier Value',
            'gift_id' => 'Gift ID',
            'surface_area' => 'Surface Area',
            'linear_meters' => 'Linear Meters',
            'is_loco' => 'Is Loco',
            'novelted_at' => 'Novelted At',
            'is_paid_delivery' => 'Is Paid Delivery',
            'package_volume' => 'Package Volume',
            'min_age' => 'Min Age',
            'power' => 'Power',
            'volume' => 'Volume',
            'transport_condition_id' => 'Transport Condition ID',
            'has_discount' => 'Has Discount',
            'is_gift' => 'Is Gift',
            'is_boxed' => 'Is Boxed',
            'product_volume' => 'Product Volume',
            'box_volume' => 'Box Volume',
            'box_capacity' => 'Box Capacity',
            'packing_volume_factor' => 'Packing Volume Factor',
            'is_tire_spike' => 'Is Tire Spike',
            'is_tire_run_flat' => 'Is Tire Run Flat',
            'tire_season_id' => 'Tire Season ID',
            'tire_diameter_id' => 'Tire Diameter ID',
            'tire_width_id' => 'Tire Width ID',
            'tire_section_height_id' => 'Tire Section Height ID',
            'tire_load_index_id' => 'Tire Load Index ID',
            'tire_speed_index_id' => 'Tire Speed Index ID',
            'wheel_lz_id' => 'Wheel Lz ID',
            'wheel_width_id' => 'Wheel Width ID',
            'wheel_diameter_id' => 'Wheel Diameter ID',
            'wheel_dia_id' => 'Wheel Dia ID',
            'wheel_pcd_id' => 'Wheel Pcd ID',
            'wheel_et_id' => 'Wheel Et ID',
            'has_body_drawing' => 'Has Body Drawing',
            'has_cord_case' => 'Has Cord Case',
            'has_teapot' => 'Has Teapot',
            'has_termostat' => 'Has Termostat',
            'isbn' => 'Isbn',
            'page_count' => 'Page Count',
            'is_add_to_cart_multiple' => 'Is Add To Cart Multiple',
            'supply_period' => 'Supply Period',
            'has_action' => 'Has Action',
            'has_jewelry_action' => 'Has Jewelry Action',
            'has_3_pay_2_action' => 'Has 3 Pay 2 Action',
            'has_best_fabric' => 'Has Best Fabric',
            'has_number_one_made_in_russia' => 'Has Number One Made In Russia',
            'audio_filename' => 'Audio Filename',
            'photo_3d_count' => 'Photo 3d Count',
            'is_markdown' => 'Is Markdown',
            'is_paid_delivery_ekb' => 'Is Paid Delivery Ekb',
            'currencySign' => 'Currency Sign',
            'isEnough' => 'Is Enough',
            'min_qty' => 'Min Qty',
            'max_qty' => 'Max Qty',
            'qty_rules' => 'Qty Rule',
            'pluralNameFormat' => 'Plural Name Format',
            'inBoxPluralNameFormat' => 'In Box Plural Name Format',
            'balancePluralNameFormat' => 'Balance Plural Name Format',
            'photos' => 'Photos',
            'country' => 'Country',
            'discountPercent' => 'Discount Percent',
            'img' => 'Img',
            'hasGift' => 'Has Gift',
            'hasGiftAssignee' => 'Has Gift Assignee',
            'isNovelty' => 'Is Novelty',
            'itemUrl' => 'Item Url',
            'modifier' => 'Modifier',
            'size' => 'Size',
            'stuff' => 'Stuff',
            'ecommerce_variant' => 'Ecommerce Variant',
            'category_id' => 'Category ID',
            'hasVolumeDiscount' => 'hasVolumeDiscount',
            'loan_category_id' => 'loan category id',
            'is_top' => 'is top',
            'photoIndexes' => 'photoIndexes',
        ];
    }

	public function getDataProduct($limit = 6)
	{
        $data = Yii::$app->db->createCommand("SELECT * FROM product AS r1 JOIN (SELECT CEIL(RAND() * (SELECT MAX(id) FROM product)) AS id) AS r2 WHERE r1.id >= r2.id AND is_disabled != 1 ORDER BY r1.id ASC LIMIT $limit")->queryAll();

		return $data;
	}

	public function getDataTabProduct($catid, $limit = 4)
	{
		$data = Product::find()
            ->asArray()
            ->where(['and', 'category_id=:catid', ['!=','is_disabled','1']], ['catid' => $catid])
            ->limit($limit)
            ->orderBy('RAND()')
            ->all();

		return $data;
	}

	public function getProductByCat($catid)
	{
        //Получить все родительские категории
        //$strCat = $this->getCategoryParent($catid);
        $strCat = $catid;

        //Для повторного использования
        $this->strCat = $strCat;

        //Пагинация
		$pages = $this->getPagerProduct($strCat);

        //Товары из этих категорий
        $subQuery2 = ItemCategories::find()
            ->select('item_id')
            ->where('category_id IN ('.$strCat.')');

        //Вся информация о товарах
        $data = Product::find()
            ->where(['and', ['in', 'id', $subQuery2], ['!=', 'is_disabled', '1']])
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

		return $data;
	}

    //Получить родительскую категорию
    /*
    public function getCategoryParent($parent = 0)
    {
        $result = Category::find()
                    ->select('id')
                    ->where(['and', ['parent_id' => $parent], ['status' => '1']])
                    ->asArray()
                    ->all();

        foreach ($result as $key => $value)
            $data[] = $value["id"];

        if(empty($data))
            return $parent;
        else
            return $parent . ', ' . implode(", ", $data);
    }
    */
	public function getPagerProduct($catid)
	{
        $subQuery2 = ItemCategories::find()
            ->select('item_id')
            ->where('category_id IN('.$catid.')');

        //Количество активных товаров
        $dataCount = Product::find()
            ->where(['and', ['in', 'id', $subQuery2], ['!=', 'is_disabled', '1']])
            ->count();

		$pages = new Pagination
        (
            [
                'totalCount' => $dataCount,
                'pageSize' => \Yii::$app->params['param']['pageSize'],
            ]
        );

		return $pages;
	}

	public function getInfoProductBy($id)
	{
		$data = Product::find()->asArray()->where('id=:id', ['id' => $id])->one();

		return $data;
	}

    //Виджет с брендами
    public function getTrademarkName()
    {
        return $data = Trademark::find()
            ->select(['name', 'count'])
            ->where(['and', ['is not', 'photo', null], ['=', 'status', 1]])
            ->orderBy('RAND()')
            ->limit(5)
            ->asArray()
            ->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrademark()
    {
        return $this->hasOne(Trademark::className(), ['id' => 'trademark_id']);
    }
}
