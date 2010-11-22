<?php
/**
 * @property Setting $Setting
 */
class Setting extends AppModel {
	var $name = 'Setting';
        var $useTable = false;

        var $validate = array(
            'limit' => array(
                'validateSettingLimit' => array(
                    'required' => true,
                    'rule' => 'numeric'
                )
            ),
            'tagcloud_min_size' => array(
                'validateSettingTagcloud_min_size' => array(
                    'required' => true,
                    'rule' => 'numeric'
                )
            ),
            'tagcloud_max_size' => array(
                'validateSettingTagcloud_max_size' => array(
                    'required' => true,
                    'rule' => 'numeric'
                )
            ),
            'title' => array(
                'validateSettingTitle' => array(
                    'required' => true,
                    'rule' => 'notEmpty'
                )
            )
        );
}
?>