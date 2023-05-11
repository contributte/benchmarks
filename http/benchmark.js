const { spawn } = require('child_process');
const fs = require('fs');
const path = require('path');

const VERBOSE = process.env.VERBOSE || false;
const RESULT_FILE = path.resolve(__dirname, 'result.json');
const DOCKER_IMAGE = process.env.DOCKER_IMAGE;
const DOCKER_PORT = 8000;
const DOCKER_WWW = `http://localhost:${DOCKER_PORT}`;

const TEST_APP = [
	// Webservers
	"apache",
	"caddy",
	"nginx",
	"unit",

	// Frameworks
	"amphp",
	"php-server",
	"reactphp",
	"workerman",

	// Process managers
	"php-pm",
	"roadrunner",

	// Extensions
	"openswoole",
	"swoole",
	"swow",
];

const TEST_CASES = [
	{ concurrent: 1, requests: 10000 },
	{ concurrent: 10, requests: 10000 },
	{ concurrent: 100, requests: 10000 },
	{ concurrent: 1000, requests: 10000 },
];

const TEST_TRYOUTS = Array(3).fill(0);

let LOGGER = {
	_prefix: "global",
	prefix(prefix) {
		this._prefix = prefix;
	},
	log(message, ...args) {
		if (this._prefix) {
			console.log(`[${this._prefix}] ${message}`, ...args);
		} else {
			console.log(`${message}`, ...args);
		}
	},
	delimiter() {
		console.log('-'.repeat(100));
	}
};

(async () => {
	const result = {};

	// Iterate all test applications
	for await (const testapp of TEST_APP) {
		// Setup logger
		LOGGER.prefix(testapp);
		LOGGER.log(`BEGIN`);

		// Catch all container-based errors
		let container = null;
		try {
			// Spin docker container
			container = await runContainer(testapp);

			// Iterate all test cases for given application
			for await (const testcases of TEST_CASES) {
				const context = { concurrent: testcases.concurrent, requests: testcases.requests };

				LOGGER.log(`run testcases (tryouts ${TEST_TRYOUTS.length})`, context);

				// Catch all benchmark-based errors
				let benchmark = null;
				try {
					// Cycle retries for given test cases and application
					for await (const [n,] of TEST_TRYOUTS.entries()) {
						LOGGER.log(`benchmark (tryout=${n + 1})`);

						// Run benchmark
						benchmark = await runBenchmark(context);

						// Collect stats for this tryout
						const stats = benchmark.stats();
						result[testapp] = result[testapp] || [];
						result[testapp].push({ app: testapp, rps: stats.Summary.RPS, ...context })

						LOGGER.log(`collecting stats (tryout=${n + 1})`, { rps: stats.Summary.RPS });
					}
				} catch (e) {
				} finally {
					benchmark?.kill();
				}
			}
		} catch (e) {
		} finally {
			// Write stats
			await fs.promises.writeFile(RESULT_FILE, JSON.stringify(result, null, 4));

			// Close docker container
			container?.kill();

			LOGGER.log(`[${testapp}] FINISH`);
			LOGGER.delimiter();
		}
	}
})();

function runContainer(app) {
	return new Promise((resolve, reject) => {
		const ps = spawn('docker', ['run', '-i', "--rm", "-p", `${DOCKER_PORT}:${DOCKER_PORT}`, `${DOCKER_IMAGE}:${app}`]);

		const ret = {
			container: ps,
			kill() {
				ps.kill('SIGTERM');
			}
		};

		ps.stdout.on('data', (data) => {
			if (VERBOSE) LOGGER.log(`${data.toString()}`);
		});
		ps.stderr.on('data', (data) => {
			if (VERBOSE) LOGGER.log(`${data.toString()}`);
		});

		ps.on('spawn', () => {
			if (VERBOSE) LOGGER.log(`container process spawned`);
			resolve(ret);
		});
		ps.on('close', (code) => {
			if (VERBOSE) LOGGER.log(`container process closed (${code})`);
			reject();
		});
	});
}


function runBenchmark({ concurrent, requests }) {
	return new Promise((resolve, reject) => {
		const ps = spawn('plow', ['-c', concurrent, '-n', requests, '--json', '--summary', DOCKER_WWW]);
		const buffer = [];
		const ret = {
			benchmark: ps,
			kill() {
				ps.kill('SIGTERM');
			},
			stats() {
				return JSON.parse(buffer.join("").replace(/\n/g, ""));
			}
		};

		ps.stdout.on('data', (data) => {
			if (VERBOSE) LOGGER.log(`${data.toString()}`);
			buffer.push(data.toString());
		});
		ps.stderr.on('data', (data) => {
			if (VERBOSE) LOGGER.log(`${data.toString()}`);
		});

		ps.on('spawn', () => {
			if (VERBOSE) LOGGER.log(`benchmark process spawned`);
		});
		ps.on('close', (code) => {
			if (VERBOSE) LOGGER.log(`benchmark process closed (${code})`);
			if (code === 0 || code == null) {
				resolve(ret);
			} else {
				reject();
			}
		});
	});
}
