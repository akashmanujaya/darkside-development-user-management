# Darkside Development User Management System

## Overview

The Darkside Development User Management System is a web application developed in Laravel and Vue.js, designed to run in a Docker environment. It offers robust user management functionalities including user creation, updating, and listing.

## Requirements

### Packages and Ports

- **Docker Environment**
  - PHP: 8.2.0
  - MySQL: 8.0
  - Node.js: >= 16.20.2 (LTS)
  - Composer: >= 2.6.6

- **Exposed Ports**
  - 8000: Application
  - 5173: Node.js
  - 3306: MySQL

### Dependencies

- **Backend (PHP/Laravel)**
  - `laravel/framework`: ^10.10
  - `laravel/sanctum`: ^3.3
  - `guzzlehttp/guzzle`: ^7.2
  - Other dependencies as specified in `composer.json`

- **Frontend (Vue.js)**
  - `vue`: ^3.4.5
  - `vue-router`: ^4.2.5
  - `vee-validate`: ^4.12.4
  - Other dependencies as specified in `package.json`

## Installation Steps Using Docker

1. **Clone the Repository**
   ```bash
   git clone https://github.com/akashmanujaya/darkside-development-user-management.git
   cd darkside-development-user-management
   ```

2. **Build and Start Docker Containers**
   ```bash
   docker-compose up -d --build
   ```

3. **Wait for the Build to Complete**

4. **Run NPM Development**
   ```bash
   npm run dev
   ```

5. **Access the Application**
   - URL: `http://0.0.0.0:8000/`

## Backoffice Logic and Flow

The backoffice of the Darkside Development User Management System is dedicated to managing customer data. It is structured to ensure scalability, maintainability, and a clear separation of concerns. Below is an overview of its architecture and how it handles customer-related functionalities.

### Key Functionalities

- **Customer Management**: Central to the system, this feature includes creating, updating, retrieving, and deleting customer information. It ensures data integrity and provides robust management capabilities.

- **Data Validation**: Rigorous validation rules are in place to ensure the integrity and correctness of customer data before it is processed or stored.

- **Authentication and Authorization**: Secures access to customer data, allowing only authorized personnel to perform sensitive operations.

### Architectural Flow

1. **Controllers (CustomerController)**: Act as the entry point for handling HTTP requests related to customer operations. They process incoming data, apply validation, and delegate business logic to the service layer.

2. **Services (CustomersService)**: Contain the business logic specific to customer operations. They interact with repositories for data access and enforce business rules.

3. **Repositories (CustomersRepository)**: Provide an abstraction layer over data access, enabling interaction with the database. They are used by services to perform CRUD operations on customer data.

4. **Models (Customer)**: Represent the data structure for customers, defining properties and relationships. Used by repositories to interact with the database using Eloquent ORM.

5. **Migrations & Seeders**: Handle database schema changes (migrations) and initial data loading (seeders), ensuring that the database structure is consistently maintained.

6. **Exceptions (CustomersNotFoundException)**: Custom exception handling specific to customer operations, enhancing error management and debugging.

7. **Requests (CustomersCreationRequest, CustomersUpdateRequest)**: Specialized request classes that encapsulate validation logic for customer creation and updating operations.

### Technologies and Libraries

- **Laravel**: Utilized for its robust ecosystem, providing a framework for structuring the application and handling various aspects like routing, sessions, and caching.
- **Eloquent ORM**: Used for database interactions, offering an elegant Active Record implementation for working with customer data.
- **Vue.js**: In the frontend, Vue.js is employed to create a reactive and engaging user interface for customer management.

This backoffice architecture ensures that the customer management system is efficient, reliable, and easy to maintain. The use of Laravel and its ecosystem provides a solid foundation for building scalable and secure web applications.


## Technology Choices

- **Backend:** Laravel for robust server-side functionalities.
- **Frontend:** Vue.js for dynamic user interfaces.
- **Containerization:** Docker for consistent deployment and development environments.
- **Database:** MySQL for reliable data storage and management.

## Running the Solution and Tests in Linux

- Ensure Docker and Docker Compose are installed.
- Clone the repo and run `docker-compose up -d --build`.
- Access the application at `http://0.0.0.0:8000/`.
- Run tests with `docker-compose exec app php artisan test`.