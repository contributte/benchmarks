<?php declare(strict_types = 1);

namespace Tests;

class LatteBench
{

	private LatteTest $test;

	public function __construct()
	{
		$this->test = new LatteTest();
	}

	/**
	 * @Revs(1000)
	 * @Warmup(1)
	 */
	public function benchButton1x(): void
	{
		$this->test->testTemplate(__DIR__ . '/../templates/button-1x.latte');
	}

	/**
	 * @Revs(1000)
	 * @Warmup(1)
	 */
	public function benchButton100x(): void
	{
		$this->test->testTemplate(__DIR__ . '/../templates/button-100x.latte');
	}

	/**
	 * @Revs(1000)
	 * @Warmup(1)
	 */
	public function benchButton1000x(): void
	{
		$this->test->testTemplate(__DIR__ . '/../templates/button-1000x.latte');
	}

	/**
	 * @Revs(1000)
	 * @Warmup(1)
	 */
	public function benchButtonMacro1x(): void
	{
		$this->test->testTemplate(__DIR__ . '/../templates/button-macro-1x.latte');
	}

	/**
	 * @Revs(1000)
	 * @Warmup(1)
	 */
	public function benchButtonMacro100x(): void
	{
		$this->test->testTemplate(__DIR__ . '/../templates/button-macro-100x.latte');
	}

	/**
	 * @Revs(1000)
	 * @Warmup(1)
	 */
	public function benchButtonMacro1000x(): void
	{
		$this->test->testTemplate(__DIR__ . '/../templates/button-macro-1000x.latte');
	}

	/**
	 * @Revs(1000)
	 * @Warmup(1)
	 */
	public function benchAdvanced(): void
	{
		$this->test->testTemplate(__DIR__ . '/../templates/advanced.latte');
	}

	/**
	 * @Revs(1000)
	 * @Warmup(1)
	 */
	public function benchPureText(): void
	{
		$this->test->testTemplate(__DIR__ . '/../templates/pure-text.latte');
	}

	/**
	 * @Revs(1000)
	 * @Warmup(1)
	 */
	public function benchPureBlock(): void
	{
		$this->test->testTemplate(__DIR__ . '/../templates/pure-block.latte');
	}

}
