const exec = require('child_process').exec;
const webpack = exec('npm run dev');
const php = exec('php run.php');

function bindPipes(childProcess) {
    childProcess.stdout.on('data', (data) => {
        console.log(`${data}`);
    });

    childProcess.stderr.on('data', (data) => {
        console.log(`${data}`);
    });

    childProcess.on('close', (code) => {
        console.log(`child process exited with code ${code}`);
    });
}
bindPipes(webpack);
bindPipes(php);