# Web Angkatan 60

Made with Laravel 8, Livewire, Alpine, Tailwind

## Installation

Clone project to your local repository

```bash
git clone https://github.com/modul60stis/web-angkatan.git
cd web-angkatan
```

Install PHP dependency with composer 2 and node.js to build asset

```bash
composer install
npm install
npm run dev
```

Use `npm run watch` instead `dev` while making changes on UI. Before run the project, copy `.env.example` to `.env`, remember **COPY** and do not **RENAME** it. Fill env variable, such as database, google_id, google_client, mail, url, etc. Then, run this command to setup project

```bash
php artisan migrate
php artisan db:seed DatabaseSeeder
php artisan storage:link
```

Finally, run your project

```bash
php artisan serve
```

## Note

There are 2 role right now, users and admin. All new users will be given users role automatically, and for admin you must be admin to add another admin. You can use default admin account `test@mail.com` and password `patrickstar` to add another admin, just for **DEVELOPMENT**. Don't add any secret like google_id, google_client, etc to this repo.