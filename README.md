<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## While new setup run for migration and seeder
php artisan migrate

## Install Package 22-Jan-25
composer require laravel/sanctum
## Install Package 22-Jan-25
composer require darkaonline/l5-swagger

php artisan config:publish cors

## create column in users 25-Jan-25
ALTER TABLE `users` ADD `user_id` VARCHAR(100) NULL DEFAULT NULL AFTER `id`, ADD `role_id` INT NOT NULL DEFAULT '0' AFTER `user_id`;
ALTER TABLE `users` ADD `username` VARCHAR(100) NULL DEFAULT NULL AFTER `email`;
ALTER TABLE `users` ADD `otp_generated_at` TIMESTAMP NULL DEFAULT NULL AFTER `status`;
ALTER TABLE `users` ADD `otp` VARCHAR(20) NULL DEFAULT NULL AFTER `status`;
ALTER TABLE `users` ADD `pass_hint` VARCHAR(255) NULL DEFAULT NULL AFTER `password`;
ALTER TABLE `users` ADD `image` VARCHAR(300) NULL DEFAULT NULL AFTER `status`;
ALTER TABLE `users` ADD `state` VARCHAR(100) NULL DEFAULT NULL AFTER `is_mobile_verified`, ADD `city` VARCHAR(100) NULL DEFAULT NULL AFTER `state`, ADD `pincode` VARCHAR(100) NULL DEFAULT NULL AFTER `city`, ADD `address` VARCHAR(400) NULL DEFAULT NULL AFTER `pincode`;

## Above Done
## create column in users 29-Jan-25

ALTER TABLE `users` ADD `hospital_type` VARCHAR(100) NULL DEFAULT NULL AFTER `type`;
ALTER TABLE `category` ADD `is_top` INT NOT NULL DEFAULT '0' AFTER `type`;
ALTER TABLE `users` ADD `device_id` VARCHAR(455) NULL DEFAULT NULL AFTER `otp_generated_at`;


## create column in users 04-Feb-25
ALTER TABLE `users` ADD `symptom_id` VARCHAR(300) NULL DEFAULT NULL AFTER `category_id`;
ALTER TABLE `users` ADD `description` TEXT NULL DEFAULT NULL AFTER `device_id`;
ALTER TABLE `users` ADD `experience` VARCHAR(100) NULL DEFAULT NULL AFTER `qualification`;

## create column in users 08-Feb-25
CREATE TABLE doctor_slots (  
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
    doctor_id BIGINT NOT NULL,  
    date DATE NOT NULL,  
    start_time TIME NOT NULL,  
    end_time TIME NOT NULL,  
    slot_duration INT NOT NULL,  
    status ENUM('available', 'unavailable', 'booked') DEFAULT 'unavailable',  
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  
);  

## create table in users 23-Feb-25
CREATE TABLE doctor_schedules (  
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
    doctor_id BIGINT UNSIGNED NOT NULL,  
    date DATE NOT NULL,  
    start_time TIME DEFAULT NULL,  
    end_time TIME DEFAULT NULL,  
    status ENUM('available', 'unavailable') DEFAULT 'available',  
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
    
);

## create column in users 03-Mar-25
ALTER TABLE `users` ADD `short_description` TEXT NULL DEFAULT NULL AFTER `device_id`;
ALTER TABLE `users` ADD `price` DECIMAL NOT NULL DEFAULT '0' AFTER `experience`;





