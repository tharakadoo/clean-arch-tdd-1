<?php

namespace App\Entities;

class Todo
{
    public string $title;
    public ?string $description;
    public string $status;

    public function __construct(string $title, ?string $description = null, string $status = 'pending')
    {
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
    }
}
