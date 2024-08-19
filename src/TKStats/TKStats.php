<?php

namespace App\TKStats;
use App\TKStats\Entities\Replay;
use GuzzleHttp\Client;

class TKStats
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client([
            'base_uri' => 'https://wank.wavu.wiki',
        ]);
    }

    public function getWavuPlayerStats($playerId)
    {
        $response = $this->httpClient->get("/player/$playerId");
        $htmlBody = (string) $response->getBody();

        // file_put_contents('test.html', $htmlBody);
        // $htmlBody = file_get_contents('test.html');
        $xpath = $this->getDomXpathByHtmlBody($htmlBody);

        $trElements = $xpath->query('/html/body/main/div/table/tbody/tr');


        $replays = [];
        /**
         * @var \DOMElement $trElement
         */
        foreach ($trElements as $trElement) {
            try {
                /**
                 * @var \DOMNodeList|\ArrayAccess|\DOMElement[]
                 */
                $tds = $xpath->query('td', $trElement);
                $replay = new Replay;
                $replay->date = new \DateTime($tds[0]->textContent);
                $replay->playerCharacter = $tds[1]->textContent;

                preg_match('/(?<wins>\d)-(?<loses>\d)\s+(?<result>\w+)/', $tds[2]->textContent, $m);
                $replay->playerWins = $m['wins'];
                $replay->opponentWins = $m['loses'];
                $replay->isPlayerWon = $m['result'] == 'WIN';

                $ratingRegex = '/(?<rating>[0-9]+).*(?<rating_diff>[+-]\d)/s';

                preg_match($ratingRegex, $tds[3]->textContent, $m);
                $replay->playerRating = $m['rating'];
                $replay->playerRatingDiff = $m['rating_diff'];

                /**
                 * @var \DOMElement
                 */
                $opponentNode = $xpath->query('a', $tds[4])[0];
                $replay->opponentName = $opponentNode->textContent;
                $replay->opponentPlayerId = explode('/', $opponentNode->getAttribute('href'))[2];

                $replay->opponentCharacter = $tds[5]->textContent;

                preg_match($ratingRegex, $tds[6]->textContent, $m);
                $replay->opponentRating = $m['rating'];
                $replay->opponentRatingDiff = $m['rating_diff'];

                $replays[] = $replay;
            } catch (\Throwable $t) {
                throw $t;
            }
        }

        return $replays;
    }

    protected function getDomXpathByHtmlBody(string $htmlBody): \DOMXPath
    {
        $domDoc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $domDoc->loadHTML($htmlBody);
        return new \DOMXPath($domDoc);
    }

    /**
     * Trim and remove '-'
     * @param string $playerId
     * @return string
     */
    protected function proccessPlayerId(string $playerId)
    {
        return str_replace('-', '', trim($playerId));
    }
}
