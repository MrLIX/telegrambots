<?php
/**
 *
 *
 * @author - Nazirov LIX
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
$token = "<token>";
$bot = new \TelegramBot\Api\Client($token,null);

// старт
$bot->command('start', function ($message) use ($bot) {
    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
        [
            [
                ["text" => "🇷🇺 Русский"],
                ["text" => "🇺🇿 O'zbekcha"]
            ]
        ], true, true);

    $username=$message->getChat()->getFirstname();
    $answer = "Добро пажаловать <b>".$username."</b>
	Пожалуйста выберите язык для продолжения:";
    $bot->sendMessage($message->getChat()->getId(), $answer, HTML, null,null, $keyboard);

});
// END START



$bot->on(function($Update) use ($bot) {
    

    $message = $Update->getMessage();
    $mtext = $message->getText();
    $cid = $message->getChat()->getId();
    
     
    // обрабтка Кнопка "Назад"
    if (mb_stripos($mtext, "🔙 Назад") !== false) {

        $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
            [
                [
                    ["text" => "🇷🇺 Русский"],
                    ["text" => "🇺🇿 O'zbekcha"]
                ]
            ], true, true);

        $bot->sendMessage($message->getChat()->getId(), "Пожалуйста выборите язык для продолжения:", false, null, null, $keyboard);
    }
    // END Кнопка "Назад"
    
     // обрабтка Кнопка "Назад"
    if (mb_stripos($mtext, "🔙 Ortga") !== false) {

        $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
            [
                [
                    ["text" => "🇷🇺 Русский"],
                    ["text" => "🇺🇿 O'zbekcha"]
                ]
            ], true, true);

        $bot->sendMessage($message->getChat()->getId(), "Пожалуйста выборите язык для продолжения:", false, null, null, $keyboard);
    }
    // END Кнопка "Назад"

    //------------------------------ РУССКИЙ ЯЗЫК  ------------------------------//

    // обрабтка Кнопка "🇷🇺Русский"
    elseif (mb_stripos($mtext, "🇷🇺 Русский") !== false) {

        $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
            [
                [
                    ["text" => "🏛 О банке"],
                    ["text" => "🏫 Филиальная сеть"]
                ],

                [
                    ["text" => "📰 Новости"],
                    ["text" => "💵 Курс валют"]
                ],
                [
                    ["text" => "💼 Юридическим лицам"],
                    ["text" => "👤 Физическим лицам"]
                ],
                [
                    ["text" => "☎️ Контакты"],

                ],
                [
                    ["text" => "🔙 Назад"],

                ],
            ], true, true);

        $text = 'Сайт АКБ «Узпромстройбанк» www.uzpsb.uz';

        $bot->sendMessage($message->getChat()->getId(), $text, false, null, null, $keyboard);

    }// END Кнопка "🇷🇺Русский"
    
    // обрабтка Кнопка "🇺🇿 O'zbekcha"
    
    elseif (mb_stripos($mtext, "🇺🇿 O'zbekcha") !== false) {

        $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
            [
                [
                    ["text" => "🏛 Bank haqida"],
                    ["text" => "🏫 Bank filliallari"]
                ],

                [
                    ["text" => "📰 Yangiliklar"],
                    ["text" => "💵 Kurs"]
                ],
                [
                    ["text" => "💼 Yuridik shaxslarga"],
                    ["text" => "👤 Jismoniy shaxslarga"]
                ],
                [
                    ["text" => "☎️ Biz bilan aloqa"],
                ],
                [
                    ["text" => "🔙 Ortga"],

                ],
            ], true, true);
        $text = '"O\'zsanoatqurilishbank" sayti: www.uzpsb.uz';

        $bot->sendMessage($message->getChat()->getId(), $text, false, null, null, $keyboard);

    }


  

    // обрабтка Кнопка "◀ Ortga"
    
    elseif (mb_stripos($mtext, "◀ Ortga") !== false) {

        $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
            [
                [
                    ["text" => "🏛 Bank haqida"],
                    ["text" => "🏫 Bank filliallari"]
                ],

                [
                    ["text" => "📰 Yangiliklar"],
                    ["text" => "💵 Kurs"]
                ],
                [
                    ["text" => "💼 Yuridik shaxslarga"],
                    ["text" => "👤 Jismoniy shaxslarga"]
                ],
                [
                    ["text" => "☎️ Biz bilan aloqa"],
                ],
                [
                    ["text" => "🔙 Ortga"],

                ],
            ], true, true);
        $text = '"O\'zsanoatqurilishbank" sayti: www.uzpsb.uz';

        $bot->sendMessage($message->getChat()->getId(), $text, false, null, null, $keyboard);

    } // Ortga
    
     // обрабтка Кнопка "🏛 О банке" -> "◀ Назад"
    elseif (mb_stripos($mtext, "◀ Назад") !== false) {

        $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
            [
                [
                    ["text" => "🏛 О банке"],
                    ["text" => "🏫 Филиальная сеть"]
                ],

                [
                    ["text" => "📰 Новости"],
                    ["text" => "💵 Курс валют"]
                ],
                [
                    ["text" => "💼 Юридическим лицам"],
                    ["text" => "👤 Физическим лицам"]
                ],
                [
                    ["text" => "☎️ Контакты"],

                ],
                [
                    ["text" => "🔙 Назад"],

                ],
            ], true, true);


        $text = 'Выберите раздел:';
        $bot->sendMessage($message->getChat()->getId(), $text, false, null, null, $keyboard);

    }// END Кнопка "🏛 О банке"->"◀ Назад"


    //---------------------------   Общая информация  ---------------------------//

  else {
      
      include('includes/database.php');
      include('includes/functions.php');    
      
      //-------------------------- "О банке"  -----------------------------//
        
             
              $SQL_obanke2 = "SELECT * FROM o_banke_menu WHERE menu_id = 99";
              $result_obanke2 = mysqli_query($connection, $SQL_obanke2);
              $SQL_obanke = "SELECT * FROM o_banke_menu WHERE menu_id = 1";
              $result_obanke = mysqli_query($connection, $SQL_obanke);
          
           if(mb_stripos($mtext, "🏛 О банке") !== false) {
                  
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(menuru($result_obanke), true, true);     
                    
                    $bot->sendMessage($message->getChat()->getId(),textru($result_obanke2), HTML, null, null, $keyboard);
  
                 }
           if(mb_stripos($mtext, "◀ Hазад") !== false) {  //Назад к о банке Н- lotincha
                  
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(menuru($result_obanke), true, true);      
                    
                    $bot->sendMessage($message->getChat()->getId(),textru($result_obanke2), HTML, null, null, $keyboard);
  
                 }
           if(mb_stripos($mtext, "🏛 Bank haqida") !== false) {       
         
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(menuuz($result_obanke), true, true);

                    $bot->sendMessage($message->getChat()->getId(), textuz($result_obanke2), HTML, null, null, $keyboard);
             }
            if(mb_stripos($mtext, "◀ Оrtga") !== false) {  // Bank haqida O kirilcha     
         
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(menuuz($result_obanke), true, true);
                   

                    $bot->sendMessage($message->getChat()->getId(), textuz($result_obanke2), HTML, null, null, $keyboard);
             }
             
            while($row_subobanke = mysqli_fetch_assoc($result_obanke)) { 
                
           
               $SQL_subobanke = "SELECT * FROM o_banke WHERE menu_id = ". $row_subobanke['id'];
               $result_subobanke = mysqli_query($connection, $SQL_subobanke);
              
             
               
                  
                if(mb_stripos($mtext, "📁 ".$row_subobanke['title_ru']) !== false) {
              
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(submenuru($result_subobanke), true, true); 
                    
                    $bot->sendMessage($message->getChat()->getId(),$row_subobanke['text_ru'], HTML, null, null, $keyboard);
              
                }
                
                if(mb_stripos($mtext, "📁 ".$row_subobanke['title_uz']) !== false) {
              
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(submenuuz($result_subobanke), true, true);            
                    $bot->sendMessage($message->getChat()->getId(),$row_subobanke['text_uz'], HTML, null, null, $keyboard);
              
                }
                
                   while($row_infoobanke2 = mysqli_fetch_assoc($result_subobanke)) { //   Общая инфони ичи
                       
                         $SQL_subobanke1 = "SELECT * FROM o_banke WHERE menu_id = ". $row_subobanke['id'];
                         $result_subobanke1 = mysqli_query($connection, $SQL_subobanke1);
    
                         if(mb_stripos($mtext, $row_infoobanke2['title_ru']) !== false) {

                           $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(submenuru($result_subobanke1), true, true);
                           
                            if(!empty($row_infoobanke2['pic'])): 
                                $pic = $row_infoobanke2['pic'];
                                $title = $row_infoobanke2['title_ru'];
                                $bot->sendPhoto($message->getChat()->getId(), $pic, $title ,false,$keyboard); 
                            else:
                                $text = $row_infoobanke2['text_ru'];
                                $bot->sendMessage($message->getChat()->getId(), $text, false, null, null, $keyboard);
                            endif;
                           
                          
                         }
                         
                         if(mb_stripos($mtext, $row_infoobanke2['title_uz']) !== false) {

                           $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(submenuuz($result_subobanke1), true, true);  
                           
                            if(!empty($row_infoobanke2['pic'])): 
                                $pic = $row_infoobanke2['pic'];
                                $title = $row_infoobanke2['title_uz'];
                                $bot->sendPhoto($message->getChat()->getId(), $pic, $title ,false,$keyboard); 
                            else:
                                $text = $row_infoobanke2['text_uz'];
                                $bot->sendMessage($message->getChat()->getId(), $text, false, null, null, $keyboard);
                            endif;
                          
                  
                         }
                    
                      }
                  
                    
              
            }
            
     //-------------------------- END "О банке" -----------------------------//
     
      //-------------------------- "🏫 Филиальная сет" -----------------------------//
      
         $SQL_filial = "SELECT * FROM filial WHERE menu_id = 99";
              $result_filial = mysqli_query($connection, $SQL_filial);
              $SQL_filial2 = "SELECT * FROM filial WHERE menu_id = 1";
              $result_filial2 = mysqli_query($connection, $SQL_filial2);
            
            if(mb_stripos($mtext, "🏫 Филиальная сеть") !== false) {
                  
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(menuru($result_filial2), true, true);     
                    
                    $bot->sendMessage($message->getChat()->getId(),textru($result_filial), HTML, null, null, $keyboard);
  
                 }
            if(mb_stripos($mtext, "◀ Haзaд") !== false) {  //Назад к  Филиальная сеть
                  
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(menuru($result_filial2), true, true);      
                    
                    $bot->sendMessage($message->getChat()->getId(),textru($result_filial), HTML, null, null, $keyboard);
  
                 }
            if(mb_stripos($mtext, "🏫 Bank filliallari") !== false) {       
         
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(menuuz($result_filial2), true, true);

                    $bot->sendMessage($message->getChat()->getId(), textuz($result_filial), HTML, null, null, $keyboard);
             }
            if(mb_stripos($mtext, "◀ 0rtgа") !== false) {  //  🏫 Bank filliallari Ortga a кирилча 
         
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(menuuz($result_filial2), true, true);
                   

                    $bot->sendMessage($message->getChat()->getId(), textuz($result_filial), HTML, null, null, $keyboard);
             }
             
             
             while($row_filial_sub = mysqli_fetch_assoc($result_filial2)) { 
                
           
               $SQL_filial_sub = "SELECT * FROM filial_sub WHERE filial_id = ". $row_filial_sub['id'];
               $result_sub_filial = mysqli_query($connection, $SQL_filial_sub);
              
             
               
                  
                if(mb_stripos($mtext, "📁 ".$row_filial_sub['title_ru']) !== false) {
              
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(submenuru_fil($result_sub_filial), true, true); 
                    
                    $bot->sendMessage($message->getChat()->getId(),$row_filial_sub['text_ru'], HTML, null, null, $keyboard);
              
                }
                
                if(mb_stripos($mtext, "📁 ".$row_filial_sub['title_uz']) !== false) {
              
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(submenuuz_fil($result_sub_filial), true, true);            
                    $bot->sendMessage($message->getChat()->getId(),$row_filial_sub['text_uz'], HTML, null, null, $keyboard);
              
                }
                
                  while($row_filial_sub2 = mysqli_fetch_assoc($result_sub_filial)) { //   Общая инфони ичи
                       
                         $SQL_sub_filial2 = "SELECT * FROM filial_sub WHERE filial_id = ". $row_filial_sub['id'];
                         $result_sub_filial2 = mysqli_query($connection, $SQL_sub_filial2);
    
                         if($mtext == $row_filial_sub2['title_ru']){

                          $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(submenuru_fil($result_sub_filial2), true, true);
                           
                            if(!empty($row_filial_sub2['pic'])): 
                                $pic = $row_filial_sub2['pic'];
                                $title = $row_filial_sub2['title_ru'];
                                $bot->sendPhoto($message->getChat()->getId(), $pic, $title ,false,$keyboard); 
                            else:
                                $text = $row_filial_sub2['text_ru'];
                                $bot->sendMessage($message->getChat()->getId(), $text, false, null, null, $keyboard);
                            endif;
                           
                          
                         }
                         
                         if($mtext == $row_filial_sub2['title_uz']){

                          $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(submenuuz_fil($result_sub_filial2), true, true);  
                           
                            if(!empty($row_filial_sub2['pic'])): 
                                $pic = $row_filial_sub2['pic'];
                                $title = $row_filial_sub2['title_uz'];
                                $bot->sendPhoto($message->getChat()->getId(), $pic, $title ,false,$keyboard); 
                            else:
                                $text = $row_filial_sub2['text_uz'];
                                $bot->sendMessage($message->getChat()->getId(), $text, false, null, null, $keyboard);
                            endif;
                          
                  
                         }
                    
                      }
                  
                    
              
            }
      
      //-------------------------- END "🏫 Филиальная сет" -----------------------------//
     
    //-------------------------- "📰 Новости" -----------------------------//
     
      $SQL_news = "SELECT * FROM news LIMIT 3";
      $result_news = mysqli_query($connection, $SQL_news);
      
      while($row_news = mysqli_fetch_assoc($result_news)) {
          
          if(mb_stripos($mtext,"📰 Новости") !== false) {
              
               $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
                [
                    [
                        ["text" => "🏛 О банке"],
                        ["text" => "🏫 Филиальная сеть"]
                    ],
    
                    [
                        ["text" => "📰 Новости"],
                        ["text" => "💵 Курс валют"]
                    ],
                    [
                        ["text" => "💼 Юридическим лицам"],
                        ["text" => "👤 Физическим лицам"]
                    ],
                    [
                        ["text" => "☎️ Контакты"],
    
                    ],
                    [
                        ["text" => "🔙 Назад"],
    
                    ],
                ], true, true);
      if(!empty($row_news[title_ru])):  
        if(!empty($row_news['pic'])): 
            $pic = $row_news['pic'];
            $linc =  $row_news['linc'];
            $title = $row_news['title_ru'];
            $text = $title . "
 Подробно - " . $linc;
            
            $bot->sendPhoto($message->getChat()->getId(), $pic, $text, HTML, $keyboard); 
        else:
            $text = "<b>" .$title = $row_news['title_ru'] . "</b>"; 
            $linc =  $row_news['linc'];
            $text .= "
    ".substrwords($row_news['text_ru'], 300) . "
    <a href='" .$linc."'>👉 Подробно</a>";
            
          
            $bot->sendMessage($message->getChat()->getId(), $text, HTML, null, null, $keyboard);
        endif;
      endif;
     
           }
      
           if (mb_stripos($mtext, "📰 Yangiliklar") !== false) {
    
            $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
                [
                    [
                        ["text" => "🏛 Bank haqida"],
                        ["text" => "🏫 Bank filliallari"]
                    ],
    
                    [
                        ["text" => "📰 Yangiliklar"],
                        ["text" => "💵 Kurs"]
                    ],
                    [
                        ["text" => "💼 Yuridik shaxslarga"],
                        ["text" => "👤 Jismoniy shaxslarga"]
                    ],
                    [
                        ["text" => "☎️ Biz bilan aloqa"],
                    ],
                    [
                        ["text" => "🔙 Ortga"],
    
                    ],
                ], true, true);
            
       if(!empty($row_news[title_uz])):  
            if(!empty($row_news['pic'])): 
            $pic = $row_news['pic'];
            $linc =  $row_news['linc'];
            $title = $row_news['title_uz'];
            $text = $title . "
 Batafsil - " . $linc;
            
            $bot->sendPhoto($message->getChat()->getId(), $pic, $text, HTML, $keyboard); 
        else:
            $text = "<b>" .$title = $row_news['title_uz'] . "</b>"; 
            $linc =  $row_news['linc'];
            $text .= "
    ".substrwords($row_news['text_uz'], 300) . "
    <a href='" .$linc."'>👉 Batafsil</a>";
            
          
            $bot->sendMessage($message->getChat()->getId(), $text, HTML, null, null, $keyboard);
            endif;
       endif;
          }
          
      
     
     
      }
      
      //-------------------------- END "📰 Новост" -----------------------------//
      
     
     //-------------------------- "💵 Курс валю" -----------------------------//
     
      $SQL_kurs = "SELECT * FROM kurs WHERE id = 1";
      $result_kurs = mysqli_query($connection, $SQL_kurs);
      
      while($row_kurs = mysqli_fetch_assoc($result_kurs)) {
          
          if(mb_stripos($mtext,"💵 Курс валют") !== false) {
              
               $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
                [
                    [
                        ["text" => "🏛 О банке"],
                        ["text" => "🏫 Филиальная сеть"]
                    ],
    
                    [
                        ["text" => "📰 Новости"],
                        ["text" => "💵 Курс валют"]
                    ],
                    [
                        ["text" => "💼 Юридическим лицам"],
                        ["text" => "👤 Физическим лицам"]
                    ],
                    [
                        ["text" => "☎️ Контакты"],
    
                    ],
                    [
                        ["text" => "🔙 Назад"],
    
                    ],
                ], true, true);

        if(!empty($row_kurs['pic'])): 
            $pic = $row_kurs['pic'];
            $title = $row_kurs['title_ru'];
            $bot->sendPhoto($message->getChat()->getId(), $pic, $title ,false,$keyboard); 
        else:
            $text = $row_kurs['text_ru'];
            $bot->sendMessage($message->getChat()->getId(), $text, false, null, null, $keyboard);
        endif;
     
           }
      
           if (mb_stripos($mtext, "💵 Kurs") !== false) {
    
            $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
                [
                    [
                        ["text" => "🏛 Bank haqida"],
                        ["text" => "🏫 Bank filliallari"]
                    ],
    
                    [
                        ["text" => "📰 Yangiliklar"],
                        ["text" => "💵 Kurs"]
                    ],
                    [
                        ["text" => "💼 Yuridik shaxslarga"],
                        ["text" => "👤 Jismoniy shaxslarga"]
                    ],
                    [
                        ["text" => "☎️ Biz bilan aloqa"],
                    ],
                    [
                        ["text" => "🔙 Ortga"],
    
                    ],
                ], true, true);
                
           if(!empty($row_kurs['pic'])): 
                $pic = $row_kurs['pic'];
                $title = $row_kurs['title_uz'];
                $bot->sendPhoto($message->getChat()->getId(), $pic, $title, false, $keyboard); 
            else:
                $text = $row_kurs['text_uz'];
                $bot->sendMessage($message->getChat()->getId(), $text, false, null, null, $keyboard);
            endif;
    
          }
      
     
     
      }
      
      //-------------------------- END "💵 Курс валю" -----------------------------//
      
      
        //-------------------------- "💼 Юридическим лицаю" -----------------------------//
      
              $SQL_yur_licam = "SELECT * FROM yur_licam WHERE menu_id = 99";
              $result_yur_licam = mysqli_query($connection, $SQL_yur_licam);
              $SQL_yur_licam2 = "SELECT * FROM yur_licam WHERE menu_id = 1";
              $result_yur_licam2 = mysqli_query($connection, $SQL_yur_licam2);
            
            if(mb_stripos($mtext, "💼 Юридическим лицам") !== false) {
                  
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(menuru($result_yur_licam2), true, true);     
                    
                    $bot->sendMessage($message->getChat()->getId(),textru($result_yur_licam), HTML, null, null, $keyboard);
  
                 }
            if(mb_stripos($mtext, "◀ Нaзад") !== false) {  //Назад к  Юридическим лицам биринчи а лотинча
                  
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(menuru($result_yur_licam2), true, true);      
                    
                    $bot->sendMessage($message->getChat()->getId(),textru($result_yur_licam), HTML, null, null, $keyboard);
  
                 }
            if(mb_stripos($mtext, "💼 Yuridik shaxslarga") !== false) {       
         
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(menuuz($result_yur_licam2), true, true);

                    $bot->sendMessage($message->getChat()->getId(), textuz($result_yur_licam), HTML, null, null, $keyboard);
             }
            if(mb_stripos($mtext, "◀ Ortgа") !== false) {  //  Yuridik shaxslarg Ortga a кирилча 
         
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(menuuz($result_yur_licam2), true, true);
                   

                    $bot->sendMessage($message->getChat()->getId(), textuz($result_yur_licam), HTML, null, null, $keyboard);
             }
             
             
             while($row_yur_licam_sub = mysqli_fetch_assoc($result_yur_licam2)) { 
                
           
               $SQL_yur_licam_sub = "SELECT * FROM yur_licam_sub WHERE menu_id = ". $row_yur_licam_sub['id'];
               $result_sub_yur_licam = mysqli_query($connection, $SQL_yur_licam_sub);
              
             
               
                  
                if(mb_stripos($mtext, "📁 ".$row_yur_licam_sub['title_ru']) !== false) {
              
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(submenuru_yur($result_sub_yur_licam), true, true); 
                    
                    $bot->sendMessage($message->getChat()->getId(),$row_yur_licam_sub['text_ru'], HTML, null, null, $keyboard);
              
                }
                
                if(mb_stripos($mtext, "📁 ".$row_yur_licam_sub['title_uz']) !== false) {
              
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(submenuuz_yur($result_sub_yur_licam), true, true);            
                    $bot->sendMessage($message->getChat()->getId(),$row_yur_licam_sub['text_uz'], HTML, null, null, $keyboard);
              
                }
                
                  while($result_sub_yur_licam2 = mysqli_fetch_assoc($result_sub_yur_licam)) { //   Общая инфони ичи
                       
                         $SQL_sub_yur_licam2 = "SELECT * FROM yur_licam_sub WHERE menu_id = ". $row_yur_licam_sub['id'];
                         $result_sub_yur_licam3 = mysqli_query($connection, $SQL_sub_yur_licam2);
    
                         if($mtext == $result_sub_yur_licam2['title_ru']){

                          $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(submenuru_yur($result_sub_yur_licam3), true, true);
                           
                            if(!empty($result_sub_yur_licam2['pic'])): 
                                $pic = $result_sub_yur_licam2['pic'];
                                $title = $result_sub_yur_licam2['title_ru'];
                                $bot->sendPhoto($message->getChat()->getId(), $pic, $title ,false,$keyboard); 
                            else:
                                $text = $result_sub_yur_licam2['text_ru'];
                                $bot->sendMessage($message->getChat()->getId(), $text, false, null, null, $keyboard);
                            endif;
                           
                          
                         }
                         
                         if($mtext == $result_sub_yur_licam2['title_uz']){

                          $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(submenuuz_yur($result_sub_yur_licam3), true, true);  
                           
                            if(!empty($result_sub_yur_licam2['pic'])): 
                                $pic = $result_sub_yur_licam2['pic'];
                                $title = $result_sub_yur_licam2['title_uz'];
                                $bot->sendPhoto($message->getChat()->getId(), $pic, $title ,false,$keyboard); 
                            else:
                                $text = $result_sub_yur_licam2['text_uz'];
                                $bot->sendMessage($message->getChat()->getId(), $text, false, null, null, $keyboard);
                            endif;
                          
                  
                         }
                    
                      }
                  
                    
              
            }
      
      
      
      
      
      
      
       //-------------------------- END "💼 Юридическим лицаю" -----------------------------//
       
       //--------------------------  "👤 Физическим лицам" -----------------------------//
       
              $SQL_fiz_licam = "SELECT * FROM fiz_licam WHERE menu_id = 99";
              $result_fiz_licam = mysqli_query($connection, $SQL_fiz_licam);
              $SQL_fiz_licam2 = "SELECT * FROM fiz_licam WHERE menu_id = 1";
              $result_fiz_licam2 = mysqli_query($connection, $SQL_fiz_licam2);
            
            if(mb_stripos($mtext, "👤 Физическим лицам") !== false) {
                  
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(menuru($result_fiz_licam2), true, true);     
                    
                    $bot->sendMessage($message->getChat()->getId(),textru($result_fiz_licam), HTML, null, null, $keyboard);
  
                 }
            if(mb_stripos($mtext, "◀ Назaд") !== false) {  //Назад к  👤 Частным клиентам иккинчи а лотинча
                  
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(menuru($result_fiz_licam2), true, true);      
                    
                    $bot->sendMessage($message->getChat()->getId(),textru($result_fiz_licam), HTML, null, null, $keyboard);
  
                 }
            if(mb_stripos($mtext, "👤 Jismoniy shaxslarga") !== false) {       
         
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(menuuz($result_fiz_licam2), true, true);

                    $bot->sendMessage($message->getChat()->getId(), textuz($result_fiz_licam), HTML, null, null, $keyboard);
             }
            if(mb_stripos($mtext, "◀ Оrtgа") !== false) {  //  👤 Shaxsiy klientlarg a ва О кирилча 
         
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(menuuz($result_fiz_licam2), true, true);
                   

                    $bot->sendMessage($message->getChat()->getId(), textuz($result_fiz_licam), HTML, null, null, $keyboard);
             }
             
         while($row_fiz_licam_sub = mysqli_fetch_assoc($result_fiz_licam2)) { 
                
           
               $SQL_fiz_licam_sub = "SELECT * FROM fiz_licam_sub WHERE menu_id = ". $row_fiz_licam_sub['id'];
               $result_sub_fiz_licam = mysqli_query($connection, $SQL_fiz_licam_sub);
              
             
               
                  
                if(mb_stripos($mtext, "📁 ".$row_fiz_licam_sub['title_ru']) !== false) {
              
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(submenuru_fiz($result_sub_fiz_licam), true, true); 
                    
                    $bot->sendMessage($message->getChat()->getId(),$row_fiz_licam_sub['text_ru'], HTML, null, null, $keyboard);
              
                }
                
                if(mb_stripos($mtext, "📁 ".$row_fiz_licam_sub['title_uz']) !== false) {
              
                    $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(submenuuz_fiz($result_sub_fiz_licam), true, true);            
                    $bot->sendMessage($message->getChat()->getId(),$row_fiz_licam_sub['text_uz'], HTML, null, null, $keyboard);
              
                }
                
                  while($result_sub_fiz_licam2 = mysqli_fetch_assoc($result_sub_fiz_licam)) { //   Общая инфони ичи
                       
                         $SQL_sub_fiz_licam2 = "SELECT * FROM fiz_licam_sub WHERE menu_id = ". $row_fiz_licam_sub['id'];
                         $result_sub_fiz_licam3 = mysqli_query($connection, $SQL_sub_fiz_licam2);
    
                         if($mtext == $result_sub_fiz_licam2['title_ru']) {

                          $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(submenuru_fiz($result_sub_fiz_licam3), true, true);
                           
                            if(!empty($result_sub_fiz_licam2['pic'])): 
                                $pic = $result_sub_fiz_licam2['pic'];
                                $title = $result_sub_fiz_licam2['title_ru'];
                                $bot->sendPhoto($message->getChat()->getId(), $pic, $title ,false,$keyboard); 
                            else:
                                $text = $result_sub_fiz_licam2['text_ru'];
                                $bot->sendMessage($message->getChat()->getId(), $text, false, null, null, $keyboard);
                            endif;
                           
                          
                         }
                         
                         if($mtext == $result_sub_fiz_licam2['title_uz'])  {

                          $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(submenuuz_fiz($result_sub_fiz_licam3), true, true);  
                           
                            if(!empty($result_sub_fiz_licam2['pic'])): 
                                $pic = $result_sub_fiz_licam2['pic'];
                                $title = $result_sub_fiz_licam2['title_uz'];
                                $bot->sendPhoto($message->getChat()->getId(), $pic, $title ,false,$keyboard); 
                            else:
                                $text = $result_sub_fiz_licam2['text_uz'];
                                $bot->sendMessage($message->getChat()->getId(), $text, false, null, null, $keyboard);
                            endif;
                          
                  
                         }
                    
                      }
                  
                    
              
            }
      
       
       
       
       //-------------------------- END "👤 Физическим лицам" -----------------------------//
      
      
      //-------------------------- "☎️ Контакты" -----------------------------//
     
      $SQL_kurs2 = "SELECT * FROM kurs WHERE id = 2";
      $result_kurs2 = mysqli_query($connection, $SQL_kurs2);
      
      while($row_kurs2 = mysqli_fetch_assoc($result_kurs2)) {
          
          if(mb_stripos($mtext,"☎️ Контакты") !== false) {
              
               $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
                [
                    [
                        ["text" => "🏛 О банке"],
                        ["text" => "🏫 Филиальная сеть"]
                    ],
    
                    [
                        ["text" => "📰 Новости"],
                        ["text" => "💵 Курс валют"]
                    ],
                    [
                        ["text" => "💼 Юридическим лицам"],
                        ["text" => "👤 Физическим лицам"]
                    ],
                    [
                        ["text" => "☎️ Контакты"],
    
                    ],
                    [
                        ["text" => "🔙 Назад"],
    
                    ],
                ], true, true);

        if(!empty($row_kurs2['pic'])): 
            $pic = $row_kurs2['pic'];
            $title = $row_kurs2['title_ru'];
            $bot->sendPhoto($message->getChat()->getId(), $pic, $title ,false,$keyboard); 
        else:
            $text = $row_kurs2['text_ru'];
            $bot->sendMessage($message->getChat()->getId(), $text, false, null, null, $keyboard);
        endif;
     
           }
      
           if (mb_stripos($mtext, "☎️ Biz bilan aloqa") !== false) {
    
            $keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup(
                [
                    [
                        ["text" => "🏛 Bank haqida"],
                        ["text" => "🏫 Bank filliallari"]
                    ],
    
                    [
                        ["text" => "📰 Yangiliklar"],
                        ["text" => "💵 Kurs"]
                    ],
                    [
                        ["text" => "💼 Yuridik shaxslarga"],
                        ["text" => "👤 Jismoniy shaxslarga"]
                    ],
                    [
                        ["text" => "☎️ Biz bilan aloqa"],
                    ],
                    [
                        ["text" => "🔙 Ortga"],
    
                    ],
                ], true, true);
                
           if(!empty($row_kurs2['pic'])): 
                $pic = $row_kurs2['pic'];
                $title = $row_kurs2['title_uz'];
                $bot->sendPhoto($message->getChat()->getId(), $pic, $title, false, $keyboard); 
            else:
                $text = $row_kurs2['text_uz'];
                $bot->sendMessage($message->getChat()->getId(), $text, false, null, null, $keyboard);
            endif;
    
          }
      
     
     
      }
      
      //-------------------------- END "💵 Курс валю" -----------------------------//
       
    
     } //end else  
    

}, function($message) use ($name){
    return true; // когда тут true - команда проходит
});

$bot->run();

echo "Uzsanoatqurilishbank";

