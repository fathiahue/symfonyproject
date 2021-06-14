<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Program;
use App\Entity\Episode;
use App\Entity\Season;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

    /**
     * @Route("/programs", name="program_index")
     */


class ProgramController extends AbstractController


{

    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();
            return $this->render(
                'program/index.html.twig',[
                'programs' => $programs
                ]);
            
}
    /** 
    * @Route("/show/{id}", name="program_show")
    */
    public function show(Program $program): Response

    {
        $seasons = $program->getSeasons();
        //dd($program->getSeasons());
        if (!$program) {
        throw $this->createNotFoundException(
            'No program found in program\'s table.'
        );
    }
    return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $seasons
        ]);
    }

    /**
 * @Route("/programs/{program_id}/comment/{comment_id}", name="season_show")
 * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_id": "id"}})
 * @ParamConverter("season", class="App\Entity\Season", options={"mapping": {"season_id": "id"}})
 */

 public function showSeason(Program $program,Season $season):Response
 {

    $episodes = $season->getEpisodes();

     if (!$season) {
        throw $this->createNotFoundException(
            'No season found in season\'s table.'
        );
    }
    return $this->render('program.html.twig',[
        'program' => $program,
        'season' => $season   
        ]);
    }

   /**
    * @Route("/programs/{programId}/seasons/{seasonId}/episodes/{episodesId},name="episode_show")  
    * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"programId": "id"}})
    * @ParamConverter("season", class="App\Entity\Season", options={"mapping": {"seasonId": "id"}})
    * @ParamConverter("episode", class="App\Entity\Episode", options={"mapping": {"episodeId": "id"}})
    */

 public function showEpisode(Program $program, Season $season, Episode $episode):Response

    {

        if (!$season) {
            throw $this->createNotFoundException(
                'No season found in season\'s table.'
            );
        }
        return $this->render('program/episode_show.html.twig',[
        'program' => $program,
        'season' => $season,
        'episode' => $episode

        ]);
    }

}