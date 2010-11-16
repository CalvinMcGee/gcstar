<?php
foreach ($data as $post) {
    echo "<div class=\"item\">\n";
    foreach ($post['Item'] as $field => $value) {
        if (file_exists(WWW_ROOT.'/img/'.$value) && $value != '') {
            echo $this->Image->resize($value, 150, 150, true, null, false)."<br />\n";
        }
        else
            echo $this->Text->autoLinkUrls($field.": ".$value."<br />\n", array(
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
