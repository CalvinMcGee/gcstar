<?php
foreach ($data as $post) {
    foreach ($post['Item'] as $field => $value) {
        if (file_exists(WWW_ROOT.'/img/'.$value) && $value != '') {
            echo $this->Image->resize($value, 150, 150);
        }
        else
            echo $field.": ".$value."<br />\n";
    }
}

echo $paginator->numbers()."<br />\n";
echo $paginator->prev('<< '.__('Previous', true).' ');
echo $paginator->next(' '.__('Next', true).' >>')."<br />";
echo $paginator->counter(array('format' => __('Page %page% of %pages%', true)));
?>
