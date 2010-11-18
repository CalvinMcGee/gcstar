<?php
/**
 * @property Items $Items
 */

class ItemsController extends AppController {

	var $name = 'Items';
        var $helpers = array('Text', 'Image');
        
        var $paginate = array(
        'limit' => LIMIT,
        'order' => array(
            'Item.title' => 'asc'
            )
        );

        function index() {
            $title = __('Index', true);
            $data = $this->paginate('Item');
            $this->set(array(
                'data' => $data,
                'pageTitle' => $title . ' : ' . Configure::read('title'),
                'tags' => $this->Item->find('all', array('fields' => 'Item.genre')),
                'title' => $title
                ));
        }
}
?>