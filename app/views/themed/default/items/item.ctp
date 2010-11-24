<h2><?php echo $title; ?></h2>
<?php
echo "<div class=\"item clearfix\">\n";
echo "<div class=\"grid_8 alpha\">\n";

echo $this->Html->tag('h3', trim($data[0]['Item']['title']))."\n";
echo $this->Html->para(null, trim($data[0]['Item']['synopsis']));
echo "<table>\n";
foreach (Configure::read('Visual.fields_full') as $field) {
    if ($field == 'actors') {
        $a = actors(trim($data[0]['Item'][$field]));
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
        $g = preg_split("/[\s]*[,][\s]*/", trim($data[0]['Item'][$field]));
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
        $g = preg_split("/[\s]*[,][\s]*/", trim($data[0]['Item'][$field]));
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
            $this->Html->link(__('Link', true), trim($data[0]['Item'][$field]),
                    array('escape' => false, 'target' => '_blank')
                    )
            ))."\n";
    }
    else
        echo $this->Html->tableCells(array($field.':', trim($data[0]['Item'][$field])))."\n";
}
echo "</table>\n";
echo "</div>\n";

if (file_exists(WWW_ROOT.'/img/'.$data[0]['Item']['image']) && $data[0]['Item']['image'] != '') {
    echo "<div class=\"grid_4 omega\">\n".$this->Image->resize(trim($data[0]['Item']['image']), 300, 300, true, null, false)."</div>\n";
}

echo "</div>\n";
?>
