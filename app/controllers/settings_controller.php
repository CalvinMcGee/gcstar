<?php
/**
 * @property Settings $Settings
 */

class SettingsController extends AppController {

	var $name = 'Settings';

        function admin() {
            $this->Setting->find('list');

            $this->set(array('languages' => $content[0]));
        }

        function visual() {
            $title = 'Visual settings';

            require CONFIGS.'config.php';

            $folder = new Folder(APP.'locale');
            $content = $folder->read();
            unset($folder);
            $this->Setting->set($config);

            $this->set(array('data' => $config, 'languages' => $content[0],
                'title_for_layout' => $title . ' : ' . Configure::read('Visual.title'),
                'title' => $title
                ));

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
        }
}
?>