<?php

namespace GeorgRinger\NewsEventRegistration\Domain\Validator;

use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

class DateValidator extends AbstractValidator
{

    protected function isValid($value)
    {
        if (empty($value)) {
            $this->addError('The date is required', 1486994605);
        }
        $date = \DateTime::createFromFormat('d.m.Y', $value);
        $dateNow = new \DateTime();
        if (!$date) {
            $this->addError('The date must have the syntax d.m.Y', 1486994606);
        } elseif ($date < $dateNow) {
            $this->addError('The date must be in the future', 1486994607);
        }
    }

}