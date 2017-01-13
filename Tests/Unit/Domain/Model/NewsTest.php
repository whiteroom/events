<?php
namespace GeorgRinger\NewsEventRegistration\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Georg Ringer 
 */
class NewsTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \GeorgRinger\NewsEventRegistration\Domain\Model\News
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new \GeorgRinger\NewsEventRegistration\Domain\Model\News();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function dummyTestToNotLeaveThisFileEmpty()
    {
        self::markTestIncomplete();
    }
}
