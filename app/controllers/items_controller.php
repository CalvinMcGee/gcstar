<?php
/**
 * @property Items $Items
 */

class ItemsController extends AppController {

	var $name = 'Items';
//        $limit = Configure::read('Settings.limit');
        var $helpers = array('Text', 'Image');
        
        var $paginate = array(
        'limit' => 25,
        'order' => array(
            'Item.title' => 'asc'
            )
        );

        function index() {
            $title = __('Index', true);
            $data = $this->paginate('Item');
            $this->set(array(
                'data' => $data,
                'pageTitle' => $title . ' : ' . Configure::read('Settings.title'),
                'title' => $title
                ));
        }
}
?>