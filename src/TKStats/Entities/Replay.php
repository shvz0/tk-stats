<?php

namespace App\TKStats\Entities;

class Replay
{
    public \DateTime $date;
    public string $playerCharacter;
    public int $playerWins;
    public int $opponentWins;
    public bool $isPlayerWon;
    public int $playerRating;
    public int $playerRatingDiff;
    public string $opponentName;
    public string $opponentPlayerId;
    public string $opponentCharacter;
    public int $opponentRating;
    public int $opponentRatingDiff;
}
