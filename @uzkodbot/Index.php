<?php
/**
 *  By Nazirov LIX
 *
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


// Команды бота
// пинг. Тестовая
$bot->command('ping', function ($message) use ($bot) {
	$bot->sendMessage($message->getChat()->getId(), 'pong!');
});

// обязательное. Запуск бота
$bot->command('start', function ($message) use ($bot) {
		
		$name = $message->getChat()->getFirstname();
		$answer = "Добро пажаловать <b>".$name."</b>";
		$answer2 = "Введите префикс:
<i>(начальные 3 цифры телефон номера)</i>";
	    $bot->sendMessage($message->getChat()->getId(), $answer, HTML);
	    $bot->sendMessage($message->getChat()->getId(), $answer2, HTML);
	 
});

$bot->on(function($Update) use ($bot){

	$message = $Update->getMessage();
	$mtext = $message->getText();
	$cid = $message->getChat()->getId();

	include('includes/database.php');
	$SQL = "SELECT * From kod";
	$result = mysqli_query($connection,$SQL);

	$str = strlen($mtext);
		
	if($str == 3) 
		{

		$i = 1;
		while(($row = mysqli_fetch_assoc($result)))	  {
			
			$prefiks = $row['nomer'];
			$operator = $row['operator'];
			$kod = $row['kod'];
			$region = $row['region'];

			if(mb_stripos($mtext,$prefiks) !== false){
			
				// ответь к user
				
				switch ($operator) {
					case 'UMS':
						$answer_ums = $i.') +998 <b>'.$kod.'</b>-'.$prefiks.'-XXXX
						❤ UMS <i>('.$region.')</i>';
						$bot->sendMessage($message->getChat()->getId(), $answer_ums, HTML); 
						break;
					case 'Beeline':
						$answer_beeline = $i.') +998 <b>'.$kod.'</b>-'.$prefiks.'-XXXX
						💛 Beeline <i>('.$region.')</i>';
						$bot->sendMessage($message->getChat()->getId(), $answer_beeline, HTML);
						break;
					case 'Ucell':
						$answer_beeline = $i.') +998 <b>'.$kod.'</b>-'.$prefiks.'-XXXX
						💜 Ucell <i>('.$region.')</i>';
						$bot->sendMessage($message->getChat()->getId(), $answer_beeline, HTML);
						break;
					case 'UzMobile':
						$answer_beeline = $i.') +998 <b>'.$kod.'</b>-'.$prefiks.'-XXXX
						💙 UzMobile <i>('.$region.')</i>';
						$bot->sendMessage($message->getChat()->getId(), $answer_beeline, HTML);
						break;
					case 'PerfectumMobile':
						$answer_beeline = $i.') +998 <b>'.$kod.'</b>-'.$prefiks.'-XXXX
						💚 PerfectumMobile <i>('.$region.')</i>';
						$bot->sendMessage($message->getChat()->getId(), $answer_beeline, HTML);
						break;
				}   // завершаем switch
					
				$i++;
			}  // завершаем if (mb_stripos($mtext,$prefiks) !== false)
	    } // завершаем while
	}// завершаем if ($str == 3)

	else       // Если user ввел больше 3 цифр
		{
			$answer_str = 'Введите только 3 цифры мобильного номера:';
			$bot->sendMessage($message->getChat()->getId(), $answer_str);
		}

}, function($message) use ($name){
	return true; // когда тут true - команда проходит
});

// запускаем обработку
$bot->run();

echo "Ура, бот работает";