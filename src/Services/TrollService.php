<?php

namespace App\Services;

class TrollService
{
    protected array $trollUnnamed;
    protected array $trollNamed;

    public function __construct()
    {
        $this->trollUnnamed = [
            'You are a troll.',
            'You are a very bad troll.',
            'You are a bad troll.',
        ];
        $this->trollNamed = [
            '{{name}} is a troll.',
            '{{name}} is a very bad troll.',
            '{{name}} is a bad troll.',
        ];
    }

    public function getRandomTroll(bool $isNamed = false): string
    {
        $trolls = $this->trollUnnamed;
        if ($isNamed) {
            $trolls = $this->trollNamed;
        }
        return $trolls[array_rand($trolls)];
    }

    public function getTroll(?string $nomDuBobby = null): string
    {
        $trollMessage = $this->getRandomTroll(($nomDuBobby !== null));
        // if $nomDuBobby !== null -> replace {{NAME}} with $nomDuBobby
        if ($nomDuBobby !== null) {
            $trollMessage = str_replace('{{NAME}}', $nomDuBobby, $trollMessage);
        }

        return $trollMessage;
    }
}