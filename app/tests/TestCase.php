<?php

use Zizaco\FactoryMuff\Facade\FactoryMuff;

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

    //esta funcion se ejecuta automaticamente por PHPUnit
    public function setUp()
    {
        parent::setUp(); // Don't forget this!

        $this->prepareForTests();
    }

    //preparar antes de ejecutar los test
    private function prepareForTests()
    {
        Artisan::call('migrate');

        //meter unos mercados, 100
        for($x = 1; $x<100; $x++) {
            $mercado = FactoryMuff::create('Mercado');
            $mercado->numero = $x;
            $mercado->locales = 200;
            $mercado->save();
        }

        Mail::pretend(true);
    }

}
