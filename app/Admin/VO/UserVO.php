<?php

namespace App\Admin\VO;

use DateTime;

class UserVO
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $ip;

    /**
     * @var DateTime
     */
    private DateTime $date;

    /**
     * @var string|null
     */
    private string|null $email;

    /**
     * @var string
     */
    private string $login;

    /**
     * @var string|null
     */
    private string|null $name;

    /**
     * @var string
     */
    private string $password;

    /**
     * @var bool
     */
    private bool $active;

    /**
     * @var int[]|null
     */
    private $admIdProfiles = array();

    /**
     * @var string|null
     */
    private string|null $userProfiles;

    /**
     * @var string|null
     */
    private string|null $currentPassword;

    /**
     * @var string|null
     */
    private string|null $newPassword;

    /**
     * @var string|null
     */
    private string|null $confirmNewPassword;

    public function __construct()
    {
        $this->Clean();
    }

    public function Create(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function CreateWithEmail(int $id, string $email, string $login, string $name, bool $active)
    {
        $this->id = $id;
        $this->email = $email;
        $this->login = $login;
        $this->name = $name;
        $this->active = $active;
    }

    public function Clean(): void
    {
        $this->ip = "";
        $this->date = new DateTime();
        $this->email = "";
        $this->login = "";
        $this->name = "";
        $this->password = "";
        $this->active = false;
        $this->admIdProfiles = array();
        $this->userProfiles = "";
        $this->currentPassword = "";
        $this->newPassword = "";
        $this->confirmNewPassword = "";
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): void
    {
        $this->id = $value;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function setIp(string $value): void
    {
        $this->ip = $value;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $value): void
    {
        $this->date = $value;
    }

    public function getEmail(): string | null
    {
        return $this->email;
    }

    public function setEmail(string | null $value): void
    {
        $this->email = $value;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $value): void
    {
        $this->login = $value;
    }

    public function getName(): string | null
    {
        return $this->name;
    }

    public function setName(string | null $value): void
    {
        $this->name = $value;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $value): void
    {
        $this->password = $value;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $value): void
    {
        $this->active = $value;
    }

    /**
     * @return int[]|null
     */
    public function &getAdmIdProfiles()
    {
        return $this->admIdProfiles;
    }

    public function setAdmIdProfiles(array $admIdProfiles): self
    {
        $this->admIdProfiles = $admIdProfiles;

        return $this;
    }

    public function getUserProfiles(): ?string
    {
        return $this->userProfiles;
    }

    public function setUserProfiles(?string $userProfiles): self
    {
        $this->userProfiles = $userProfiles;

        return $this;
    }

    public function getCurrentPassword(): ?string
    {
        return $this->currentPassword;
    }

    public function setCurrentPassword(?string $currentPassword): self
    {
        $this->currentPassword = $currentPassword;

        return $this;
    }

    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    public function setNewPassword(?string $newPassword): self
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    public function getConfirmNewPassword(): ?string
    {
        return $this->confirmNewPassword;
    }

    public function setConfirmNewPassword(?string $confirmNewPassword): self
    {
        $this->confirmNewPassword = $confirmNewPassword;

        return $this;
    }
}
