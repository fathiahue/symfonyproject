<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{

    /**
     * @Route("/programs", name="program_index")
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();
            return $this->render(
                'program/index.html.twig',
                ['programs' => $programs]
            );
            
}
    /** 
    * @Route("/programs/{id}", name="program_show")
    */
    public function show(Program $program): Response
    {
      
    return $this->render('program/show.html.twig', ['program' =>$program]);
    
    }

    /**
 * @Route("/programs/{program_id}/comment/{comment_id}", name="program_season_show")
 * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_id": "id"}})
 * @ParamConverter("season", class="App\Entity\Season", options={"mapping": {"season_id": "id"}})
 */

 public function showSeason(Program $program,Season $season):Response
 {
    return $this->render('program.html.twig',[
        'program' => $program,
        'season' => $season,   ]);
 }

   /**
 * @Route("/programs/{programId}/seasons/{seasonId}/episodes/{episodesId},name="program_episode_show")
 */

 public function showEpisode(Program $program, Season $season, Episode $episode):Response
{
    return $this->render('episode_show.html.twig',[
        'program' => $program,
        'season' => $season,
        'episode' => $episode,
            ]);

}

}