<p align="center">
  <img src="https://www.php.net/images/logos/new-php-logo.png" alt="Sublime's custom image"/>
</p>

<h1 style="text-align: center; font-weight: bold">VANILLA PHP MVC</h1>

## [Veja em Português](README.PTBR.md)

---

# DIRECTORY STRUCTURE
```
├───app
│   ├───controllers      contains Web controller classes
│   ├───db               contains database class
│   ├───http             contains Web manager classes
│   ├───manager          contains abstracts classes for Controllers, Models, etc.
│   ├───models           contains model classes
│   ├───script           contains scripts to configure your development environment
│   └───widgets          contains widgets do be used on views
├───config               contains application configurations 
├───src
│   ├───assets           contains Web resources
│   └───views            contains view files for the Web application
└───tests                contains tests for the basic application
```

This repository has two Models:
- `User`
- `Debt`

This repository has three Controllers:
- `SiteController` main controller that displays the `home page` and `profile page`.
- `DebtController` controller that manages the `Debt` Model.
- `AuthController` controller responsible for `Login` and `Logout`.

## Usage

---

### Models

- If you want to create more `Models` just create a new class that extends `app\manager\Model` and define the properties inside the body of the class along with their respective `Get's` and `Set's`.
- To assign values ​​to all properties at once use `$yourModel->load(array $content)`, recommended to do this in controllers to be more practical.
  - Example:
    ```php
    public static function actionSave() {
        /** @var app\http\Request $request */
        $request = self::getRequest();

        $model = new ExampleModel();

        if($request->isPost()) {
            $model->load($request->post());
            $new = $model->isNewRecord();
            if($model->save()) {
                if($new) {
                    self::setFlash('success', 'Created successful!');
                } else {
                    self::setFlash('success', 'Updated successful!');
                }

                self::redirect('/example/index');
            }
        }

        return self::render('form', [
            'model' => $model
        ]);
    }
    ```
- Override the `validate()` function to create the model validation that is performed in `save()`. For each error found use `setError('key', 'value')` to log it. The error will appear on the user's screen in the output of the `app\widgets\Alert::run()` widget.

### Controllers

- If you want to create more `Controllers` just create a new class that extends `app\manager\Controller` and create their actions inside the body of the class. It is **important** that all routes start with `action` and be `static`! Example: `public static function actionIndex()`

- To render a page use inside the controller: `self::render('page');` without `.php`
  - The files are rendered from the `src/views` directory and the folder where `page.php` is located has the **same** controller name using a dash (`-`) between the words.
    - Example: if the controller name is `HomePageController` the folder name will be `home-page`.
- To pass parameters to the rendered page pass as second parameter.
  - Example: 
    ```php
      public static function actionIndex() {
          return self::render('home', [
              'title' => 'Home Page'
          ]);
      }
    ```
- To render another page already inside a page use the `app\manager\View` class for this.
  - Example:
    ```php
    /** filename without .php */
    <?= View::render('folder', 'file') ?>
                    or
    <?php echo View::render('folder', 'file') ?>
    ```
  - Important to remember that all pages are rendered from `src/views`, so if `'folder'` and `'file'` were passed as parameters, it is understood that the file to be rendered is located at: `src /views/folder/file.php`.
- To redirect the user to a new page use in the controller: `self::redirect('/new/page')`.
- To display a feedback message to the user use in the controller: `self::setFlash('type', 'message')`.
  - Available types: `danger`, `success`, `info` and `warning`.
  - See above how to use it.
  - Use `app\widgets\Alert::run()` to display the alert on the page.
  - To register your route so that all users can access it go to `/index.php`:
    - create an instance `$router = new app\http\Router;`
    - use `$router->get()`, `$router->post()`, `$router->put()` or `$router->delete()` to define the method type.
    - 
    - ```php
      $router = new Router();

      // DebtController

      /**
       * - Method POST
       * - Receive param {id}
       * - DebtController and action Delete respectively
       * - Only logged users can access this route
       * 
       * @ = logged
       * ? = guest
       * 
       * ignore `rules` will set ['@', '?'] as the default value
       */
      $router->post('debt/{id}/delete', 'debt/delete', ['rules' => '@']);
      ```

## Installation

```
0. Recommended use of `XAMPP` or some similar program.
1. Clone this repository and place it in your "htdocs" folder (or where you render your projects).
2. Create a database (preferably in MySQL).
3. Run the script located in `script/database.sql`.
4. Copy the content into `script/httpd-vhost.conf` and place it in your `httpd-vhost.conf` or your VirtualHost configuration file.
5. Restart Apache.
6. Put your database information in `config/main.php`.
7. Run `php composer update` on terminal.
8. Go to `http://mvc.localhost`.
9. Done!
```

## Test

```bash
composer run test
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)