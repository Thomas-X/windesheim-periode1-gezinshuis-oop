const path = require('path');
const sass = require('node-sass');
const fs = require('fs');
const util = require('util');
const watch = require('watch');

const outputDir = path.join(__dirname, 'public', 'css');
const inputDir = path.join(__dirname, 'resources', 'assets', 'sass');

watch.watchTree(inputDir, (f, curr, prev) => {
    const promises = [];
    function compileSass(filename) {
        const compiled = sass.renderSync({
            file: path.join(inputDir, filename + '.scss')
        });
        const promise = new Promise((resolve, reject) => {
            fs.writeFile(path.resolve(outputDir, filename + '.css'), compiled.css.toString(), {}, (err) => {
                if (err) {
                    reject(err);
                }
                resolve();
            });
        });
        promises.push(
            promise
        );
    }
    /*
    * compile sass
    * */
    const files = fs.readdirSync(path.resolve(__dirname, 'resources', 'assets', 'sass'));
    for (let i = 0; i < files.length; i++) {
        let fileName = files[i]
            .split('.scss')
        fileName.pop();
        fileName = fileName[0];
        compileSass(fileName)
    }

    Promise.all(promises);
});