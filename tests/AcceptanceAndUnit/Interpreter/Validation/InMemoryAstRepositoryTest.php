<?php namespace Test\AcceptanceAndUnit\Interpreter\Validation;

use App\Interpreter\Validation\InMemoryAstRepository;

class InMemoryAstRepositoryTest extends AbstractAstRepositoryTest
{
    protected function make_repository()
    {
        return new InMemoryAstRepository();
    }
}
