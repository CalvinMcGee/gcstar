<?php
$this->set('documentData', array(
    'xmlns:dc' => 'http://purl.org/dc/elements/1.1/'));

$this->set('channelData', array(
    'title' => __("Most Recent Items", true),
    'link' => $this->Html->url('/', true),
    'description' => __('Most recent items.', true),
    'language' => 'en-us'));

foreach ($data as $post) {
    $postTime = strtotime($post['Item']['added']);

    $postLink = array(
        'controller' => 'items',
        'action' => 'item',
        $post['Item']['slug']);

    App::import('Sanitize');
    // This is the part where we clean the body text for output as the description
    // of the rss item, this needs to have only text to make sure the feed validates
    $bodyText = preg_replace('=\(.*?\)=is', '', $post['Item']['synopsis']);
    $bodyText = $text->stripLinks($bodyText);
    $bodyText = Sanitize::stripAll($bodyText);
    $bodyText = $text->truncate($bodyText, 400);

    App::import('Image');

    if (file_exists(WWW_ROOT.'/files/'.$post['Item']['image']) && $post['Item']['image'] != '')
        $imageTag = $image->resize('webroot/files/'.$post['Item']['image'], 120, 120, true, null, false);
    else
        $imageTag = $image->resize('views/themed/'.Configure::read('Visual.theme').'/webroot/img/nocover.gif', 120, 120, true, null, false);

    $descriptionText = '';

    foreach (Configure::read('Visual.fields_list') as $tag) {
        if (trim($post['Item'][$tag])!='') {
            $descriptionText .= languageField($field).': '.$post['Item'][$field]."<br />\n";
        }
    }

    $description = $imageTag."<br /><br />\n".$descriptionText."<br />\n".$bodyText;

    echo $this->Rss->item(array(), array(
        'title' => $post['Item']['title'],
        'link' => $postLink,
        'guid' => array('url' => $postLink, 'isPermaLink' => 'true'),
        'description' =>  $description,
        'dc:creator' => Configure::read('Visual.title'),
        'pubDate' => $postTime))."\n";
}
?>
