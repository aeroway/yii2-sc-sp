<?php

use yii\db\Migration;

class m161214_115608_product extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),  // ID
            'sid' => $this->integer(), // The second ID
            'uid' => $this->string(), // Уникальный 36-ти символьный идентификатор
            'name' => $this->string()->notNull(), // Название
            'slug' => $this->string(), // Название для адресной строки
            'balance' => $this->smallInteger(), // Количество на складе (поле не всегда доступно)
            'is_disabled' => $this->boolean(), //Товар отключен. Заполняется из 1С
            'reason_of_disabling' => $this->string(), // Причина отключения. Заполняется из 1С
            'minimum_order_quantity' => $this->float(), // Минимальное количество в заказе
            'price' => $this->float(), // Цена
            'price_max' => $this->float(), // Максимальная цена
            'price_per_square_meter' => $this->float(), // Цена за кв.м
            'price_per_linear_meter' => $this->float(), // Цена за пог.м
            'currency' => $this->string(3), // Код валюты в которой выведена цена, например, RUB
            'created_at' => $this->dateTime(), // Время создания
            'updated_at' => $this->dateTime(), // Время обновления
            'boxtype_id' => $this->integer(), // Идентификатор типа упаковки
            'box_depth' => $this->float(), // float
            'box_height' => $this->float(), // Высота упаковки, см
            'box_width' => $this->float(), // Ширина упаковки, см
            'in_box' => $this->integer(), // Количество в боксе
            'in_set' => $this->float(), // Количество в наборе
            'depth' => $this->smallInteger(), // Глубина, см
            'unit_id' => $this->integer(), // Идентификатор измерения
            'nested_unit_id' => $this->integer(), // Идентификатор вложенного измерения
            'width' => $this->float(), // Ширина, см
            'height' => $this->float(), // Высота, см
            'weight' => $this->float(), // Вес, г
            'trademark_id' => $this->integer(), // Идентификатор торговой марки
            'country_id' => $this->integer(), // Идентификатор страны
            'cart_min_diff' => $this->float(), // Минимальное количество для добавления в корзину
            'keep_package' => $this->smallInteger(), // Сохранять упаковку
            'per_package' => $this->smallInteger(), // Количество в упаковке
            'video_file_name' => $this->string(), // Название файла видео
            'video_file_url' => $this->string(), // Полный URL до видео
            'supplier_code' => $this->string(), // Код поставщика
            'series_id' => $this->integer(), // Идентификатор серии
            'is_hit' => $this->boolean(), // Хит?
            'is_licensed' => $this->boolean(), // Лицензионный
            'is_price_fixed' => $this->boolean(), // Фиксированная цена?
            'is_exclusive' => $this->boolean(), // Эксклюзивный?
            'is_motley' => $this->boolean(), // цвета-mix?
            'is_adult' => $this->boolean(), // Для взрослых?
            'is_protected' => $this->boolean(), // Доступен только авторизованному пользователю?
            'offer_id' => $this->integer(), // Идентификатор распродажи
            'certificate_type_id' => $this->integer(), // Идентификатор типа сертификата
            'has_usb' => $this->boolean(), // Поддерживает usb?
            'has_battery' => $this->boolean(), // В комплекте есть батарея?
            'has_clockwork' => $this->boolean(), // Есть заводной механизм?
            'has_sound' => $this->boolean(), // Есть звук?
            'has_radiocontrol' => $this->boolean(), // Есть дистанционное управление?
            'is_inertial' => $this->boolean(), // Инерционный?
            'is_on_ac_power' => $this->boolean(), // Работает от сети?
            'has_rus_voice' => $this->boolean(), // Есть русский голос?
            'has_rus_pack' => $this->boolean(), // Есть русскоязычная упаковка?
            'has_light' => $this->boolean(), // Есть подсветка?
            'is_day_offer' => $this->boolean(), // Дневное спецпредложение? (устаревший атрибут, в настоящее время не используется)
            'page_title' => $this->string(), // СЕО Заголовок
            'page_keywords' => $this->string(), // СЕО ключевые фразы
            'page_description' => $this->string(), // СЕО описание
            'parent_item_id' => $this->integer(), // Идентификатор старшего товара в группе
            'modifier_id' => $this->integer(), // Идентификатор группирующего признака
            'modifier_value' => $this->string(), // Значение группирующего признака
            'gift_id' => $this->integer(), // Идентификатор подарка
            'surface_area' => $this->float(), // Площадь поверхности, кв.м
            'linear_meters' => $this->float(), // Кол-во погонных метров
            'is_loco' => $this->integer(), // Товар - “локомотив”
            'novelted_at' => $this->string(), // Дата когда товар стал новинкой
            'is_paid_delivery' => $this->boolean(), // Платная доставка
            'package_volume' => $this->float(), // Объем упаковки
            'min_age' => $this->smallInteger(), // Рекомендуемый возраст
            'power' => $this->float(), // Мощность
            'volume' => $this->float(), // Объем, л
            'transport_condition_id' => $this->integer(), // Идентификатор условия транспортировки
            'has_discount' => $this->boolean(), // Имеется ли скидка?
            'is_gift' => $this->boolean(), // Является подарком?
            'is_boxed' => $this->boolean(), // Признак вместимости
            'product_volume' => $this->float(), // Объем продукта, л
            'box_volume' => $this->float(), // Объем бокса, л
            'box_capacity' => $this->smallInteger(), // Количество товара, помещяющегося в бокс
            'packing_volume_factor' => $this->float(), // Коэффициент упаковки
            'is_tire_spike' => $this->boolean(), // Есть шипы?
            'is_tire_run_flat' => $this->boolean(), // Технология RunFlat
            'tire_season_id' => $this->integer(), // Идентификатор сезонности
            'tire_diameter_id' => $this->integer(), // Идентификатор диаметра шины
            'tire_width_id' => $this->integer(), // Идентификатор ширины
            'tire_section_height_id' => $this->integer(), // Идентификатор высоты профиля шины
            'tire_load_index_id' => $this->integer(), // Идентификатор индекса нагрузки шины
            'tire_speed_index_id' => $this->integer(), // Идентификатор индекса скорости шины
            'wheel_lz_id' => $this->integer(), // Идентификатор количества крепёжных точек автомобильного диска
            'wheel_width_id' => $this->integer(), // Идентификатор ширины автомобильного диска
            'wheel_diameter_id' => $this->integer(), // Идентификатор диаметра автомобильного диска
            'wheel_dia_id' => $this->integer(), // Идентификатор диаметра центрального отверстия автомобильного диска
            'wheel_pcd_id' => $this->integer(), // Идентификатор диаметра окружности, на которой расположены центры крепёжных отверстий автомобильного диска
            'wheel_et_id' => $this->integer(), // Идентификатор вылета привалочной плоскости колеса относительно оси симметрии обода
            'has_body_drawing' => $this->boolean(), // Наличие рисунка на корпусе (пока не встречал)
            'has_cord_case' => $this->boolean(), // Есть отсек для шнура (пока не встречал)
            'has_teapot' => $this->boolean(), // Есть заварочный чайник (пока не встречал)
            'has_termostat' => $this->boolean(), // Есть терморегулятор
            //'is_imprintable' => $this->boolean(), // Возможность нанесения рисунка
            'isbn' => $this->string(), // Международный стандартный книжный номер
            'page_count' => $this->smallInteger(), // Количество страниц
            'is_add_to_cart_multiple' => $this->smallInteger(), // Признак кратности добавления товара в корзину
            'supply_period' => $this->smallInteger(), // Срок доставки от поставщика к нам
            'has_action' => $this->boolean(), // Есть акция
            'has_jewelry_action' => $this->boolean(), // Есть акция “Бижутерия” (пока не встречал)
            'has_3_pay_2_action' => $this->boolean(), // Есть акция “3 по цене 2”
            'has_best_fabric' => $this->boolean(), // Лучшая ткань 2016
            'has_number_one_made_in_russia' => $this->boolean(), // №1 сделано в России
            //'photoIndexes' => $this->integer(), // Список индексов изображений
            'audio_filename' => $this->string(), // Имя аудиофайла
            'photo_3d_count' => $this->smallInteger(), // Количество фотографий для формирования 3d изображения
            'is_markdown' => $this->boolean(), // Уценённый товар
            //'is_prepay_needed' => $this->boolean(), // Требуется предоплата
            'is_paid_delivery_ekb' => $this->boolean(), // Платная доставка по Екатеринбургу?
            'currencySign' => $this->string(), // Знак текущей валюты
            'isEnough' => $this->boolean(), // Достаточно ли на складе
            'isAddToCartMultiple' => $this->boolean(), // Кратное ли добавление в корзину
            'minQty' => $this->smallInteger(), // Расчетное минимальное кол-во для заказа, складывается из упаковки и минимальных размеров заданных в 1c и в БД
            'qtyRule' => $this->string(), // Cтрока, описывающая правило заказа. По / от
            'pluralNameFormat' => $this->string(), // Правильное склонение названия единицы измерения для минимального количества в заказе
            'inBoxPluralNameFormat' => $this->string(), // Правильное склонение названия единицы измерения для количества в боксе
            'balancePluralNameFormat' => $this->string(), // Правильное склонение названия единицы измерения для количества на складе
            'photos' => $this->integer(), // Фотографии
            //'country' => $this->integer(), // Страна производитель
            //'offer' => $this->integer(), // Распродажа
            'discountPercent' => $this->smallInteger(), // Процент скидки
            'img' => $this->string(), // URL основной картинки
            'hasGift' => $this->boolean(), // Имеет ли подарок?
            'hasGiftAssignee' => $this->boolean(), // Является ли подарком?
            'isNovelty' => $this->boolean(), // Новинка?
            'itemUrl' => $this->string(), // URL-адрес
            'modifier' => $this->string(30), // Тип модификатора
            'size' => $this->string(), // Габариты (глубина × ширина × высота)
            'stuff' => $this->string(), // Материалы, строка со списком материалов через запятую. Например: “стекло, PVC, картон”
            //'trademark' => $this->integer(), // Торговая марка
            //'series' => $this->integer(), // Серия
            'ecommerce_variant' => $this->string(), // Вариант для ecommerce
            'category_id' => $this->integer(), // Главная категория
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%product}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
