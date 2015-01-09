<?php
namespace HcbBlogTag\Data;

use HcBackend\Data\AliasInterface;
use HcCore\Data\LocaleInterface;
use HcCore\Data\DataMessagesInterface;

interface LocalizedInterface extends LocaleInterface, AliasInterface, DataMessagesInterface
{
    /**
     * @return string
     */
    public function getTitle();
}
