<?php

namespace Tasty\Entity;

/**
 * Class TestTaker
 * @package Tasty\Entity
 * @author Faley Aliaksandr
 */
class TestTaker
{
    const TITLE_MR = 'mr';
    const TITLE_MS = 'ms';
    const TITLE_MRS = 'mrs';
    const TITLE_MISS = 'miss';

    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';

    public static $titles = [
        self::TITLE_MR,
        self::TITLE_MS,
        self::TITLE_MRS,
        self::TITLE_MISS
    ];

    public static $genders = [
        self::GENDER_MALE,
        self::GENDER_FEMALE
    ];

    /**
     * @var string|null
     */
    protected $login;

    /**
     * @var string|null
     */
    protected $password;

    /**
     * @var string|null
     */
    protected $title;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string|null
     */
    protected $gender;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string|null
     */
    protected $picture;

    /**
     * @var string|null
     */
    protected $address;

    /**
     * TestTaker constructor.
     * @param string $email
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(string $email, string $firstName, string $lastName)
    {
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @return string|null
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @param string|null $login
     */
    public function setLogin(?string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string|null $gender
     */
    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string|null $picture
     */
    public function setPicture(?string $picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

}