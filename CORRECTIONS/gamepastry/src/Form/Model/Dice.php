<?php

namespace App\Form\Model;

class Dice
{
    protected string | int $dice1;
    protected string | int $dice2;
    protected string | int $dice3;
    protected string | int $dice4;
    protected string | int $dice5;
    protected string | int $dice6;

    /**
     * Get the value of dice1
     */
    public function getDice1(): string | int
    {
        return $this->dice1;
    }

    /**
     * Set the value of dice1
     */
    public function setDice1($dice1): self
    {
        $this->dice1 = $dice1;

        return $this;
    }

    /**
     * Get the value of dice2
     */
    public function getDice2(): string | int
    {
        return $this->dice2;
    }

    /**
     * Set the value of dice2
     */
    public function setDice2($dice2): self
    {
        $this->dice2 = $dice2;

        return $this;
    }

    /**
     * Get the value of dice3
     */
    public function getDice3(): string | int
    {
        return $this->dice3;
    }

    /**
     * Set the value of dice3
     */
    public function setDice3($dice3): self
    {
        $this->dice3 = $dice3;

        return $this;
    }

    /**
     * Get the value of dice4
     */
    public function getDice4(): string | int
    {
        return $this->dice4;
    }

    /**
     * Set the value of dice4
     */
    public function setDice4($dice4): self
    {
        $this->dice4 = $dice4;

        return $this;
    }

    /**
     * Get the value of dice5
     */
    public function getDice5(): string | int
    {
        return $this->dice5;
    }

    /**
     * Set the value of dice5
     */
    public function setDice5($dice5): self
    {
        $this->dice5 = $dice5;

        return $this;
    }

    /**
     * Get the value of dice6
     */
    public function getDice6(): string | int
    {
        return $this->dice6;
    }

    /**
     * Set the value of dice6
     */
    public function setDice6($dice6): self
    {
        $this->dice6 = $dice6;

        return $this;
    }

    public function hydrate(array $dices): void
    {
        for ($i = 1; $i < 6; $i++) {
            $set = "setDice$i" ;

            $this->$set($dices[$i - 1]);
        }
    }
}
