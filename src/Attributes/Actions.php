<?php

namespace LaravelEnso\Forms\Attributes;

class Actions
{
    final public const Create = ['back', 'store'];
    final public const Update = ['back', 'create', 'show', 'update', 'destroy'];
}
