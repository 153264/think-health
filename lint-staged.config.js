export default {
    'src/**/*.php': (files) => {
        return `./vendor/bin/phpstan analyse --no-progress ${files.join(' ')}`
    },
}