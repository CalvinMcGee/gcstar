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
            $this->Setting->find('first', array(
                'fields' => array('id', 'fields_list', 'language', 'limit', 'tagcloud_min_size', 'tagcloud_max_size', 'title', 'theme')
            ));

            $folder = new Folder(APP.'locale');
            $content = $folder->read();
            unset($folder);

            $this->set(array('languages' => $content[0]));
        }
}
?>