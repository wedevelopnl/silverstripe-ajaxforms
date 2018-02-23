<?php

namespace TheWebmen\Ajaxforms;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\View\ViewableData;

/**
 * Class AjaxFormResponse
 * @package TheWebmen\Ajaxforms
 */
class AjaxFormResponse extends ViewableData
{

    /**
     * Redirect to a url
     * @param $url
     * @return string
     */
    public function redirectToURL($url)
    {
        return json_encode(array(
            'success' => true,
            'action' => 'redirect',
            'url' => $url
        ));
    }

    /**
     * Redirect to a page
     * @param $pageID
     * @return string
     */
    public function redirectToPage($pageID){
        $page = SiteTree::get()->byID($pageID);
        return $this->redirectToURL($page->Link());
    }

    /**
     * Show a message and optional clear the form
     * @param $message
     * @param bool $emptyForm
     * @param bool $prependMessage
     * @return string
     */
    public function message($message, $clearform = true, $prependMessage = true){
        return json_encode(array(
            'success' => true,
            'action' => 'message',
            'clearform' => $clearform,
            'prependMessage' => $prependMessage,
            'message' => $message
        ));
    }

}



