<?php

namespace App\Entity\Player;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="players", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="tekkenId", column="tekkenId"),
 *      @ORM\UniqueConstraint(name="onlineId", column="onlineId"),
 * })
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $playerName;

    /**
     * @ORM\Column(type="string")
     */
    private $tekkenId;

    /**
     * @ORM\Column(type="string")
     */
    private $onlineId;

    /**
     * @ORM\Column(type="string")
     */
    private $region;

    /**
     * @ORM\Column(type="string")
     */
    private $platform;

    /**
     * @ORM\Column(type=Types::DATETIME)
     */
    private $lastSeen;
}