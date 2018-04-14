<?php
/**
 * 
 *
 * @author - @TBotuz
 */

header('Content-Type: text/html; charset=utf-8');
// подрубаем API
require_once("vendor/autoload.php");

// дебаг
if(true){
    error_reporting(E_ALL & ~(E_NOTICE | E_USER_NOTICE | E_DEPRECATED));
    ini_set('display_errors', 1);
}

     

// создаем переменную бота
$token = '<Token>';
$bot = new \TelegramBot\Api\Client($token,null);

// старт 
    $bot->command('start', function ($message) use ($bot) {
        $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
            [
                [
                    ["text" => "🌯 Fast-Food"], 
                    ["text" => "🍕 Пицца"]
                ],
                [
                    ["text" => "🍹 Напитки"]
                ],
                [
                    ["text" => "📥 Корзина"],
                    ["text" => "🚖 Оформить заказ"]
                ]
            ], true, true);

        $username=$message->getChat()->getFirstname();
        $answer = "Добро пажаловать <b>".$username."</b>! Я бот службы доставки кафе «Универ». Что пожелаете?";
        $answer2 = "Отдел доставки работает ежедневно с 09:00 до 18:00";
        $bot->sendMessage($message->getChat()->getId(), $answer, HTML);
        $bot->sendMessage($message->getChat()->getId(), $answer2, HTML, null,null, $keyboard);

    });// END START


// ====== Обработка кнопок у сообщений =============== INLINE ==============

    $bot->on(function($update) use ($bot, $callback_loc, $find_command){
   
    $callback = $update->getCallbackQuery();
    $message = $callback->getMessage();
    $chatId = $message->getChat()->getId();
    $data = $callback->getData();
    $mtext = $message->getText();
    $contact = $message->getContact();
    
    include('includes/database.php');
    $SQL = "SELECT * From product";
    $result_select = mysqli_query($connection,$SQL);

    //Продукт танланганда клавиатуранда 1 дан 10 гача сонлар чикиши

            while(($row = mysqli_fetch_assoc($result_select)))
            {
                $name = $row['product_name'];
                $kafe = $row['product_cafe'];
                $price = $row['product_price'];

                for($i = 1; $i <= 10; $i++)
                    {
                        if($data == $i.$name){

                $amount = $price * $i;

                //------ Базага "Order" таблицага заказлар ва user малумотларини ёзиш ----------------//
                include('includes/database.php');
                $SQL_in = "INSERT INTO `order` (`id`, `order_userid`, `order_productname`, `order_prodectcount`, `order_amount`, `order_prod_cafe`, `phone`) 
                    VALUES (NULL, '".$chatId."', '".$name."', '".$i."', '".$amount."','".$kafe."', '')";
                    $result_in = mysqli_query($connection,$SQL_in);
                //------ END ёзиш ----------------//

              $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
                        [
                            [
                                ["text" => "🌯 Fast-Food"], 
                                ["text" => "🍕 Пицца"]
                            ],
                            [
                                ["text" => "🍹 Напитки"]
                            ],
                            [
                                ["text" => "📥 Корзина"],
                                ["text" => "🚖 Оформить заказ"]
                            ]
                        ], true, true);

                $text = '<b>✅ "'.$name.'" Добавлено  в корзину!</b>
                                          Хотите что-то еще?​'; 

                        $bot->sendMessage($chatId, $text,HTML,null,null, $keyboard);
                        $bot->answerCallbackQuery($callback->getId()); // можно отослать пустое, чтобы просто убрать 

                        }
                    }
            }

    $chatId = $message->getChat()->getId();
    include('includes/database.php');
    $SQL2 = "SELECT * From `order` WHERE `order_userid`=".$chatId;
    $result_select2 = mysqli_query($connection,$SQL2);

        while(($row2 = mysqli_fetch_assoc($result_select2)))
            {   
                    $prod_id = $row2['id'];
                    $name = $row2['order_productname'];


                if($data == 'del'.$prod_id){

                  include('includes/database.php');
                  $SQL5 = "DELETE FROM `order` WHERE `order`.`id` = '".$prod_id."'";
                  $result_delete = mysqli_query($connection,$SQL5);
                  $bot->sendMessage($chatId, $name.' удалено из карзины!');
                  $bot->answerCallbackQuery($callback->getId());

                    }
            }


}, function($update){
    $callback = $update->getCallbackQuery();
    if (is_null($callback) || !strlen($callback->getData()))
        return false;
    return true;
});
// ==================================== END INLINE ===================



$bot->on(function($Update) use ($bot){
    
    $message = $Update->getMessage();
    $mtext = $message->getText();
    $cid = $message->getChat()->getId();
    
   
// обрабтка Кнопка "Назад"
     if(mb_stripos($mtext,"Назад") !== false){

            $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
            [
                [
                    ["text" => "🌯 Fast-Food"], 
                    ["text" => "🍕 Пицца"]
                ],
                [
                    ["text" => "🍹 Напитки"]
                ],
                [
                    ["text" => "📥 Корзина"],
                    ["text" => "🚖 Оформить заказ"]
                ]
            ], true, true);
        $bot->sendMessage($message->getChat()->getId(), "Пожалуйста выборите категорию:", false, null,null,$keyboard); }// END Кнопка "Назад"

// обрабтка Кнопка "Fast-Food'"
    elseif(mb_stripos($mtext,"🌯 Fast-Food") !== false){ 

      $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
        [   
              [
                ["text" => "🔙 Назад"]
              ],
              [
                ["text" => "🌯 Мини Лаваш"], 
                ["text" => "🌭 Хот-дог"]
              ],
              [ 
                ["text" => "🍔 Гамбургер"], 
                ["text" => "Картофель фри"]
              ],
              [
                ["text" => "🌮  Донар в лепешке"]
              ], 
              [
                ["text" => "🌮  Донар в тарелке"]
              ], 
              [
                ["text" => "📥 Корзина"],
                ["text" => "🚖 Оформить заказ"]
              ]
        ], true, true);

       $link_fast_food = '<a href="http://telegra.ph/Fast-Food-07-12">📜 Меню 👇 </a>';

    $bot->sendMessage($message->getChat()->getId(), $link_fast_food, HTML, null,null,$keyboard);

    }// END Кнопка "Fast-Food"

// обрабтка Кнопка "Пицца"
    elseif(mb_stripos($mtext,"🍕 Пицца") !== false){ 

      $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
        [   
              [
                ["text" => "🔙 Назад"]
              ],
              [
                ["text" => "Маргарита"]
              ],
              [ 
                ["text" => "Пеперони"]
              ],
              [ 
                ["text" => "Студенто"]
              ],
              [
                ["text" => "📥 Корзина"],
                ["text" => "🚖 Оформить заказ"]
              ]
        ], true, true);

        $link_pizza = '<a href="http://telegra.ph/Mini-Picca-07-12">📜 Меню 👇 </a>';

    $bot->sendMessage($message->getChat()->getId(), $link_pizza, HTML, null,null,$keyboard);

    }// END Кнопка "Пицца"

// обрабтка Кнопка "Напитки"
    elseif(mb_stripos($mtext,"🍹 Напитки") !== false){ 

      $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
        [   
              [
                ["text" => "🔙 Назад"]
              ],
              [
                ["text" => "Кола 1л"],
                ["text" => "Кола 1,5л"]
              ],
              [ 
                ["text" => "Нестле 1л"],
                ["text" => "Нестле 1,5л "]
              ],
              [ 
                ["text" => "Динай 1л"],
                ["text" => "Сок"]
              ],
              [
                ["text" => "📥 Корзина"],
                ["text" => "🚖 Оформить заказ"]
              ]
        ], true, true);

       $link_nap = '<a href="http://telegra.ph/Napitki-07-12">📜 Меню 👇 </a>';

    $bot->sendMessage($message->getChat()->getId(), $link_nap, HTML, null,null,$keyboard);

    }// END Кнопка "Напитки"

// обрабтка Кнопка "Мини Лаваш"
    elseif(mb_stripos($mtext,"🌯 Мини Лаваш") !== false){ 

      $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
        [   
              [
                ["text" => "🔙 Назад"]
              ],
              [
                ["text" => "Лаваш из говядины"]
              ],
              [
                ["text" => "Лаваш из курицы"]
              ],
              [
                ["text" => "📥 Корзина"],
                ["text" => "🚖 Оформить заказ"]
              ]
        ], true, true);

  $pic = "https://cafebot.000webhostapp.com/assets/menu/lavash.JPG";

    $bot->sendPhoto($message->getChat()->getId(), $pic,'🌯 Лаваш мини',false,$keyboard);

    }// END Кнопка "Мини Лаваш"

// обрабтка Кнопка "Хот-дог"
    elseif(mb_stripos($mtext,"🌭 Хот-дог") !== false){ 

      $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
        [   
              [
                ["text" => "🔙 Назад"]
              ],
              [
                ["text" => "Хот-дог c сосиской"]
              ],
              [
                ["text" => "Хот-дог c колбасой"]
              ],
              [
                ["text" => "📥 Корзина"],
                ["text" => "🚖 Оформить заказ"]
              ]
        ], true, true);

    $pic = "https://cafebot.000webhostapp.com/assets/menu/xot-dog.JPG";

    $bot->sendPhoto($message->getChat()->getId(), $pic,'🌭 Хот-дог',false,$keyboard);

    }// END Кнопка "Хот-дог"

// обрабтка Кнопка "Гамбургерг"
    elseif(mb_stripos($mtext,"🍔 Гамбургер") !== false){ 

      $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
        [   
              [
                ["text" => "🔙 Назад"]
              ],
              [
                ["text" => "Гамбургер из курицы"]
              ],
              [
                ["text" => "Гамбургер из говядины"]
              ],
              [
                ["text" => "📥 Корзина"],
                ["text" => "🚖 Оформить заказ"]
              ]
        ], true, true);

       $pic = "https://cafebot.000webhostapp.com/assets/menu/gam.JPG";

    $bot->sendPhoto($message->getChat()->getId(), $pic,'🍔 Гамбургер',false,$keyboard);

    }// END Кнопка "Гамбургер"

// обрабтка Кнопка "Донар в лепешкег"
    elseif(mb_stripos($mtext,"🌮  Донар в лепешке") !== false){ 

      $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
        [   
              [
                ["text" => "🔙 Назад"]
              ],
              [
                ["text" => "Донар в лепешке из курицы"]
              ],
              [
                ["text" => "Донар в лепешке из говядины"]
              ],
              [
                ["text" => "📥 Корзина"],
                ["text" => "🚖 Оформить заказ"]
              ]
        ], true, true);

       $pic = "https://cafebot.000webhostapp.com/assets/menu/donar_v_lep.JPG";

    $bot->sendPhoto($message->getChat()->getId(), $pic,'🌮  Донар в лепешке',false,$keyboard);

    }// END Кнопка "Донар в лепешке"
    // обрабтка Кнопка "Донар в лепешкег"
    elseif(mb_stripos($mtext,"🌮  Донар в тарелке") !== false){ 

      $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
        [   
              [
                ["text" => "🔙 Назад"]
              ],
              [
                ["text" => "Донар в Тарелке из курицы"]
              ],
              [
                ["text" => "Донар в Тарелке из говядины"]
              ],
              [
                ["text" => "📥 Корзина"],
                ["text" => "🚖 Оформить заказ"]
              ]
        ], true, true);

       $pic = "https://cafebot.000webhostapp.com/assets/menu/donar_v_tar.JPG";

    $bot->sendPhoto($message->getChat()->getId(), $pic,'🌮  Донар в Тарелке',false,$keyboard);

    }// END Кнопка "Донар в лепешке"

// ================ Очистить корзину =========================///
 elseif(mb_stripos($mtext,"🔄 Очистить корзину") !== false){
    $userID = $message->getChat()->getId();
    include('includes/database.php');
        $SQL6 = "DELETE FROM `order` WHERE `order`.`order_userid` = '".$userID."'";
        $result_delete2 = mysqli_query($connection,$SQL6);

    $bot->sendMessage($message->getChat()->getId(), "Корзина очищена!");

    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
            [
                [
                    ["text" => "🌯 Fast-Food"], 
                    ["text" => "🍕 Пицца"]
                ],
                [
                    ["text" => "🍹 Напитки"]
                ],
                [
                    ["text" => "📥 Корзина"],
                    ["text" => "🚖 Оформить заказ"]
                ]
            ], true, true);
    $bot->sendMessage($message->getChat()->getId(), "Пожалуйста выборите категорию:", false, null,null,$keyboard);
    }// END Кнопка Очистить корзину

// ================ Оформить заказ ===========================///

    elseif(mb_stripos($mtext,"🚖 Оформить заказ") !== false){

         $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
        [   
              [
                ["text" => "📲 Отправить свой номер","request_contact" => true]
              ],
              [
                ["text" => "🔙 Назад"]
              ]
        ], true, true);

    $text = "📲 Отправьте ваш номер телефона: ".$contact;
    $bot->sendMessage($message->getChat()->getId(), $text, false, null,null,$keyboard);
    }// END "Оформить заказ""

// Агар $mtext да контакт жунатилган булса Пастдаги амалларни бажар 
    elseif($mtext == $contact){

         $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
            [   
                  [
                    ["text" => "☑ Подтвердить"],
                    ["text" => "🔙 Назад"]
                  ]
            ], true, true);

        $number = $message->getContact()->getPhoneNumber();
        $userID = $message->getChat()->getId();

        //------ Базага Тел ракамини "Order" таблицага ёзиш ----------------//
            include('includes/database.php');
            $SQL_int = "UPDATE `order` SET `phone` = '+".$number."' WHERE `order`.`order_userid` = '".$userID."';";
            $result_in = mysqli_query($connection,$SQL_int);
         //------ ------------------------------END ёзиш ----------------//

        // -------- SELECT FROM ORDERS Контакт жунатилганда Order ларни чикариш -------------//

            $text = "<b>Вашы заказы:</b>";        
            $bot->sendMessage($message->getChat()->getId(), $text, HTML, null,null,$keyboard);


                    $SQL_select= "SELECT * From `order` WHERE `order_userid`=".$userID;
                    $result_sel = mysqli_query($connection,$SQL_select);
                    $i= 1;  // аказлар сонини санаш учун
                    $S=0;   // Умумий суммани хисоблаш учун
                        while(($row2 = mysqli_fetch_assoc($result_sel)))
                            {

                                    $product_name = $row2['order_productname'];
                                    $product_count = $row2['order_prodectcount'];
                                    $product_amount = $row2['order_amount'];
                                    $product_price = ($row2['order_amount'] / $row2['order_prodectcount']);
                        $text = "<b>".$i."-заказ:</b> <b>".$product_name."</b> ".$product_count." x ".$product_price." = ".$product_amount;        
                         
                         $bot->sendMessage($message->getChat()->getId(), $text, HTML, null,null,$keyboard); 
                                    $S = $S + $product_amount;
                                    $i++;

                            }
                // ---------------------------- END SELECT FROM ORDERS --------------------------//


             $bot->sendMessage($message->getChat()->getId(), '<b>Итого:</b> '.$S.' сум', HTML, null,null,$keyboard);          

    } //  END ELSEIF     

// ==========================  ☑ Подтвердить ==================///
    elseif(mb_stripos($mtext,"☑ Подтвердить") !== false){

             $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
            [   
                  [
                    ["text" => "🔙 Назад"]
                  ]
            ], true, true);
        
        $text = "✔ СПАСИБО! Ваш заказ передан на обработку. Ждите ответа оператора.";
        $bot->sendMessage($message->getChat()->getId(), $text, false, null,null,$keyboard);
         

     // ============== Отправка заказов в ГРУППУ "ExFood Zakaz"  =========================
        $fuser = '-230454596'; // ExFood Zakaz группа ID
        $userID = $message->getChat()->getId();
        $text2 = "Заказы клиента <b>".$message->getChat()->getFirstname().":</b>";        
        $bot->sendMessage($fuser, $text2, HTML, null,null,$keyboard);

                include('includes/database.php');
                $SQL_select2= "SELECT * From `order` WHERE `order_userid`=".$userID;
                $result_sel2 = mysqli_query($connection,$SQL_select2);
                $i = 1;  // аказлар сонини санаш учун
                $S = 0; // Умумий суммани хисоблаш учун
                        while(($row3 = mysqli_fetch_assoc($result_sel2)))
                            {

                                    $product_name = $row3['order_productname'];
                                    $product_count = $row3['order_prodectcount'];
                                    $product_amount = $row3['order_amount'];
                                    $product_price = ($row3['order_amount'] / $row3['order_prodectcount']);
                                    $phone = $row3['phone'];
                        $text3 = "<b>".$i."-заказ:</b><b>".$product_name."</b>".$product_count." x ".$product_price." = ".$product_amount;        
                         $bot->sendMessage($fuser, $text3, HTML, null,null,$keyboard);  
                                    $S = $S + $product_amount;

                                    $i++;



                            }
                // ---------------------------- END SELECT FROM ORDERS --------------------------//


             $bot->sendMessage($fuser, '<b>Итого:</b> '.$S.' сум', HTML);
             $bot->sendMessage($fuser, '<b>Тел:</b> '.$phone, HTML, null,null,$keyboard);
         
    } // ============== END Отправка заказов в ГРУППУ "ExFood Zakaz"  =========================

     // ========================== END Оформить заказ ==============================/////

        // ================ Корзина ===========================///

        elseif(mb_stripos($mtext,"📥 Корзина") !== false){
             $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
                [   
                    [
                        ["text" => "🔄 Очистить корзину"]
                    ],
                    [
                        ["text" => "🚖 Оформить заказ"]
                    ],
                    [
                        ["text" => "🔙 Назад"]
                    ]
                ], true, true);
            $userID = $message->getChat()->getId();
            $text = "<b> Вашы заказы:</b>";
            $bot->sendMessage($message->getChat()->getId(), $text, HTML, null,null,$keyboard);
            include('includes/database.php'); 
            $SQL_select= "SELECT * From `order` WHERE `order_userid`=".$userID;
                    $result_sel = mysqli_query($connection,$SQL_select);
                    $i= 1;  // аказлар сонини санаш учун
                    $S=0;   // Умумий суммани хисоблаш учун
                        while(($row2 = mysqli_fetch_assoc($result_sel)))
                            {
                                
                                    $prod_id = $row2['id'];
                                    $product_name = $row2['order_productname'];
                                    $product_count = $row2['order_prodectcount'];
                                    $product_amount = $row2['order_amount'];
                                    $product_price = ($row2['order_amount'] / $row2['order_prodectcount']);
                        $text = "<b>".$i."-заказ:</b> <b>".$product_name."</b>".$product_count." x ".$product_price." = ".$product_amount;    
                         $keyboard2 = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
                            [
                                [

                                    ['callback_data' => 'del'.$prod_id, 'text' => '❌ Удалить из карзины']
                                ]
                            ]
                        );      
                         $bot->sendMessage($message->getChat()->getId(), $text, HTML, null,null,$keyboard2);    

                                    $S = $S + $product_amount;

                                    $i++;

                            }

 $bot->sendMessage($message->getChat()->getId(), "Итого: <b>".$S." сум</b>", HTML); 

        }// END "Корзина""


        // Менюдан бирор бир продукт танланганда у продукт номи ссылка куринишида $date га уланади

        include('includes/database.php');
        $SQL = "SELECT * From product";
        $result_select = mysqli_query($connection,$SQL);

                while(($row = mysqli_fetch_assoc($result_select)))
                {

                    $name = $row['product_name']; // Базадан олинган бирор бир продукт танласа

                    if(mb_stripos($mtext,$name) !== false){

                       $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
                            [
                                [
                                    ['callback_data' => '1'.$mtext, 'text' => '1 штук'],
                                    ['callback_data' => '2'.$mtext, 'text' => '2 штуки'],
                                    ['callback_data' => '3'.$mtext, 'text' => '3 штуки']
                                ],
                                [
                                    ['callback_data' => '4'.$mtext, 'text' => '4 штуки'],
                                    ['callback_data' => '5'.$mtext, 'text' => '5 штук'],
                                    ['callback_data' => '6'.$mtext, 'text' => '6 штук']
                                ],
                                [
                                    ['callback_data' => '7'.$mtext, 'text' => '7 штук'],
                                    ['callback_data' => '8'.$mtext, 'text' => '8 штук'],
                                    ['callback_data' => '9'.$mtext, 'text' => '9 штук']
                                ]
                            ], false, false); // END KEYBOARD

            
                 $desc = $mtext.' '.$row['product_text'].'  Цена: '.$row['product_price'].' сум';
 				 $text = 'Выберите количество: ';
                 $bot->sendMessage($message->getChat()->getId(), $text, false, null,null,$keyboard);
                }
        }

}, function($message) use ($name){
    return true; // когда тут true - команда проходит
});


$bot->run();

echo "бот";

