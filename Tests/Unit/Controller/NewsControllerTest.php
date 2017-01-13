<?php
namespace GeorgRinger\NewsEventRegistration\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Georg Ringer 
 */
class NewsControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \GeorgRinger\NewsEventRegistration\Controller\NewsController
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = $this->getMock(\GeorgRinger\NewsEventRegistration\Controller\NewsController::class, ['redirect', 'forward', 'addFlashMessage'], [], '', false);
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenNewsToNewsRepository()
    {
        $news = new \GeorgRinger\NewsEventRegistration\Domain\Model\News();

        $newsRepository = $this->getMock(\::class, ['add'], [], '', false);
        $newsRepository->expects(self::once())->method('add')->with($news);
        $this->inject($this->subject, 'newsRepository', $newsRepository);

        $this->subject->createAction($news);
    }
}
