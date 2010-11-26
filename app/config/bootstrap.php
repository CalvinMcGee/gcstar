<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php
 *
 * This is an application wide file to load any function that is not used within a class
 * define. You can also use this to include or require any files in your application.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * App::build(array(
 *     'plugins' => array('/full/path/to/plugins/', '/next/full/path/to/plugins/'),
 *     'models' =>  array('/full/path/to/models/', '/next/full/path/to/models/'),
 *     'views' => array('/full/path/to/views/', '/next/full/path/to/views/'),
 *     'controllers' => array('/full/path/to/controllers/', '/next/full/path/to/controllers/'),
 *     'datasources' => array('/full/path/to/datasources/', '/next/full/path/to/datasources/'),
 *     'behaviors' => array('/full/path/to/behaviors/', '/next/full/path/to/behaviors/'),
 *     'components' => array('/full/path/to/components/', '/next/full/path/to/components/'),
 *     'helpers' => array('/full/path/to/helpers/', '/next/full/path/to/helpers/'),
 *     'vendors' => array('/full/path/to/vendors/', '/next/full/path/to/vendors/'),
 *     'shells' => array('/full/path/to/shells/', '/next/full/path/to/shells/'),
 *     'locales' => array('/full/path/to/locale/', '/next/full/path/to/locale/')
 * ));
 *
 */

/**
 * As of 1.3, additional rules for the inflector are added below
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */
/**
 * Stores configs in APP/config/name.php
 *
 * usage:
 *
 *	$settings = Configure::read('Settings');
 *	$settings['sitename'] = 'PizzaCake';
 *	storeConfig('Settings', $settings, true);
 *
 */

function languageCodes($_a) {
    $_b = array(
        'eng' => 'English',
        'swe' => 'Svenska'
    );
    return $_b[$_a];
}

function storeConfig($name, $data = array(), $reload = false) {

    $content = '';
    if (!empty($data)) {
        foreach ($data as $_step => $_array) {
            foreach ($_array as $_key => $_value)
                $content .= sprintf("\$config['%s']['%s'] = %s;\n", $_step, $_key, var_export($_value, true));
        }
    }

    $content = "<?php\n\n".$content;

    App::import('core', 'File');
    $name = strtolower($name);
    $file = new File(CONFIGS.$name.'.php');
    if ($file->open('w')) {
        $file->append($content);
    }
    $file->close();

    if ($reload) {
        Configure::load($name);
    }
}

function languageField($tag) {
    $_field = '';

    switch ($tag) {
        case 'webpage':
            $_field = __('Webpage', true);
            break;
        case 'date':
            $_field = __('Year', true);
            break;
        case 'genre':
            $_field = __('Genre', true);
            break;
        case 'ratingpress':
            $_field = __('Press rating', true);
            break;
        case 'country':
            $_field = __('Country', true);
            break;
        case 'time':
            $_field = __('Length', true);
            break;
        case 'original':
            $_field = __('Original title', true);
            break;
        case 'director':
            $_field = __('Director', true);
            break;
        case 'actors':
            $_field = __('Actors', true);
            break;
        case 'age':
            $_field = __('Age limit', true);
            break;
        case 'number':
            $_field = __('Number of media', true);
            break;
        case 'rating':
            $_field = __('Rating', true);
            break;
        case 'rank':
            $_field = __('Rank', true);
            break;
        case 'identifier':
            $_field = __('Identifier', true);
            break;
        case 'comment':
            $_field = __('Comment', true);
            break;
        case 'audio':
            $_field = __('Audio', true);
            break;
        case 'place':
            $_field = __('Place', true);
            break;
        case 'added':
            $_field = __('Added', true);
            break;
        case 'format':
            $_field = __('Media format', true);
            break;
        case 'region':
            $_field = __('Region', true);
            break;
        case 'serie':
            $_field = __('Serie', true);
            break;
        case 'subt':
            $_field = __('Subtitles', true);
            break;
        case 'subt':
            $_field = __('Subtitles', true);
            break;

        default:
            $_field = $tag;
            break;
    }
    return $_field;
}

    Configure::load('config');

    Configure::read('config');

    define('LIMIT', Configure::read('Visual.limit'));

    Configure::write('Config.language', Configure::read('Visual.language'));