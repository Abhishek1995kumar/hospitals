## Install Inertia
- composer require inertiajs/inertia-laravel
- php artisan inertia:middleware
- add this in bootstrap/app.php -- $middleware->web(append: [
        \App\Http\Middleware\HandleInertiaRequests::class,
    ]);
- npm install react react-dom
- npm install @inertiajs/react
- npm install -D @vitejs/plugin-react - ye install karo
- npm install -D @vitejs/plugin-react@4.7.0 -- ya ye install karne ke liye package.json me vite6. hona chahiye
- npm install
- php artisan install:react
- npm install @heroicons/react
- npm install dayjs
- npm install sweetalert2
- npm install react-toastify
- npm install clsx
- composer require tightenco/ziggy
- npm install ziggy-js
- php artisan ziggy:generate
- composer dump-autoload


## SHOW/CHECK COMMAND
- npm run build
- php artisan --version
- composer show tightenco/ziggy
- composer show laravel/framework
- composer show laravel/starter-kit
- php -v
- npm list @inertiajs/react
- npm list react
- npm list @vitejs/plugin-react
- where node
- where npm
- node -v
- npm -v
- npm cache clean
- npm cache clean --force
- php artisan route:list --name=index
- composer show | findstr spreadsheet
- composer show | findstr maatwebsite
- composer require maatwebsite/excel:^3.1 -W -- installation, ye latest version install karta hai

- agar composer require maatwebsite/excel:^3.1 -W -- install nahi hua tab - composer config 
        minimum-stability -
        ye command chalana hoga, phir ye -- composer config repositories, uske baad ye -- composer diagnose

- composer show maatwebsite/excel -- remove installed labrary

- composer clear command -- composer clear-cache


- maatwebsite install 
    - composer require "maatwebsite/excel:^3.1" -W -- ye 3.1 se uppar ka version install karega
    - agar error aaye tab 
        - open php.ini
            - ;extension=zip
            - ;extension=gd
            - ;extension=xml
            - ;extension=mbstring
            - ;extension=fileinfo
            in sare extension ko search kar aur uncomment karo
    - php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config









## FOR GIT --
- git config --global http.postBuffer 524288000
- git config --global http.version HTTP/1.1
- git push -u origin master





## Queue Run --
- php artisan queue:work
- php artisan queue:restart 
