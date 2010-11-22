<?php
echo $this->element('tagcloud', array('data' => $tags));
foreach ($data as $post) {
    echo "<div class=\"item clearfix\">\n";

    if (file_exists(WWW_ROOT.'/img/'.$post['Item']['image']) && $post['Item']['image'] != '') {
        echo "<div class=\"grid_3 alpha\">\n".$this->Image->resize(trim($post['Item']['image']), 220, 220, true, null, false)."</div>\n";
    }
    echo "<div class=\"grid_9 omega\">\n<table>\n";
    echo $this->Html->tableCells(array(array(array($this->Html->tag('h3', trim($post['Item']['title'])), "colspan=\"2\""))))."\n";

    foreach (Configure::read('Visual.fields_list') as $field) {
        if ($field == 'actors') {
            $a = actors(trim($post['Item'][$field]));
            $i = 0;
            $content = '';
            foreach ($a as $actor => $role) {
                $content .= $this->Html->link($actor,
                        array('controller' => 'items', 'action' => 'index', 'actor', $actor),
                        array('escape' => false));
                if ($i < (sizeof($a) - 1))
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
        else
            echo $this->Html->tableCells(array($field.':', trim($post['Item'][$field])))."\n";
    }
    echo "</table>\n</div>\n";
    echo "</div>\n";
}

echo $paginator->numbers()."<br />\n";
echo $paginator->prev('<< '.__('Previous', true).' ');
echo $paginator->next(' '.__('Next', true).' >>')."<br />";
echo $paginator->counter(array('format' => __('Page %page% of %pages%', true)));
?>
