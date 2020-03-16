<?php


namespace App\Feedback;


use App\Infrastructure\Doctrine\Flusher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/feedback")
 */
class FeedbackController extends AbstractController
{
    /**
     * @Route(methods={"POST"})
     * @param FeedbackData $feedbackData
     * @param FeedbackRepository $feedbackRepository
     * @param Flusher $flusher
     */
    public function create(FeedbackData $feedbackData, FeedbackRepository $feedbackRepository, Flusher $flusher)
    {
        $feedback = new Feedback($feedbackData->name, $feedbackData->email, $feedbackData->text);
        $feedbackRepository->add($feedback);
        $flusher->flush();
    }
}