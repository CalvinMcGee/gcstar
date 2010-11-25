<?php
/**
 * @property Settings $Settings
 */

class SettingsController extends AppController {

	var $name = 'Settings';
        var $components = array('Security', 'Session', 'Cookie');
        var $helpers = array('Time');

        function beforeFilter() {
            $this->view = 'Theme';
            $this->theme = Configure::read('Visual.theme');
            
            $this->Security->loginOptions = array(
                'type' => 'basic',
                'realm' => 'Myrealm'
            );
            $this->Security->loginUsers = array(
                Configure::read('User.username') => Configure::read('User.password')
            );
            $this->Security->requireLogin();
        }
        
        function index() {

            if (!empty($this->data)){
                $this->Setting->set($this->data);

                if ($this->Setting->validates(array('fieldList' => array(
                    'title', 'theme', 'language', 'limit', 'tagcloud_min_size',
                    'tagcloud_max_size')))){
                    require CONFIGS.'config.php';
                    foreach ($this->data['Setting'] as $key => $value) {
                        $config['Visual'][$key] = $value;
                    }

                    storeConfig('config', $config);
                    $this->Session->setFlash(__('Configuration saved', true));
                }
                else
                    $this->Session->setFlash(__('Could not save configuration', true));
            }
            
            $title = 'Visual settings';

            $_configs_folder = new Folder(APP.'locale');
            $_config_content = $_configs_folder->read();
            unset($_configs_folder);

            $_theme_folder = new Folder(APP.'views/themed');
            $__theme_content = $_theme_folder->read();
            unset($_configs_folder);
            $_theme_content = array();
            foreach ($__theme_content[0] as $_a)
                $_theme_content[$_a] = $_a;

            include CONFIGS.'config.php';

            $this->Setting->set($config);

            $this->set(array('data' => $config, 'languages' => $_config_content[0],
                'themes' => $_theme_content,
                'title_for_layout' => $title . ' : ' . Configure::read('Visual.title'),
                'title' => $title
                ));
        }

        function admin() {

            include CONFIGS.'config.php';

            $this->Setting->set($config);
            debug($config);
            $title = 'User profile';
            $this->set(array('data' => $config,
                'title_for_layout' => $title . ' : ' . Configure::read('Visual.title'),
                'title' => $title
                ));
        }

        function xml() {
            App::import(array('Xml'));
            $_xml = new Xml(WWW_ROOT.'files'.DS.Configure::read('Setting.source_file'));
            $__xml = Set::reverse($_xml);

            $_data['Item'] = array();

            foreach ($__xml['Collection']['Item'] as $_post) {
                $_a = array();

                foreach ($_post as $key => $value) {

                    switch ($key) {

                        case 'Actors':
                            $_actors = '';

                            if (!empty($_post[$key]['Line'])) {
                                $_i = 0;
                                $_len = count($_post[$key]['Line']);

                                foreach ($_post[$key]['Line'] as $_actor) {

                                    if (!empty($_actor['Col'][0])){
                                        $_actors .= $_actor['Col'][0];
                                        if ($_i < ($_len - 1))
                                            $_actors .= ', ';
                                        }
                                        $_i++;
                                }
                            }

                            $_a[strtolower($key)] = $_actors;
                            break;

                        case 'comment':
                            $_comments = '';

                            if (!empty($_post[$key]['Line'])) {

                                if (!empty($_post[$key]['Line'][0])) {
                                    $_i = 0;
                                    $_len = count($_post[$key]['Line']);

                                    foreach ($_post[$key]['Line'] as $_comment) {

                                        if (!empty($_comment['col'])) {
                                            $_genres .= $_comment['col'];
                                            if ($_i < ($_len - 1))
                                                $_comments .= ', ';
                                        }
                                        $_i++;

                                    }
                                }
                                else
                                    $_genres .= $_post[$key]['Line']['col'];
                            }

                            $_a[strtolower($key)] = $_comments;
                            
                        case 'Genre':
                            $_genres = '';

                            if (!empty($_post[$key]['Line'])) {

                                if (!empty($_post[$key]['Line'][0])) {
                                    $_i = 0;
                                    $_len = count($_post[$key]['Line']);

                                    foreach ($_post[$key]['Line'] as $_genre) {

                                        if (!empty($_genre['col'])) {
                                            $_genres .= $_genre['col'];
                                            if ($_i < ($_len - 1))
                                                $_genres .= ', ';
                                        }
                                        $_i++;

                                    }
                                }
                                else
                                    $_genres .= $_post[$key]['Line']['col'];
                            }

                            $_a[strtolower($key)] = $_genres;
                            break;

                        case 'added' :
                            if (!empty($value))
                                $_a[strtolower($key)] = date( 'y-m-d', strtotime( trim($value) ));
                            else
                                $_a[strtolower($key)] = $value;
                            break;
                            
                        default :
                            if (!empty($value))
                                $_a[strtolower($key)] = trim($value);
                            else
                                $_a[strtolower($key)] = $value;
                            break;
                        
                    }
                    
                }
                $_a['slug'] = Inflector::slug(strtolower($_a['title']));
                $_data['Item'][] = $_a;
            }
            $this->loadModel('Item');
            $this->Item->query('DELETE FROM items WHERE 1=1');
            $this->Item->saveAll($_data['Item']);

            $this->Session->setFlash(__('Database has been updated', true));
            $this->redirect(array('action' => 'index'));
        }
}
?>