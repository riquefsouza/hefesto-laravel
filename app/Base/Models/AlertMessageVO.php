<?php

namespace App\Base\Models;

use App\Http\Controllers\Messages;

class AlertMessageVO
{
    /**
     * @var string
     */
    private $PrimaryMessage;

    /**
     * @var string
     */
    private $SecondaryMessage;

    /**
     * @var string
     */
    private $SuccessMessage;

    /**
     * @var string
     */
    private $DangerMessage;

    /**
     * @var string
     */
    private $WarningMessage;

    /**
     * @var string
     */
    private $InfoMessage;

    /**
     * @var string
     */
    private $LightMessage;

    /**
     * @var string
     */
    private $DarkMessage;

    public function __construct()
    {
        $this->PrimaryMessage = "";
        $this->SecondaryMessage = "";
        $this->SuccessMessage = "";
        $this->DangerMessage = "";
        $this->WarningMessage = "";
        $this->InfoMessage = "";
        $this->LightMessage = "";
        $this->DarkMessage = "";
    }

    /**
     * @return AlertMessageVO
     */
    public static function Primary(string $key)
    {
        $vo = new AlertMessageVO();
        $vo->PrimaryMessage = Messages::MESSAGES[$key];
        return $vo;
    }

    /**
     * @return AlertMessageVO
     */
    public static function Secondary(string $key)
    {
        $vo = new AlertMessageVO();
        $vo->SecondaryMessage = Messages::MESSAGES[$key];
        return $vo;
    }

    /**
     * @return AlertMessageVO
     */
    public static function Success(string $key)
    {
        $vo = new AlertMessageVO();
        $vo->SuccessMessage = Messages::MESSAGES[$key];
        return $vo;
    }

    /**
     * @return AlertMessageVO
     */
    public static function Danger(string $key)
    {
        $vo = new AlertMessageVO();
        $vo->DangerMessage = Messages::MESSAGES[$key];
        return $vo;
    }

    /**
     * @return AlertMessageVO
     */
    public static function Warning(string $key)
    {
        $vo = new AlertMessageVO();
        $vo->WarningMessage = Messages::MESSAGES[$key];
        return $vo;
    }

    /**
     * @return AlertMessageVO
     */
    public static function Info(string $key)
    {
        $vo = new AlertMessageVO();
        $vo->InfoMessage = Messages::MESSAGES[$key];
        return $vo;
    }

    /**
     * @return AlertMessageVO
     */
    public static function Light(string $key)
    {
        $vo = new AlertMessageVO();
        $vo->LightMessage = Messages::MESSAGES[$key];
        return $vo;
    }

    /**
     * @return AlertMessageVO
     */
    public static function Dark(string $key)
    {
        $vo = new AlertMessageVO();
        $vo->DarkMessage = Messages::MESSAGES[$key];
        return $vo;
    }

    public function getPrimaryMessage(): string
    {
        return $this->PrimaryMessage;
    }

    public function getSecondaryMessage(): string
    {
        return $this->SecondaryMessage;
    }

    public function getSuccessMessage(): string
    {
        return $this->SuccessMessage;
    }

    public function getDangerMessage(): string
    {
        return $this->DangerMessage;
    }

    public function getWarningMessage(): string
    {
        return $this->WarningMessage;
    }

    public function getInfoMessage(): string
    {
        return $this->InfoMessage;
    }

    public function getLightMessage(): string
    {
        return $this->LightMessage;
    }

    public function getDarkMessage(): string
    {
        return $this->DarkMessage;
    }

}
