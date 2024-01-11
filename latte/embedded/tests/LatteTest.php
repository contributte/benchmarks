<?php declare(strict_types = 1);

namespace Tests;

use App\LatteFactory;
use Latte\Engine;

class LatteTest
{

	private ?Engine $latte = null;

	public function testTemplate(string $template): void
	{
		$latte = $this->getLatte();
		$latte->renderToString($template);
	}

	private function getLatte(): Engine
	{
		if ($this->latte === null) {
			$this->latte = (new LatteFactory())->create();
		}

		return $this->latte;
	}

}
