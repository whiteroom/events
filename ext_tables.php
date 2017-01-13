<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'GeorgRinger.NewsEventRegistration',
            'Registration',
            'news_registration'
        );

    },
    $_EXTKEY
);
