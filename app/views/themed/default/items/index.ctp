<?php
foreach ($data as $post) {
    echo "<div class=\"item clearfix\">\n";

    if (file_exists(WWW_ROOT.'/img/'.$post['Item']['image']) && $post['Item']['image'] != '') {
        echo "<div class=\"grid_3 alpha\">\n".$this->Image->resize($post['Item']['image'], 220, 220, true, null, false)."</div>\n";
    }
    echo "<div class=\"grid_9 omega\">\n<table>\n";
    echo $this->Html->tableCells(array(array(array($this->Html->tag('h3', $post['Item']['title']), "colspan=\"2\""))))."\n";
    
    foreach (Configure::read('fields_list') as $field) {
        if ($field == 'actors') {
            $a = actors($post['Item'][$field]);
            $i = 0;
            $content = '';
            foreach ($a as $actor => $role) {
                $content .= $this->Html->link($actor, '/', array('escape' => false));
                if ($i < (sizeof($a) - 1))
                    $content .= ", \n";
                $i++;
            }
            echo $this->Html->tableCells(array(__('Actors:', true), $content))."\n";
        }
        elseif ($field == 'genre') {
            $g = preg_split("/[\s]*[,][\s]*/", $post['Item'][$field]);
            $i = 0;
            $content = '';
            foreach ($g as $genre) {
                $content .= $this->Html->link($genre, '/');
                if ($i < (sizeof($g) - 1))
                    $content .= ", \n";
                $i++;
            }
            echo $this->Html->tableCells(array(__('Genre:', true), $content))."\n";
        }
        else
            echo $this->Html->tableCells(array($field.':', $post['Item'][$field]))."\n";
    }
    echo "</table>\n</div>\n";
    echo "</div>\n";
}

echo $paginator->numbers()."<br />\n";
echo $paginator->prev('<< '.__('Previous', true).' ');
echo $paginator->next(' '.__('Next', true).' >>')."<br />";
echo $paginator->counter(array('format' => __('Page %page% of %pages%', true)));
?>
