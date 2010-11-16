<?php
foreach ($data as $post) {
    foreach ($post['Item'] as $field => $value) {
        echo $field.": ".$value."<br />\n";
    }
}

echo $paginator->numbers()."<br />\n";
echo $paginator->prev('<< '.__('Previous', true).' ');
echo $paginator->next(' '.__('Next', true).' >>')."<br />";
echo $paginator->counter(array('format' => __('Page %page% of %pages%', true)));
?>
