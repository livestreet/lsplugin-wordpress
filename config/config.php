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
Config::Set('router.page.contentany', 'PluginWordpress_ActionContent');

/**
 * Настройки блоков
 */
$config['block']['topic_popular']['count']   = 15;  // Число записей в блоке популярных топиков

$config['block']['blogs']['count']   = 10;  // Число блогов в блоке "категории"

$config['block']['tags']['count']   = 70;  // Число тегов в блоке "теги"

$config['block']['topic_last']['count']   = 10;  // Число записей в блоке последних топиков
$config['block']['topic_last']['time']   = 60*60*24*30*6;  // Время в течение которого топик считается новым

$config['block']['comment_last']['count']   = 10;  // Число записей в блоке последних комментариев

$config['block']['user_about']['id']   = 1;  // ID пользователя о котором нужно выводить информацию
$config['block']['user_about']['show_mail']   = true;  // показывать или нет емайл

$config['block']['content_any']['allow_php']   = false;  // разрешение на создание блока с PHP кодом

/**
 * Остальные настройки
 */
$config['archive']['per_page'] = 10;  // число топиков на страницу в архиве
$config['topic']['can_add'] = 'admin';  // кто может добавлять топики: admin - только администраторы, user - все пользователи


/**
 * Очищает все дефолтные блоки
 */
Config::Set('block', array());
/**
 * Определяем свои блоки
 */
Config::Set('block.wp_sidebar', array(
	'path' => '.+',
	'action' => array(),
	'blocks'  => array(
			'right' => array(
				'Meta'=>array('priority'=>83,'params'=>array('plugin'=>'wordpress')),
				'TopicPopular'=>array('priority'=>65,'params'=>array('plugin'=>'wordpress')),
				'TopicLast'=>array('priority'=>75,'params'=>array('plugin'=>'wordpress')),
				'Blogs'=>array('priority'=>85,'params'=>array('plugin'=>'wordpress')),
				'Tags'=>array('priority'=>80,'params'=>array('plugin'=>'wordpress')),
				'CommentLast'=>array('priority'=>-1,'params'=>array('plugin'=>'wordpress')),
				'UserAbout'=>array('priority'=>70,'params'=>array('plugin'=>'wordpress')),
				'Search'=>array('priority'=>100,'params'=>array('plugin'=>'wordpress')),
				'ContentAny'=>array('priority'=>1,'params'=>array('plugin'=>'wordpress','id'=>'test')),
				'Archive'=>array('priority'=>1,'params'=>array('plugin'=>'wordpress')),
				'Calendar'=>array('priority'=>90,'params'=>array('plugin'=>'wordpress')),				
			)
		),
	'clear' => true,
));

return $config;
?>