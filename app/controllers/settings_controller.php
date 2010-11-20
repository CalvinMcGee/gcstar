<?php
/**
 * @property Settings $Settings
 */

class SettingsController extends AppController {

	var $name = 'Settings';

        function beforeFilter() {
        $this->view = 'Theme';
        $this->theme = 'default';
        }

        function admin() {
            $this->Setting->find('list');

            $folder = new Folder(APP.'locale');
            $content = $folder->read();
            unset($folder);

            $this->set(array('languages' => $content[0]));
        }

        function visual() {
            require CONFIGS.'config.php';

            $this->set(array('data' => $config, 'languages' => languageCodes()));
        }
}
?>