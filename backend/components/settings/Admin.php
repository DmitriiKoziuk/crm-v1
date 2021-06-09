<?php declare(strict_types=1);

namespace backend\components\settings;

class Admin
{
    protected $settings;

    public function __construct(array $settings) {
        $this->settings = $settings;
    }

    public function getIds(): array
    {
        return $this->settings['ids'];
    }
}