<?php
$_tags = array();
foreach ($data as $post) {
    foreach ($post as $model) {
        foreach ($model as $key => $value){
            /**
             * Tags are comma separated.
             */
            $__tags = preg_split("/[\s]*[,][\s]*/", $value);
            foreach ($__tags as $tag) {
                if (array_key_exists($tag, $_tags)) $_tags[$tag]++;
                else $_tags[$tag] = 1;
            }
        }
    }
}

ksort($_tags);

/**
 *                   / t  _ t    \ . /size    _ size   \
 *                   \  i    min /   \    max       min/
 * s  =  size     +  -----------------------------------
 *  i        min              t    _ t
 *                             max    min
 * s_i = fontsize
 * size_min = min fontsize
 * size_max = max fontsize
 * t_i = count
 * t_min = min count
 * t_max = max count
 */

$min_size = Configure::read('tagcloud_min_size');
$max_size = Configure::read('tagcloud_max_size');;
$t_min = min(array_values($_tags));
$t_max = max(array_values($_tags));

$tagcloud = array();

foreach ($_tags as $tag => $t_i) {
    if ($t_i > $t_min)
        $tagcloud[$tag] = round($min_size + (($t_i - $t_min)*(($max_size - $min_size)/($t_max - $t_min))), 0);
    else
        $tagcloud[$tag] = $min_size;
}

foreach ($tagcloud as $_tag => $s_i) {
    echo $this->Html->link($_tag,
            array('controller' => 'items', 'action' => 'genre', $_tag),
            array(
                'style' => 'font-size: '.$s_i.'%;')
            )."\n";
}
?>