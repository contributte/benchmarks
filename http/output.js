const fs = require('fs');
const path = require('path');

const RESULT_FILE = path.resolve(__dirname, 'result.json');

function median(arr) {
	if (!arr.length) return undefined;
	const s = [...arr].sort((a, b) => a - b);
	const mid = Math.floor(s.length / 2);
	return s.length % 2 === 0 ? ((s[mid - 1] + s[mid]) / 2) : s[mid];
}

(async () => {
	const rawdata = await fs.promises.readFile(RESULT_FILE);
	const testresults = JSON.parse(rawdata.toString());
	const report = [
		`| App | C1/R10000 | C10/R10000 | C100/R10000 | C1000/R10000 | `,
		`|---|---|---|---|---|`
	];

	for await (const [testapp, results] of Object.entries(testresults)) {
		const groups = {};
		for await (const result of results) {
			const key = `C${result.concurrent}/R${result.requests}`;
			groups[key] = groups[key] || [];
			groups[key].push(result);
		}

		const medians = {};
		for await (const [group, items] of Object.entries(groups)) {
			medians[group] = Math.round(median(items.map(i => i.rps)));
		}

		report.push(`| ${testapp} | ${medians['C1/R10000']} | ${medians['C10/R10000']} | ${medians['C100/R10000']} | ${medians['C1000/R10000']} |`);
	}

	console.log(report.join("\n"));
})();
