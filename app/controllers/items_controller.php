<?php
/**
 * @property Items $Items
 */

class ItemsController extends AppController {

	var $name = 'Items';
//        $limit = Configure::read('Settings.limit');
        
        var $paginate = array(
        'limit' => 25,
        'order' => array(
            'Item.title' => 'asc'
            )
        );

        function index() {
            $data = $this->paginate('Item');
            $this->set('data', $data);
        }
}
?>