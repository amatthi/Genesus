<?php

require 'recipe/common.php';

if (!file_exists('.deploy_args.php')) {
    echo "No .deploy_args.php file found, using defaults\n";
    $public_key_file  = '~/.ssh/id_rsa.pub';
    $private_key_file = '~/.ssh/id_rsa';
    echo "Deploying with public key located in {$public_key_file} as default\n";
} else {
    require '.deploy_args.php';
    echo "Deploying with public key located in {$public_key_file} as specified in .deploy_args.php\n";
}
/**
 * Set our shared and writeable directories. This is where all the log, cache and
 * release shared files should be placed
 */

//set('shared_dirs', ['public/api/v1/application/cache', 'public/api/v1/application/logs']);
//set('writeable_dirs', ['public/api/v1/application/cache', 'public/api/v1/application/logs']);
set('repository', 'git@github.com:amatthi/Chisel.git');

env('deploy_path', '/var/www/chisel');
server("liftoffsupplements", "liftoffsupplements.com", 22)
    ->user('root')
    //->identityFile($public_key_file, $private_key_file)
    ->identityFile('~/.ssh/id_rsa.pub', '~/.ssh/id_rsa')
    //->forwardAgent()
    ->env('environment', 'production')
    ->stage('production')
    ->env('branch', 'master');

/*server("tappyn-staging", 'test.tappyn.com', 22)
->user('deploy')
->identityFile($public_key_file, $private_key_file)
//->identityFile()
->stage('staging')
->env('environment', 'testing')
->env('branch', 'staging');*/

// Copy our production configuration to our new release directory
task('deploy:config', function () {
    run('cp {{deploy_path}}/shared/.env {{release_path}}/.env');
    run('cd {{release_path}} && chmod -R 777 storage');
})->desc('Adding configuration');

// Install any vendor requirements
task('deploy:vendor', function () {
    run('cd {{release_path}} && composer install --no-dev');
    //run('cd {{release_path}} && npm install');
})->desc('Installing dependenies');

/*
// Gulp our JS/CSS files
task('deploy:build', function () {
run('cd {{release_path}} &&  npm run build');
})->desc("Compiling JS/CSS");*/

//task('deploy:post_update', function () {
//    run('chmod +x {{release_path}}/bin/backup.sh');
//})->desc("Setting up backup process");

// Run database migrations. This depends on both config and vendor
task('deploy:migrate', function () {
    run('cd {{release_path}} && php artisan migrate');
})->desc("Running migrations");

task('deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    //'deploy:post_update',
    'deploy:config',
    'deploy:vendor',
    //'deploy:build',
    'deploy:migrate',
    'deploy:symlink',
    'cleanup',
])->desc('Deploy your project');

after('deploy', 'success');
