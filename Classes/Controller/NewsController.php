<?php
namespace GeorgRinger\NewsEventRegistration\Controller;

/***
 *
 * This file is part of the "News Event Registration" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2016 Georg Ringer, ringer.it
 *
 ***/

use DateTime;
use GeorgRinger\News\Domain\Model\FileReference;
use GeorgRinger\News\Domain\Model\News;
use GeorgRinger\NewsEventRegistration\Domain\Model\Dto\Event;
use GeorgRinger\NewsEventRegistration\Service\MailService;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * NewsController
 */
class NewsController extends ActionController
{

    /**
     * @var \GeorgRinger\News\Domain\Repository\NewsRepository
     */
    protected $newsRepository;

    /**
     * @var MailService
     */
    protected $mailService;

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
        $event = $this->objectManager->get(Event::class);
        $this->view->assignMultiple([
            'event' => $event
        ]);
    }

    /**
     * action create
     *
     * @param \GeorgRinger\NewsEventRegistration\Domain\Model\Dto\Event $event
     */
    public function createAction(\GeorgRinger\NewsEventRegistration\Domain\Model\Dto\Event $event = null)
    {
        if (is_null($event)) {
            $this->redirect('new');
        }
        $persistenceManager = $this->objectManager->get(PersistenceManager::class);
        $newObject = $this->createNewsObject($event);
//        $newObject = $this->newsRepository->findByUid(1561, false);
        $this->newsRepository->add($newObject);
        $persistenceManager->persistAll();

        $mediaAdded = $this->addMediaToNews($newObject);
        if ($mediaAdded) {
            $this->newsRepository->update($newObject);
            $persistenceManager->persistAll();
        }

        $this->sendMailToAdmin($newObject);
        $this->sendMailToUser($newObject);

        $this->redirect('success');
    }


    protected function sendMailToUser(News $news)
    {
        $frontendUser = $this->getFrontendUserData();
        $settings = $this->settings['mailToUser'];
        $emailAddress = $frontendUser['email'];
        if ($settings['enable'] == 1 && GeneralUtility::validEmail($emailAddress)) {
            $arguments = [
                'language' => $this->getTsfe()->sys_language_uid,
                'news' => $news
            ];
            $plainContent = $this->mailService->getFluidTemplate($arguments, 'MailToUser.txt');
            $mailMessage = GeneralUtility::makeInstance(MailMessage::class);
            $mailMessage
                ->setSubject($this->translate($settings['subject']))
                ->addFrom($settings['fromMailAddress'], $settings['fromMailName'])
                ->setTo($emailAddress);
            $this->mailService->sendMail($mailMessage, $plainContent);
        }
    }

    protected function sendMailToAdmin(News $news)
    {
        $settings = $this->settings['mailToAdmin'];
        $emailAddress = $settings['to'];
        if ($settings['enable'] == 1 && GeneralUtility::validEmail($emailAddress)) {
            $arguments = [
                'language' => $this->getTsfe()->sys_language_uid,
                'news' => $news
            ];
            $plainContent = $this->mailService->getFluidTemplate($arguments, 'MailToAdmin.txt');
            $mailMessage = GeneralUtility::makeInstance(MailMessage::class);
            $mailMessage
                ->setSubject($this->translate($settings['subject']))
                ->addFrom($settings['fromMailAddress'], $settings['fromMailName'])
                ->setTo($emailAddress);
            if (!empty($settings['cc']) && GeneralUtility::validEmail($settings['cc'])) {
                $mailMessage->setCc($settings['cc']);
            }
            $this->mailService->sendMail($mailMessage, $plainContent);
        }
    }

    protected function createNewsObject(Event $event)
    {
        $feUser = $this->getFrontendUserData();

        /** @var \GeorgRinger\NewsEventfields\Domain\Model\News $news */
        $news = $this->objectManager->get(News::class);
        $news->setHidden(1);
        $news->setPid($this->settings['pid']);
        $news->setFrontendUser($feUser['uid']);

        $news->setTitle($event->getEventTitle());
        $news->setEventTitle($event->getEventTitle());
        $news->setEventType($event->getEventType());
        $news->setEventSpeaker($event->getEventSpeaker());
        $news->setEventLanguage($event->getEventLanguage());
        $news->setEventTime($event->getEventTime());
        $news->setEventOpeningHours($event->getEventOpeningHours());
        $news->setEventEnd($event->getEventEnd());
        $news->setEventCurrency($event->getEventCurrency());
        $news->setFeeFree($event->isFeeFree());
        $news->setFee($event->getFee());
        $news->setLocation($event->getLocation());
        $news->setLocationWheelchairAccessible($event->isLocationWheelchairAccessible());
        $news->setLocationCountry($event->getLocationCountry());
        $news->setLocationCity($event->getLocationCity());
        $news->setLocationStreet($event->getLocationStreet());
        $news->setOrganizer($event->getOrganizer());
        $news->setOrganizerWww($event->getOrganizerWww());
        $news->setOrganizerEmail($event->getOrganizerEmail());
        $news->setRegistrationUntil($event->getRegistrationUntil());
        $news->setNotes($event->getNotes());

        $date = DateTime::createFromFormat('d.m.Y', $event->getEventDate());
        if ($date) {
            $news->setDatetime($date);
            $news->setEventDate($date);

            $archiveDate = clone($date);
            $archiveDate = $archiveDate->modify('+1 day');
            $news->setArchive($archiveDate);
        }

        return $news;
    }

    protected function addMediaToNews(News $news)
    {
        $mediaAdded = false;
        if (!empty($_FILES) && is_array($_FILES['media'])) {
            $file = $_FILES['media'];
            $path = trim($this->settings['pathForMedia'], '/') . '/file_' . date('d-m-Y_h-i-s') . '_' . $file['name'];
            $result = GeneralUtility::upload_copy_move($file['tmp_name'], PATH_site . $path);

            if ($result) {
                $resourceFactory = ResourceFactory::getInstance();
                $file = $resourceFactory->getFileObjectFromCombinedIdentifier($path);

                if ($file) {
                    $media = $this->objectManager->get(FileReference::class);
                    $media->setFileUid($file->getUid());
                    $media->setShowinpreview(true);
                    $news->addFalMedia($media);
                    $mediaAdded = true;
                }
            }
        }

        return $mediaAdded;
    }


    /**
     * @return array
     */
    protected function getFrontendUserData()
    {
        /** @var FrontendUserAuthentication $feUser */
        $feUser = $GLOBALS['TSFE']->fe_user;
        if (is_array($feUser->user)) {
            return $feUser->user;
        } else {
            return [];
        }
    }

    /**
     * @param string $key
     * @return string
     */
    protected function translate($key)
    {
        $value = LocalizationUtility::translate($key, 'news_event_registration');
        return $value ?: $key;
    }

    /**
     * action success
     *
     * @return void
     */
    public function successAction()
    {
        $this->view->assignMultiple([
            'user' => $this->getFrontendUserData()
        ]);
    }

    public function initializeAction()
    {
        $this->mailService = GeneralUtility::makeInstance(MailService::class);
    }

    /**
     * @param \GeorgRinger\News\Domain\Repository\NewsRepository $newsRepository
     */
    public function injectNewsRepository(\GeorgRinger\News\Domain\Repository\NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @return TypoScriptFrontendController
     */
    protected function getTsfe() {
        return $GLOBALS['TSFE'];
    }

}
