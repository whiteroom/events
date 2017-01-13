<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'GeorgRinger.NewsEventRegistration',
            'Registration',
            [
                'News' => 'new, create, success'
            ],
            // non-cacheable actions
            [
                'News' => 'create, '
            ]
        );

    },
    $_EXTKEY
);
