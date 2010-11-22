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

/* Function for converting string 'Foo (bar), Bar1 (foo), Foo2 (bar 2),
 * Foo3 (bar (abc 123) 3)' to
 * array('Foo' => 'bar', 'Bar1' => 'foo','Foo2' => 'bar 2', 'Foo3' => 'bar (abc 123) 3')
 */
function actors($s) {

    $data = array();
    $count = 0;
    $tmp = "";

    for ($i = 0; $i < strlen($s); $i++)
    {
     if ($s[$i] == "(")
     {
       if ($count++ == 0)
       {
         $tmp = trim($tmp, ', ');
         $data[$tmp] = "";
         $ref = &$data[$tmp];
         $tmp = "";
       }
       else
         $tmp .= $s[$i];
     }
     else if ($s[$i] == ")")
     {
       if (--$count == 0)
       {
         $ref = $tmp;
         $tmp = "";
       }
       else
         $tmp .= $s[$i];
     }
     else
     {
       $tmp .= $s[$i];
     }
    }

    return $data;
}

    Configure::load('config');

    Configure::read('config');

    define('LIMIT', Configure::read('Visual.limit'));

    Configure::write('Config.language', Configure::read('Visual.language'));