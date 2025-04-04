# Mongo DB PHP Example

This repository provides a foundational PHP application that demonstrates how to integrate MongoDB into a custom PHP framework. Created for students at a secondary IT school, this project is a starting point for learning the basics of routing, modeling, and view rendering (via Blade templates) in a PHP environment connected to MongoDB.

## Overview

The aim is to give students a hands-on introduction to the key concepts involved in building PHP applications that interact with MongoDB. The simple framework included here shows:

- **Basic Routing:** Understand how requests are mapped to specific controller actions.
- **Model Functionality:** Learn how to define and interact with MongoDB documents via PHP models.
- **Blade Templates:** Explore how to render views using the popular Blade templating engine.

By experimenting with and expanding on this codebase, students can build a more complex application that utilizes MongoDB as a flexible, schema-less data store.

## Key Features

- **Custom PHP Framework:**  
  A simple, custom framework that helps you understand how frameworks work under the hood.
  
- **Routing:**  
  A basic routing mechanism to handle incoming requests and map them to the appropriate controllers.
  
- **Models & MongoDB Integration:**  
  A model layer that interacts with a MongoDB database. Students can learn how to perform CRUD operations and handle data in a non-relational environment.
  
- **Blade Templating:**  
  Blade templates make it easy to separate logic from presentation, ensuring cleaner, more maintainable code.

## Requirements

- **PHP 8.1 or newer:**  
  Ensure PHP is installed and running on your system.
  
- **Composer:**  
  Needed for installing dependencies.
  
- **MongoDB & PHP MongoDB Extension:**  
  Install and run a MongoDB server. Also, make sure the PHP MongoDB extension is enabled. Refer to the [official MongoDB PHP Driver documentation](https://www.mongodb.com/docs/drivers/php/) for details.

## Getting Started

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/kukivac/mongo-db-php.git
   cd mongo-db-php
   ```

2. **Install Dependencies:**
   Use Composer to install required packages:
   ```bash
   composer install
   ```

3. **Configuration:**
   - Copy the `.env.example` file to `.env` and update the MongoDB connection details (host, port, database name).
   - Ensure your MongoDB server is running and accessible with the credentials provided in the `.env` file.

4. **Run the Application:**
   Start the built-in PHP server:
   ```bash
   php -S localhost:8000 -t public
   ```
   
   Open your browser and navigate to:
   ```
   http://localhost:8000
   ```

   You should see the basic application running.

## Next Steps for Students

- **Expand the Framework:**  
  Add additional routes and controllers to handle more complex logic.
  
- **Work with Models:**  
  Create new models to represent different data entities and learn how to query, insert, update, and delete documents in MongoDB.
  
- **Blade Templates:**  
  Enhance the frontend by creating dynamic views, partials, and layouts, and by passing data from controllers to views.

- **Implement Authentication or Validation:**  
  Consider adding user authentication, input validation, or other features to make the app more realistic and robust.

## Contributing

While this project is primarily for educational purposes, contributions are welcome. Feel free to open issues or submit pull requests if you find improvements or additional examples that can enhance the learning experience.

## License

This project is provided under the [MIT License](LICENSE).

---

*This example app provides a stepping stone for students to explore PHP frameworks, MongoDB integration, and Blade templating, serving as a practical tool to develop real-world web development skills.*  
