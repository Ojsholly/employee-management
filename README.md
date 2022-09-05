# Employee Management System Backend Implementation

## Project Description

The project is a collection of role and permissions based access to the management of employees by a super admin and other admins. 

## Project Setup

### Cloning the GitHub Repository.

Clone the repository to your local machine via https by running the terminal command below.

```bash
git clone https://github.com/Ojsholly/employee-management.git
```

### Setup Database

Create your MySQL database and note down the required connection parameters. (DB Host, Username, Password, Name)

### Install Composer Dependencies

Navigate to the project root directory via terminal and run the following command.

```bash
composer install
```

### Create a copy of your .env file

Run the following command

```bash
cp .env.example .env
```

This should create an exact copy of the .env.example file. Name the newly created file .env and update it with your local environment variables (database connection info, stateful domains and others).

### Generate an app encryption key

```bash
php artisan key:generate
```

### Run database migrations and seeders

```bash
php artisan migrate --seed
```

### Access Application

```bash
php artisan serve
```

***Kindly note that the super admin has a login credentials of 'superadmin@admin.com' and 'password'


### Run Tests

```bash
php artisan test
```

### License

[MIT](https://choosealicense.com/licenses/mit/)
