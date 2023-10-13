<?php

namespace LaravelLiberu\Forms\tests\Services\Validators;

use Illuminate\Support\Collection;
use LaravelLiberu\Forms\Attributes\Fields as Attributes;
use LaravelLiberu\Forms\Exceptions\Template;
use LaravelLiberu\Forms\Services\Validators\Fields;
use LaravelLiberu\Helpers\Services\Obj;
use Tests\TestCase;

class FieldsTest extends TestCase
{
    private $template;

    protected function setUp(): void
    {
        parent::setUp();

        $this->template = new Obj($this->mockedForm());
    }

    /** @test */
    public function cannot_validate_with_invalid_field_format()
    {
        $this->template->get('sections')->first()->get('fields')->push('');

        $fields = new Fields($this->template);

        $this->expectException(Template::class);

        $this->expectExceptionMessage(
            Template::invalidFieldsFormat()->getMessage()
        );

        $fields->validate();
    }

    /** @test */
    public function cannot_validate_without_mandatory_attribute()
    {
        $this->field()->forget('label');

        $fields = new Fields($this->template);

        $this->expectException(Template::class);

        $this->expectExceptionMessage(
            Template::missingFieldAttributes('label')->getMessage()
        );

        $fields->validate();
    }

    /** @test */
    public function cannot_validate_with_invalid_checkbox_value()
    {
        $this->field()->set('value', 'NOT_BOOL');
        $this->field()->get('meta')->set('type', 'input');
        $this->field()->get('meta')->set('content', 'checkbox');

        $fields = new Fields($this->template);

        $this->expectException(Template::class);

        $this->expectExceptionMessage(
            Template::invalidCheckboxValue(
                $this->field()['name']
            )->getMessage()
        );

        $fields->validate();
    }

    /** @test */
    public function can_validate_custom_meta_and_invalid_values()
    {
        $this->field()->set('value', 'NOT_BOOL');
        $this->field()->get('meta')->set('type', 'input');
        $this->field()->get('meta')->set('content', 'checkbox');
        $this->field()->get('meta')->set('custom', true);

        $fields = new Fields($this->template);

        $fields->validate();

        $this->assertTrue(true);
    }

    /** @test */
    public function cannot_validate_with_invalid_multiple_select_value()
    {
        $this->field()->set('value', 'NOT_ARRAY');
        $this->field()->get('meta')->set('type', 'select');
        $this->field()->get('meta')->set('multiple', true);

        $fields = new Fields($this->template);

        $this->expectException(Template::class);

        $this->expectExceptionMessage(
            Template::invalidSelectValue(
                $this->field()['name']
            )->getMessage()
        );

        $fields->validate();
    }

    /** @test */
    public function can_validate()
    {
        $fields = new Fields($this->template);

        $fields->validate();

        $this->assertTrue(true);
    }

    protected function mockedForm(): array
    {
        $field = Collection::wrap(Attributes::List)
            ->reduce(fn ($field, $attribute) => $field->put($attribute, new Obj()), new Obj());

        $field->get('meta')->set('type', 'textarea');

        return [
            'sections' => [
                ['fields' => [$field]],
            ],
        ];
    }

    protected function field()
    {
        return $this->template->get('sections')->first()->get('fields')->first();
    }
}
