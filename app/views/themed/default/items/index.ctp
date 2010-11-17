<?php
foreach ($data as $post) {
    echo "<div class=\"item\">\n";
    foreach (Configure::read('fields') as $field) {
        if (file_exists(WWW_ROOT.'/img/'.$post['Item'][$field]) && $post['Item'][$field] != '') {
            echo $this->Image->resize($post['Item'][$field], 150, 150, true, null, false)."<br />\n";
        }
        else
            echo $this->Text->autoLinkUrls($field.": ".$post['Item'][$field]."<br />\n", array(
                'target' => '_blank'
            ));
    }
    echo "</div>\n";
}

echo $paginator->numbers()."<br />\n";
echo $paginator->prev('<< '.__('Previous', true).' ');
echo $paginator->next(' '.__('Next', true).' >>')."<br />";
echo $paginator->counter(array('format' => __('Page %page% of %pages%', true)));
?>
