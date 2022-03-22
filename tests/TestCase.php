<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected const ADMIN = [
        'name' => 'Admin',
        'email' => 'admin@admin.com',
    ];
}
