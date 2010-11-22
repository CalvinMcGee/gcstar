<?php
/**
 * @property Settings $Settings
 */

class SettingsController extends AppController {

	var $name = 'Settings';

        function visual() {

            if (!empty($this->data)){
                $this->Setting->set($this->data);

                if ($this->Setting->validates()){
                    foreach ($this->data as $model) {
                        foreach ($model as $key => $value) {
                            $config['Visual'][$key] = $value;
                        }
                    }

                    storeConfig('config', $config);
                }
            }
            
            $title = 'Visual settings';

            require CONFIGS.'config.php';

            $_configs_folder = new Folder(APP.'locale');
            $_config_content = $_configs_folder->read();
            unset($_configs_folder);

            $_theme_folder = new Folder(APP.'views/themed');
            $__theme_content = $_theme_folder->read();
            unset($_configs_folder);
            $_theme_content = array();
            foreach ($__theme_content[0] as $_a)
                $_theme_content[$_a] = $_a;

            $this->Setting->set($config);

            $this->set(array('data' => $config, 'languages' => $_config_content[0],
                'themes' => $_theme_content,
                'title_for_layout' => $title . ' : ' . Configure::read('Visual.title'),
                'title' => $title
                ));
        }
}
?>