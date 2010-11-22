<?php
/**
 * @property Settings $Settings
 */

class SettingsController extends AppController {

	var $name = 'Settings';
        var $components = array('Security', 'Session', 'Cookie');

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

        function visual() {

            if (!empty($this->data)){
                $this->Setting->set($this->data);

                if ($this->Setting->validates()){
                    require CONFIGS.'config.php';
                    foreach ($this->data as $model) {
                        foreach ($model as $key => $value) {
                            $config['Visual'][$key] = $value;
                        }
                    }

                    storeConfig('config', $config);
                }
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
}
?>