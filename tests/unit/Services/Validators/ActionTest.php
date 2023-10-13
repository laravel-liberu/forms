<?php

namespace LaravelLiberu\Forms\tests\Services\Validators;

use Illuminate\Support\Collection;
use LaravelLiberu\Forms\Attributes\Actions as Attributes;
use LaravelLiberu\Forms\Exceptions\Template;
use LaravelLiberu\Forms\Services\Validators\Actions;
use LaravelLiberu\Helpers\Services\Obj;
use Tests\TestCase;

class ActionTest extends TestCase
{
    private $template;

    public function setUp(): void
    {
        parent::setup();

        $this->template = new Obj(['actions' => $this->mockedActions()]);
    }

    /** @test */
    public function cannot_validate_with_invalid_action()
    {
        $unknownAction = 'UNKNOWN_ACTION';

        $this->template->get('actions')->push($unknownAction);

        $action = new Actions($this->template);

        $this->expectException(Template::class);

        $actions = Collection::wrap(Attributes::Create)
            ->merge(Attributes::Update)->unique()->implode(', ');

        $this->expectExceptionMessage(
            Template::unknownActions($unknownAction, $actions)->getMessage()
        );

        $action->validate();
    }

    /** @test */
    public function can_validate()
    {
        $action = new Actions($this->template);

        $action->validate();

        $this->assertTrue(true);
    }

    private function mockedActions()
    {
        return Collection::wrap(Attributes::Create)
            ->merge(Attributes::Update)
            ->unique()
            ->values();
    }
}
