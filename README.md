# School System Managment

## Requirements

Make sure you have the following requirements installed:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- [Node.js](https://nodejs.org/) and [npm](https://www.npmjs.com/) for handling frontend packages.

## Environment Setup

1. **Clone the repository:**

    ```bash
    git clone https://github.com/johnjairo594/school-system-managment
    cd your-project
    ```
2. **Start Docker containers:**
    
    ```bash
    docker-compose up --build
    ```

3. **Enter the php container:**

    Run `docker ps` to see php container name, and run `docker exec -it container-name bash` to enter the container

4. **Copy the environment file:**

    ```bash
    cp .env.example .env
    ```

5. **Edit the `.env` file with your application-specific configuration.**

6. **Generate the application key:**

    ```bash
    docker-compose run --rm app php artisan key:generate
    ```

7. **Install Composer dependencies:**

    ```bash
    docker run --rm -v $(pwd):/app composer install
    ```

8. **Install npm dependencies:**

    ```bash
    docker-compose run --rm node npm install
    ```

9. **Run migrations and seeders:**
    ```
   php artisan migrate
   php artisan db:seed --class=RolesAndPermissionsSeeder
   php artisan db:seed --class=SubjectSeeder
   ```
## Frontend config
- Outside the container, at the root of the project run `npm install`, `npm run build` and `npm run dev`

The application is hosted on localhost 8080 (indicated by docker compose.yaml), you must register users to start using the application

