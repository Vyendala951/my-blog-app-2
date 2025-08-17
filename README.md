# Laravel Admin Panel Assessment 2

**GitHub Repository**: [https://github.com/Vyendala951/my-blog-app-2](https://github.com/Vyendala951/my-blog-app-2)

## Approach

I used the given Laravel starter template and configured the development environment with the help of VS Code, Git, Composer, and XAMPP. I have made a MySQL database and set up the env file. The Laravel UI was installed to authenticate and then migrations executed and initial users seeded. There was the definition of admin routes with authentication middleware and route model binding of posts and categories. I have generated `Post` and `Category` models with relationships (`Post belongsTo Category/User`, `Category hasMany Posts`), migrations, factories and seeders to feed sample data. CRUD operations were achieved using controllers, and only available to a user with the role of an administrator. Blade view were created, extending `app.blade.php`, to list, create and edit posts and categories, create category dropdowns and a custom 404 page. Back-up route was introduced. Everything was tested, commits were made with explanatory messages and the project was pushed to GitHub.

## Challenges Faced

-   **Database Setup**: Resolved "unknown database" errors by creating the correct database in phpMyAdmin and updating `.env`.
-   **Migration Issues**: Fixed foreign key constraint errors by ensuring the `categories` migration runs before `posts` and dropping/recreating tables as needed.
-   **Seeder Namespace Errors**: Corrected by adding proper `use` statements for models like `Category`.
