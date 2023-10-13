<?php

namespace LaravelLiberu\Forms\Services;

use LaravelLiberu\Forms\Services\Validators\Actions;
use LaravelLiberu\Forms\Services\Validators\Fields;
use LaravelLiberu\Forms\Services\Validators\Routes;
use LaravelLiberu\Forms\Services\Validators\Structure;
use LaravelLiberu\Helpers\Services\Obj;

class Validator
{
    public function __construct(private readonly Obj $template)
    {
    }

    public function run(): void
    {
        (new Structure($this->template))->validate();
        (new Actions($this->template))->validate();
        (new Routes($this->template))->validate();
        (new Fields($this->template))->validate();
    }
}
