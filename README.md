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

## Email Notifications

If you want send email notifications, use like this

```php
$user->notify(new EmailNotifications((new MailMessage)
            ->subject("PA60 - Title")
            ->greeting("Halloo Name")
            ->line('The to the notification.')
            ->action('Notification Action', route('home'))
            ->line('Haloo!')));
```

Just notify `$user` with `EmailNotifications` with `MailMessage` object. All email will be queue on database and will be delivered in 2 minutes interval. You can generate custom email you want by adding to MailMessage object

| function   | description                                |
| ---------- | ------------------------------------------ |
| subject    | Add email subject                          |
| greeting   | Email greetings, if null it just say Hello |
| line       | Add one line text to email                 |
| action     | Button, required title and route           |
| salutation | Salutations text                           |


For complete function, you can see at [SimpleMessage](./vendor/laravel/framework/src/Illuminate/Notifications/Messages/SimpleMessage.php). If you want to add custom email, you can extends `EmailNotification` class and add your format to it.

> For subject, please use this format "`PA60 - Email Subject`"


## Docker User

for docker user, set PHPUSER and PHPGROUP on environment and then run this command to setup project

```bash
docker compose up -d

docker compose run --user ${UID}:${GID} composer install --ignore-platform-reqs

docker compose run --user ${UID}:${GID} artisan migrate:fresh --seed

docker compose run --user ${UID}:${GID} artisan key:generate
```