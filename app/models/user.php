<?php
/**
 * @property User $User
 */
class User extends AppModel {
	var $name = 'User';
        var $useTable = false;

        var $validate = array(
            'limit' => array(
                'validateUserLimit' => array(
                    'required' => true,
                    'rule' => 'numeric'
                )
            ),
            'tagcloud_min_size' => array(
                'validateUserTagcloud_min_size' => array(
                    'required' => true,
                    'rule' => 'numeric'
                )
            ),
            'tagcloud_max_size' => array(
                'validateUserTagcloud_max_size' => array(
                    'required' => true,
                    'rule' => 'numeric'
                )
            ),
            'title' => array(
                'validateUserTitle' => array(
                    'required' => true
                )
            )
        );
}
?>