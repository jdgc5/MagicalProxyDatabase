# Project Cards - Magical Proxy

This project is a web application for managing a database for your Magic The Gathering Cards. It allows creating, viewing, editing, and deleting cards, as well as managing their associated images.

## Technology 

**Laravel**: Powering the backend, it offers a secure and scalable foundation for the application.
**HTML, CSS (Bootstrap), and JavaScript**: These front-end technologies provide structure, styling, and interactivity for a user-friendly experience.

## Installation

1. Clone this repository on your local machine using `git clone`.
2. Run `composer install` to install PHP dependencies.
3. Copy the `.env.example` file and rename it to `.env`. Then configure your environment, including the database connection.
4. Run `php artisan key:generate` to generate a new application key.
5. Run `php artisan migrate` to migrate the database.

## Usage

### Functionalities

- **Create Cards**: Go to `/carta/create` and fill out the form to create a new card.
- **Edit Cards**: Click on the "Edit" button in the card details view to modify its details.
- **Delete Cards**: From the details view, use the "Delete" button to remove a card.
- **Update Image**: Image update option is available when editing a card. ( under development )

### Project Structure

- **Controllers**:
  - `CartasController`: Controls actions related to cards, including creation, editing, and deletion.
  - `SettingsController`: provides a straightforward way to manage and adjust the application's settings dynamically.

- **Views**:
  - `carta.index`: Displays all available cards in a list.
  - `carta.create`: Allows creating a new card.
  - `carta.edit`: Enables editing details of an existing card.
  - `carta.show`: Displays details of a specific card.

## Contributions

Contributions are welcome! Feel free to submit a pull request or open an issue to discuss new features or improvements.

## License

This project is licensed under the [MIT License](link).
