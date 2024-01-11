# Embedded benchmark

## Usage

1. Install dependencies via `composer install`.
2. Run `./benchmark.sh` to run benchmark without opcache.
3. Run `OPCACHE=1 ./benchmark.sh` to run benchmark with opcache.
4. Run `./benchmark-all.sh 1` to run all benchmarks.

## Results

**no Opcache**

```
PHPBench (1.2.15) running benchmarks... #standwithukraine
with configuration file: phpbench.json
with PHP version 8.2.13, xdebug ✔, opcache ❌

\Tests\LatteBench

    benchButton1x...........................I0 - Mo0.038ms (±0.00%)
    benchButton100x.........................I0 - Mo2.092ms (±0.00%)
    benchButtonMacro1x......................I0 - Mo0.016ms (±0.00%)
    benchButtonMacro100x....................I0 - Mo0.058ms (±0.00%)
    benchAdvanced...........................I0 - Mo0.173ms (±0.00%)
    benchPureText...........................I0 - Mo0.016ms (±0.00%)
    benchPureBlock..........................I0 - Mo0.020ms (±0.00%)

Subjects: 7, Assertions: 0, Failures: 0, Errors: 0
+------+------------+----------------------+-----+------+------------+----------+--------------+----------------+
| iter | benchmark  | subject              | set | revs | mem_peak   | time_avg | comp_z_value | comp_deviation |
+------+------------+----------------------+-----+------+------------+----------+--------------+----------------+
| 0    | LatteBench | benchButton1x        |     | 1000 | 3,733,064b | 0.038ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchButton100x      |     | 1000 | 3,933,888b | 2.092ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchButtonMacro1x   |     | 1000 | 1,554,808b | 0.016ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchButtonMacro100x |     | 1000 | 1,756,096b | 0.058ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchAdvanced        |     | 1000 | 4,225,464b | 0.173ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchPureText        |     | 1000 | 1,554,112b | 0.016ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchPureBlock       |     | 1000 | 1,555,992b | 0.020ms  | +0.00σ       | +0.00%         |
+------+------------+----------------------+-----+------+------------+----------+--------------+----------------+
```

**with Opcache**

```
PHPBench (1.2.15) running benchmarks... #standwithukraine
with configuration file: phpbench.json
with PHP version 8.2.13, xdebug ✔, opcache ✔

\Tests\LatteBench

    benchButton1x...........................I0 - Mo0.037ms (±0.00%)
    benchButton100x.........................I0 - Mo2.052ms (±0.00%)
    benchButtonMacro1x......................I0 - Mo0.016ms (±0.00%)
    benchButtonMacro100x....................I0 - Mo0.057ms (±0.00%)
    benchAdvanced...........................I0 - Mo0.171ms (±0.00%)
    benchPureText...........................I0 - Mo0.015ms (±0.00%)
    benchPureBlock..........................I0 - Mo0.020ms (±0.00%)

Subjects: 7, Assertions: 0, Failures: 0, Errors: 0
+------+------------+----------------------+-----+------+------------+----------+--------------+----------------+
| iter | benchmark  | subject              | set | revs | mem_peak   | time_avg | comp_z_value | comp_deviation |
+------+------------+----------------------+-----+------+------------+----------+--------------+----------------+
| 0    | LatteBench | benchButton1x        |     | 1000 | 2,320,648b | 0.037ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchButton100x      |     | 1000 | 2,386,184b | 2.052ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchButtonMacro1x   |     | 1000 | 1,116,600b | 0.016ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchButtonMacro100x |     | 1000 | 1,194,360b | 0.057ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchAdvanced        |     | 1000 | 2,339,344b | 0.171ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchPureText        |     | 1000 | 1,116,552b | 0.015ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchPureBlock       |     | 1000 | 1,116,552b | 0.020ms  | +0.00σ       | +0.00%         |
+------+------------+----------------------+-----+------+------------+----------+--------------+----------------+
```
