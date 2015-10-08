<?php
		include_once($_SERVER['DOCUMENT_ROOT'].'/config/smarty_init.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/model/model.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/menu/mainmenu.php');
		
		/**
			*Определение переменных Smarty для хранения переменных сессии
			*/
		if (isset($_SESSION['isLogin']) && isset($_SESSION['username'])){
			$smarty->assign('login', $_SESSION['isLogin']);
			$smarty->assign('username', $_SESSION['username']);
		}
		
		/**
			*Определение переменной Smarty для хранения массива с меню
			*/
		$smarty->assign('mainmenu', $mainmenu);
		
		/**
			*Вызов функции, которая возвращает отзывы
			*Определение переменной Smarty для массива с отзывами
			*/
		$allFeeds = getFeedbacks($link);
		$smarty->assign('feed', $allFeeds);
		
		/* Вызов функции парсинга погоды. Возвращает ассоциативный массив */
		$result = deadWeather();
		
		/**
			*Определение переменных Smarty для вывода вседений о погоде
			*/
		$smarty->assign('today_date', $result['today_date']);
		$smarty->assign('tomorrow_date', $result['tomorrow_date']);
		$smarty->assign('after_tomorrow_date', $result['after_tomorrow_date']);
		
		$smarty->assign('arr_today', $result['today_part']);
		$smarty->assign('arr_tomorrow', $result['tomorrow_part']);
		$smarty->assign('arr_after_tomorrow', $result['after_tomorrow_part']);
		
		/* Год для футтера*/
		$smarty->assign('year', date('Y'));
		
		/* Заголовки страниц */
		$smarty->assign('title', getTitle()); 
?>