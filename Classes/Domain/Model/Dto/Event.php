<?php
namespace GeorgRinger\NewsEventRegistration\Domain\Model\Dto;

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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * News
 */
class Event extends AbstractEntity
{

    /**
     * eventTitle
     *
     * @var string
     * @validate NotEmpty
     */
    protected $eventTitle = '';

    /**
     * eventType
     *
     * @var string
     * @validate NotEmpty
     */
    protected $eventType = '';

    /**
     * eventSpeaker
     *
     * @var string
     */
    protected $eventSpeaker = '';

    /**
     * eventLanguage
     *
     * @var string
     */
    protected $eventLanguage = '';

    /**
     * eventDate
     *
     * @var string
     * @validate NotEmpty
     * @validate \GeorgRinger\NewsEventRegistration\Domain\Validator\DateValidator
     */
    protected $eventDate = '';

    /**
     * eventTime
     *
     * @var string
     */
    protected $eventTime = '';

    /**
     * eventOpeningHours
     *
     * @var string
     */
    protected $eventOpeningHours = '';

    /**
     * eventEnd
     *
     * @var string
     */
    protected $eventEnd = '';

    /**
     * feeFree
     *
     * @var bool
     */
    protected $feeFree = false;

    /**
     * fee
     *
     * @var string
     */
    protected $fee = '';

    /**
     * eventCurrency
     *
     * @var string
     */
    protected $eventCurrency = '';

    /**
     * location
     *
     * @var string
     */
    protected $location = '';

    /**
     * locationStreet
     *
     * @var string
     */
    protected $locationStreet = '';

    /**
     * locationCity
     *
     * @var string
     */
    protected $locationCity = '';

    /**
     * locationCountry
     *
     * @var string
     */
    protected $locationCountry = '';

    /**
     * locationWheelchairAccessible
     *
     * @var bool
     */
    protected $locationWheelchairAccessible = false;

    /**
     * organizer
     *
     * @var string
     */
    protected $organizer = '';

    /**
     * organizerWww
     *
     * @var string
     */
    protected $organizerWww = '';

    /**
     * organizerEmail
     *
     * @var string
     */
    protected $organizerEmail = '';

    /**
     * registrationUntil
     *
     * @var string
     */
    protected $registrationUntil = '';

    /**
     * notes
     *
     * @var string
     */
    protected $notes = '';

    /**
     * @return string
     */
    public function getEventTitle()
    {
        return $this->eventTitle;
    }

    /**
     * @param string $eventTitle
     */
    public function setEventTitle($eventTitle)
    {
        $this->eventTitle = $eventTitle;
    }

    /**
     * @return string
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * @param string $eventType
     */
    public function setEventType($eventType)
    {
        $this->eventType = $eventType;
    }

    /**
     * @return string
     */
    public function getEventSpeaker()
    {
        return $this->eventSpeaker;
    }

    /**
     * @param string $eventSpeaker
     */
    public function setEventSpeaker($eventSpeaker)
    {
        $this->eventSpeaker = $eventSpeaker;
    }

    /**
     * @return string
     */
    public function getEventLanguage()
    {
        return $this->eventLanguage;
    }

    /**
     * @param string $eventLanguage
     */
    public function setEventLanguage($eventLanguage)
    {
        $this->eventLanguage = $eventLanguage;
    }

    /**
     * @return string
     */
    public function getEventDate()
    {
        return $this->eventDate;
    }

    /**
     * @param string $eventDate
     */
    public function setEventDate($eventDate)
    {
        $this->eventDate = $eventDate;
    }

    /**
     * @return string
     */
    public function getEventTime()
    {
        return $this->eventTime;
    }

    /**
     * @param string $eventTime
     */
    public function setEventTime($eventTime)
    {
        $this->eventTime = $eventTime;
    }

    /**
     * @return string
     */
    public function getEventOpeningHours()
    {
        return $this->eventOpeningHours;
    }

    /**
     * @param string $eventOpeningHours
     */
    public function setEventOpeningHours($eventOpeningHours)
    {
        $this->eventOpeningHours = $eventOpeningHours;
    }

    /**
     * @return string
     */
    public function getEventEnd()
    {
        return $this->eventEnd;
    }

    /**
     * @param string $eventEnd
     */
    public function setEventEnd($eventEnd)
    {
        $this->eventEnd = $eventEnd;
    }

    /**
     * @return bool
     */
    public function isFeeFree()
    {
        return $this->feeFree;
    }

    /**
     * @param bool $feeFree
     */
    public function setFeeFree($feeFree)
    {
        $this->feeFree = $feeFree;
    }

    /**
     * @return string
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @param string $fee
     */
    public function setFee($fee)
    {
        $this->fee = $fee;
    }

    /**
     * @return string
     */
    public function getEventCurrency()
    {
        return $this->eventCurrency;
    }

    /**
     * @param string $eventCurrency
     */
    public function setEventCurrency($eventCurrency)
    {
        $this->eventCurrency = $eventCurrency;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getLocationStreet()
    {
        return $this->locationStreet;
    }

    /**
     * @param string $locationStreet
     */
    public function setLocationStreet($locationStreet)
    {
        $this->locationStreet = $locationStreet;
    }

    /**
     * @return string
     */
    public function getLocationCity()
    {
        return $this->locationCity;
    }

    /**
     * @param string $locationCity
     */
    public function setLocationCity($locationCity)
    {
        $this->locationCity = $locationCity;
    }

    /**
     * @return string
     */
    public function getLocationCountry()
    {
        return $this->locationCountry;
    }

    /**
     * @param string $locationCountry
     */
    public function setLocationCountry($locationCountry)
    {
        $this->locationCountry = $locationCountry;
    }

    /**
     * @return bool
     */
    public function isLocationWheelchairAccessible()
    {
        return $this->locationWheelchairAccessible;
    }

    /**
     * @param bool $locationWheelchairAccessible
     */
    public function setLocationWheelchairAccessible($locationWheelchairAccessible)
    {
        $this->locationWheelchairAccessible = $locationWheelchairAccessible;
    }

    /**
     * @return string
     */
    public function getOrganizer()
    {
        return $this->organizer;
    }

    /**
     * @param string $organizer
     */
    public function setOrganizer($organizer)
    {
        $this->organizer = $organizer;
    }

    /**
     * @return string
     */
    public function getOrganizerWww()
    {
        return $this->organizerWww;
    }

    /**
     * @param string $organizerWww
     */
    public function setOrganizerWww($organizerWww)
    {
        $this->organizerWww = $organizerWww;
    }

    /**
     * @return string
     */
    public function getOrganizerEmail()
    {
        return $this->organizerEmail;
    }

    /**
     * @param string $organizerEmail
     */
    public function setOrganizerEmail($organizerEmail)
    {
        $this->organizerEmail = $organizerEmail;
    }

    /**
     * @return string
     */
    public function getRegistrationUntil()
    {
        return $this->registrationUntil;
    }

    /**
     * @param string $registrationUntil
     */
    public function setRegistrationUntil($registrationUntil)
    {
        $this->registrationUntil = $registrationUntil;
    }

    /**
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

}
