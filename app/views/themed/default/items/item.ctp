<h2><?php echo $title; ?></h2>
<?php
echo "<div class=\"item clearfix\">\n";
echo "<div class=\"grid_6 alpha\">\n";

echo $this->Html->tag('h3', trim($data[0]['Item']['title']))."\n";
echo $this->Html->para(null, trim($data[0]['Item']['synopsis']));
echo "<table>\n";
foreach (Configure::read('Visual.fields_full') as $field) {
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
        echo $this->Html->tableCells(array(languageField($field).':', $content))."\n";
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
        echo $this->Html->tableCells(array(languageField($field).':', $content))."\n";
    }
    elseif ($field == 'webpage') {
        echo $this->Html->tableCells(array('',
            $this->Html->link(__('Link', true), trim($data[0]['Item'][$field]),
                    array('escape' => false, 'target' => '_blank')
                    )
            ))."\n";
    }
    else
        echo $this->Html->tableCells(array(languageField($field).':', trim($data[0]['Item'][$field])))."\n";
}
echo "</table>\n";
echo "</div>\n";

echo "<div class=\"grid_3 omega\">\n";

if (file_exists(WWW_ROOT.'/files/'.$data[0]['Item']['image']) && $data[0]['Item']['image'] != '')
    echo $this->Image->resize('webroot/files/'.trim($data[0]['Item']['image']), 300, 300, true, null, false);
else
    echo $this->Image->resize('views/themed/'.Configure::read('Visual.theme').'/webroot/img/nocover.gif', 300, 300, true, null, false);

echo "</div>\n";

echo "</div>\n";
?>
