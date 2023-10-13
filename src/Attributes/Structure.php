<?php

namespace LaravelLiberu\Forms\Attributes;

class Structure
{
    final public const Mandatory = ['method', 'sections', 'routeParams'];

    final public const Optional = [
        'actions', 'authorize', 'autosave', 'clearErrorsControl',  'debounce',
        'dividerTitlePlacement', 'icon', 'labels', 'params', 'routePrefix',
        'routes', 'tabs', 'title',
    ];

    final public const SectionMandatory = ['columns', 'fields'];

    final public const SectionOptional = ['divider', 'title', 'column', 'tab', 'slot', 'hidden'];

    final public const Columns = ['custom', 'slot'];
}
