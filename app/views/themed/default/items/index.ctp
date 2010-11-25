<h2><?php echo $title; ?></h2>
<?php
echo $this->Html->div('tagcloud', $this->element('tagcloud', array('data' => $tags, 'escape' => true)))."\n";

echo $this->Html->div('paginationlinks', $paginator->numbers()."<br />\n".
        $paginator->prev('<< '.__('Previous', true).' ')."\n".
        $paginator->next(' '.__('Next', true).' >>')."<br />\n".
        $paginator->counter(array('format' => '<span>'.__('Page %page% of %pages%', true).'</span>'))."\n"
        )."\n";

foreach ($data as $post) {
    echo "<div class=\"item clearfix\">\n";

    echo "<div class=\"grid_3 omega\">\n";

if (file_exists(WWW_ROOT.'/files/'.$post['Item']['image']) && $post['Item']['image'] != '')
    echo $this->Image->resize('webroot/files/'.trim($post['Item']['image']), 220, 220, true, null, false);
else
    echo $this->Image->resize('views/themed/'.Configure::read('Visual.theme').'/webroot/img/nocover.gif', 220, 220, true, null, false);

    echo "</div>\n";

    echo "<div class=\"grid_9 omega\">\n";
    echo $this->Html->link($this->Html->tag('h3', trim($post['Item']['title']), array('escape' => false)),
            array('controller' => 'items', 'action' => 'item', trim($post['Item']['title'])),
            array('escape' => false)
            )."\n";
    echo "<table>\n";
    foreach (Configure::read('Visual.fields_list') as $field) {
        if ($field == 'actors') {
            $g = preg_split("/[\s]*[,][\s]*/", trim($data[0]['Item'][$field]));
            $i = 0;
            $content = '';
            foreach ($g as $actor) {
                $content .= $this->Html->link($actor, array(
                    'controller' => 'items', 'action' => 'index', 'actor', $actor
                    ),
                    array('escape' => false));
                if ($i < (sizeof($g) - 1))
                    $content .= ", \n";
                $i++;
            }
            echo $this->Html->tableCells(array(__('Actors:', true), $content))."\n";
        }
        elseif ($field == 'genre') {
            $g = preg_split("/[\s]*[,][\s]*/", trim($post['Item'][$field]));
            $i = 0;
            $content = '';
            foreach ($g as $genre) {
                $content .= $this->Html->link($genre, array(
                    'controller' => 'items', 'action' => 'index', 'genre', $genre
                    ),
                    array('escape' => false));
                if ($i < (sizeof($g) - 1))
                    $content .= ", \n";
                $i++;
            }
            echo $this->Html->tableCells(array(__('Genre:', true), $content))."\n";
        }
        elseif ($field == 'director') {
            $g = preg_split("/[\s]*[,][\s]*/", trim($post['Item'][$field]));
            $i = 0;
            $content = '';
            foreach ($g as $director) {
                $content .= $this->Html->link($director, array(
                    'controller' => 'items', 'action' => 'index', 'director', $director
                    ),
                    array('escape' => false));
                if ($i < (sizeof($g) - 1))
                    $content .= ", \n";
                $i++;
            }
            echo $this->Html->tableCells(array(__('Director:', true), $content))."\n";
        }
        elseif ($field == 'webpage') {
            echo $this->Html->tableCells(array('',
                $this->Html->link(__('Link', true), trim($post['Item'][$field]),
                        array('escape' => false, 'target' => '_blank')
                        )
                ))."\n";
        }
        else
            echo $this->Html->tableCells(array($field.':', trim($post['Item'][$field])))."\n";
    }
    echo "</table>\n</div>\n";
    echo "</div>\n";
}

echo $this->Html->div('paginationlinks', $paginator->numbers()."<br />\n".
        $paginator->prev('<< '.__('Previous', true).' ')."\n".
        $paginator->next(' '.__('Next', true).' >>')."<br />\n".
        $paginator->counter(array('format' => '<span>'.__('Page %page% of %pages%', true).'</span>'))."\n"
        )."\n";
?>
