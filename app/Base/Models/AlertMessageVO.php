<?php

namespace App\Base\Models;

class AlertMessageVO
{
    public $messages;

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

        $spath = __DIR__ . '/lang/pt_BR/messages.php';
        $this->messages = file_get_contents($spath);
    }

    /**
     * @return AlertMessageVO
     */
    public static function Primary(string $key)
    {
        $vo = new AlertMessageVO();
        $vo->PrimaryMessage = $vo->messages[$key];
        return $vo;
    }

    /**
     * @return AlertMessageVO
     */
    public static function Secondary(string $key)
    {
        $vo = new AlertMessageVO();
        $vo->SecondaryMessage = $vo->messages[$key];
        return $vo;
    }

    /**
     * @return AlertMessageVO
     */
    public static function Success(string $key)
    {
        $vo = new AlertMessageVO();
        $vo->SuccessMessage = $vo->messages[$key];
        return $vo;
    }

    /**
     * @return AlertMessageVO
     */
    public static function Danger(string $key)
    {
        $vo = new AlertMessageVO();
        $vo->DangerMessage = $vo->messages[$key];
        return $vo;
    }

    /**
     * @return AlertMessageVO
     */
    public static function Warning(string $key)
    {
        $vo = new AlertMessageVO();
        $vo->WarningMessage = $vo->messages[$key];
        return $vo;
    }

    /**
     * @return AlertMessageVO
     */
    public static function Info(string $key)
    {
        $vo = new AlertMessageVO();
        $vo->InfoMessage = $vo->messages[$key];
        return $vo;
    }

    /**
     * @return AlertMessageVO
     */
    public static function Light(string $key)
    {
        $vo = new AlertMessageVO();
        $vo->LightMessage = $vo->messages[$key];
        return $vo;
    }

    /**
     * @return AlertMessageVO
     */
    public static function Dark(string $key)
    {
        $vo = new AlertMessageVO();
        $vo->DarkMessage = $vo->messages[$key];
        return $vo;
    }

}
