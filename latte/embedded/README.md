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
    benchButton100x.........................I0 - Mo2.083ms (±0.00%)
    benchButton1000x........................I0 - Mo20.720ms (±0.00%)
    benchButtonMacro1x......................I0 - Mo0.016ms (±0.00%)
    benchButtonMacro100x....................I0 - Mo0.020ms (±0.00%)
    benchButtonMacro1000x...................I0 - Mo0.057ms (±0.00%)
    benchAdvanced...........................I0 - Mo0.174ms (±0.00%)
    benchPureText...........................I0 - Mo0.016ms (±0.00%)
    benchPureBlock..........................I0 - Mo0.020ms (±0.00%)

Subjects: 9, Assertions: 0, Failures: 0, Errors: 0
+------+------------+-----------------------+-----+------+-------------+----------+--------------+----------------+
| iter | benchmark  | subject               | set | revs | mem_peak    | time_avg | comp_z_value | comp_deviation |
+------+------------+-----------------------+-----+------+-------------+----------+--------------+----------------+
| 0    | LatteBench | benchButton1x         |     | 1000 | 3,669,528b  | 0.038ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchButton100x       |     | 1000 | 6,592,328b  | 2.083ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchButton1000x      |     | 1000 | 35,436,232b | 20.720ms | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchButtonMacro1x    |     | 1000 | 3,667,800b  | 0.016ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchButtonMacro100x  |     | 1000 | 3,669,040b  | 0.020ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchButtonMacro1000x |     | 1000 | 5,678,256b  | 0.057ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchAdvanced         |     | 1000 | 4,405,392b  | 0.174ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchPureText         |     | 1000 | 2,681,200b  | 0.016ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchPureBlock        |     | 1000 | 3,667,776b  | 0.020ms  | +0.00σ       | +0.00%         |
+------+------------+-----------------------+-----+------+-------------+----------+--------------+----------------+
```

**with Opcache**

```
PHPBench (1.2.15) running benchmarks... #standwithukraine
with configuration file: phpbench.json
with PHP version 8.2.13, xdebug ✔, opcache ✔

\Tests\LatteBench

    benchButton1x...........................I0 - Mo0.038ms (±0.00%)
    benchButton100x.........................I0 - Mo2.073ms (±0.00%)
    benchButton1000x........................I0 - Mo20.463ms (±0.00%)
    benchButtonMacro1x......................I0 - Mo0.016ms (±0.00%)
    benchButtonMacro100x....................I0 - Mo0.020ms (±0.00%)
    benchButtonMacro1000x...................I0 - Mo0.057ms (±0.00%)
    benchAdvanced...........................I0 - Mo0.171ms (±0.00%)
    benchPureText...........................I0 - Mo0.015ms (±0.00%)
    benchPureBlock..........................I0 - Mo0.019ms (±0.00%)

Subjects: 9, Assertions: 0, Failures: 0, Errors: 0
+------+------------+-----------------------+-----+------+------------+----------+--------------+----------------+
| iter | benchmark  | subject               | set | revs | mem_peak   | time_avg | comp_z_value | comp_deviation |
+------+------------+-----------------------+-----+------+------------+----------+--------------+----------------+
| 0    | LatteBench | benchButton1x         |     | 1000 | 2,320,648b | 0.038ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchButton100x       |     | 1000 | 2,386,184b | 2.073ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchButton1000x      |     | 1000 | 6,687,720b | 20.463ms | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchButtonMacro1x    |     | 1000 | 1,116,600b | 0.016ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchButtonMacro100x  |     | 1000 | 1,116,600b | 0.020ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchButtonMacro1000x |     | 1000 | 1,194,360b | 0.057ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchAdvanced         |     | 1000 | 2,339,344b | 0.171ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchPureText         |     | 1000 | 1,116,552b | 0.015ms  | +0.00σ       | +0.00%         |
| 0    | LatteBench | benchPureBlock        |     | 1000 | 1,116,552b | 0.019ms  | +0.00σ       | +0.00%         |
+------+------------+-----------------------+-----+------+------------+----------+--------------+----------------+
```
