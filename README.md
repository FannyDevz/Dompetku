# DompetKu

Dompetku is an application for managing income and expenditure history easily.

## Project Status

This project is actively under development.

## Installation

### Prerequisites

Make sure you have PHP Version 8.2+ and Composer installed on your machine before getting started.

### Installation Steps

1. Clone this repository to your local machine:

    ```bash
    git clone https://github.com/FannyDevz/dompetku.git
    ```

2. Navigate to the project directory:

    ```bash
    cd dompetku
    ```

3. Install dependencies using Composer:

    ```bash
    composer install
    ```

4. Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

5. Generate the application key:

    ```bash
    php artisan key:generate
    ```

6. Set up the database connection in the `.env` file.

7. Run migrations to create the database structure:

    ```bash
    php artisan migrate
    ```

8. (Optional) Run Seeders to add dummy data:

    ```bash
    php artisan db:seed
    ```
    Note : Username / Password = admin / password


9. Start the local server:

    ```bash
    php artisan serve
    ```

The project can now be accessed at [http://localhost:8000](http://localhost:8000).

## Feature
- [x] Mobile Support (PWA)
- [x] Login with Remember
- [x] Register
- [x] Logout 
- [x] Add Wallet / User 
- [x] Edit Wallet 
- [x] Delete Wallet 
- [x] RecycleBin Wallet 
- [x] Permanent Delete Wallet 
- [x] Restore Wallet 
- [x] Add Income
- [x] Add Outcome
- [x] Edit History Transaction
- [x] Delete History Transaction
- [x] Edit User
- [x] Report / Wallet with Periode
- [x] Add Category [Income / Outcome] / User
- [x] Edit Category [Income / Outcome]
- [x] Delete Category [Income / Outcome]
- [x] Import From XLSX
- [x] Preview Import XLSX
- [x] Template XLSX

## Contribution

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## License

This project is licensed under the [MIT](https://opensource.org/licenses/MIT). 

## Contact

For questions or further information, contact [Fanny](https://fanny.dev) at [fannybagus9f@gmail.com](fannybagus9f@gmail.com).
