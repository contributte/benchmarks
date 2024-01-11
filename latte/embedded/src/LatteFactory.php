<?php declare(strict_types = 1);

namespace App;

use Latte\Compiler\Nodes\AuxiliaryNode;
use Latte\Compiler\PrintContext;
use Latte\Compiler\Tag;
use Latte\Engine;
use Latte\Extension;

class LatteFactory
{

	public function create(): Engine
	{
		@mkdir(__DIR__ . '/../temp', 0777, true);

		$latte = new Engine();
		$latte->setTempDirectory(__DIR__ . '/../temp');
		$latte->setLoader(
			(new WidgetLoader())
				->withWidgets([
					'button' => __DIR__ . '/../widgets/button.latte',
					'collapse' => __DIR__ . '/../widgets/collapse.latte',
					'dropdown' => __DIR__ . '/../widgets/dropdown.latte',
					'modal' => __DIR__ . '/../widgets/modal.latte',
					'tabs' => __DIR__ . '/../widgets/tabs.latte',
					'tooltip' => __DIR__ . '/../widgets/tooltip.latte',
				])
				->withDelimiter('~')
		);
		$latte->addExtension(new class extends Extension {
			public function getTags(): array
			{
				return [
					'mbutton' => fn (Tag $tag) => new AuxiliaryNode(
						fn (PrintContext $context) => $context->format('echo "<button>";'),
					),
				];
			}
		});

		return $latte;
	}

}
