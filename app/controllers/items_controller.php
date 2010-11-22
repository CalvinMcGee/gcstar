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

                case 'country':
                    $title = $name;
                    $data = $this->paginate('Item', array(
                        'Item.country LIKE' => '%'.$name.'%'
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

                case 'date':
                    $title = $name;
                    $data = $this->paginate('Item', array(
                        'Item.date LIKE' => '%'.$name.'%'
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

        function cloud($category = null, $name = null) {
            $title = 'Cloud';
            $this->set(array(
                'title_for_layout' => $title . ' : ' . Configure::read('Visual.title'),
                'actors' => $this->Item->find('all', array('fields' => 'Item.actors')),
                'countries' => $this->Item->find('all', array('fields' => 'Item.country')),
                'directors' => $this->Item->find('all', array('fields' => 'Item.director')),
                'genres' => $this->Item->find('all', array('fields' => 'Item.genre')),
                'title' => $title,
                'years' => $this->Item->find('all', array('fields' => 'Item.date'))
                ));
        }

        function item ($name = null) {
            $title = $name;
            $data = $this->paginate('Item', array(
                'Item.title LIKE' => '%'.$name.'%'
                ));

            $this->set(array(
                'data' => $data,
                'title_for_layout' => $title . ' : ' . Configure::read('Visual.title'),
                'title' => $title
                ));
        }
}
?>