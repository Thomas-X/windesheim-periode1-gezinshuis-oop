const exec = require('child_process').exec;
const chalk = require('chalk');
const chalkAnimation = require('chalk-animation');
const webpack = exec('npm run dev');
const php = exec('php executePHP.php');

function bindPipes(childProcess) {
    // standard EventEmitter logic, nothing special here
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

// TODO
// really ghetto but I want the child processes to be non-blocking so this is the solution for now
setTimeout(function () {

    // fancy text output to let the user now all is well
    console.log(`
${chalk.bold.cyan('====================')}
  .oooooo.                   o8o  
 d8P'  \`Y8b                    
888      888    oooo  oooo  oooo  
888      888    \`888  \`888  \`888  
888      888     888   888   888  
\`88b    d88b     888   888   888  
 \`Y8bood8P'Ybd'  \`V88V"V8P' o888o              
${chalk.keyword('lime').bold('All is set, PHP webserver is running on port 8000')}
${chalk.keyword('lime').bold('Webpack JS files are compiled. Edit javascript files in /views/javacript/')}
${chalk.keyword('lime').bold(`You'll see the webpack compiler and PHP webserver output in this terminal.`)}
${chalk.bold.cyan('====================')}`);
}, 3500);

