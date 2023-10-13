<?php

namespace LaravelLiberu\Forms\Attributes;

class Meta
{
    final public const Mandatory = ['type'];

    final public const Optional = [
        'options', 'multiple', 'custom', 'content', 'step', 'min', 'max', 'disabled', 'readonly',
        'hidden', 'source', 'format', 'altFormat', 'time', 'rows', 'placeholder', 'trackBy',
        'label', 'tooltip', 'symbol', 'precision', 'thousand', 'decimal', 'positive', 'negative',
        'zero', 'resize', 'translated', 'time12hr', 'disable-clear', 'objects', 'toolbar',
        'plugins', 'taggable', 'searchMode',
    ];

    final public const Types = [
        'input', 'select', 'datepicker', 'timepicker', 'textarea', 'password', 'wysiwyg',
    ];
}
