## Laravel + InertiaJs learning project
Basic CRUD project for patients and medical pratices taken to learn the basics of Inertia.js. Basically you can see patients, create and update and see medical practices for one patient, create and update these.

### Using:
- Laravel 9 
- Inertia.jS
- VueJs 3
- Tailwind CSS

### How to run it

1. Clone the project.
2. Install composer dependencies as described on the docs for getting Laravel Sail up and running https://laravel.com/docs/9.x/sail#installing-composer-dependencies-for-existing-projects
3. Run `sail up`
4. Run `sail artisan migrate:fresh --seed`
5. Access https://localhost


### Models
#### Patient

| Field         | type |
|------------|------|
| id         | int  |
| age        | int  |
| blood_type | string    |

#### Practices

| Field         | type     |
|------------|----------|
| id         | int      |
| date        | datetime |
| duration | int      |
| patient_id | int      |


