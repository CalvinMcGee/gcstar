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

        function index($category = null, $name = null) {
            
            switch ($category) {
                
                case 'actor':
                    $title = $name;
                    $data = $this->paginate('Item', array(
                        'Item.actors LIKE' => '%'.$name.'%'
                        ));
                    break;
                
                case 'director':
                    $title = $name;
                    $data = $this->paginate('Item', array(
                        'Item.director LIKE' => '%'.$name.'%'
                        ));
                    break;
                
                case 'genre':
                    $title = $name;
                    $data = $this->paginate('Item', array(
                        'Item.genre LIKE' => '%'.$name.'%'
                        ));
                    break;
                
                default:
                    $title = __('Index', true);
                    $data = $this->paginate('Item');
                    break;
            }

            $this->set(array(
                'data' => $data,
                'title_for_layout' => $title . ' : ' . Configure::read('Visual.title'),
                'tags' => $this->Item->find('all', array('fields' => 'Item.genre')),
                'title' => $title
                ));
        }
}
?>