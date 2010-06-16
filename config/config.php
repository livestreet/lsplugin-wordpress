<?php
/*-------------------------------------------------------
*
*   LiveStreet Engine Social Networking
*   Copyright © 2008 Mzhelskiy Maxim
*
*--------------------------------------------------------
*
*   Official site: www.livestreet.ru
*   Contact e-mail: rus.engine@gmail.com
*
*   GNU General Public License, version 2:
*   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*
---------------------------------------------------------
*/

/**
 * Таблицы БД
 */
$config['table']['content'] = '___db.table.prefix___wp_content';
$config['table']['topic'] = '___db.table.prefix___wp_topic';
/**
 * Роутинг
 */
Config::Set('router.page.archive', 'PluginWordpress_ActionArchive');

/**
 * Настройки блоков
 */
$config['block']['topic_popular']['count']   = 15;  // Число записей в блоке популярных топиков
$config['block']['topic_popular']['time']   = 60*60*24*30;  // Время за которое берутся популярные записи

$config['block']['blogs']['count']   = 10;  // Число блогов в блоке "категории"

$config['block']['tags']['count']   = 70;  // Число тегов в блоке "теги"

$config['block']['topic_last']['count']   = 10;  // Число записей в блоке последних топиков
$config['block']['topic_last']['time']   = 60*60*24*30*6;  // Время в течение которого топик считается новым

$config['block']['comment_last']['count']   = 10;  // Число записей в блоке последних комментариев

$config['block']['user_about']['id']   = 1;  // ID пользователя о котором нужно выводить информацию
$config['block']['user_about']['show_mail']   = true;  // показывать или нет емайл


$config['archive']['per_page']   = 10;  // число топиков на страницу в архиве


/**
 * Очищает все дефолтные блоки
 */
Config::Set('block', array());


return $config;
?>