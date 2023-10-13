<?php

namespace LaravelLiberu\Forms\Services\Validators;

use Illuminate\Support\Collection;
use LaravelLiberu\Forms\Attributes\Actions as Attributes;
use LaravelLiberu\Forms\Exceptions\Template;
use LaravelLiberu\Helpers\Services\Obj;

class Actions
{
    public function __construct(private readonly Obj $template)
    {
    }

    public function validate(): void
    {
        $attributes = Collection::wrap(Attributes::Create)
            ->merge(Attributes::Update)
            ->unique()
            ->values();

        $diff = $this->template->get('actions')
            ->diff($attributes);

        if ($diff->isNotEmpty()) {
            throw Template::unknownActions(
                $diff->implode(', '),
                $attributes->implode(', ')
            );
        }
    }
}
