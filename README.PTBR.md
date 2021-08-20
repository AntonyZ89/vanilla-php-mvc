<p align="center">
  <img src="https://www.php.net/images/logos/new-php-logo.png" alt="Sublime's custom image"/>
</p>

<h1 style="text-align: center; font-weight: bold">VANILLA PHP MVC</h1>

## [See in English](README.md)

---

Este repositório possui dois Models: 
- `User`
- `Debt`

Este repositório possui três Controllers: 
- `SiteController` principal controlador que exibe a `página inicial` e `página de perfil`
- `DebtController` controlador que gerencia o Model `Debt`
- `AuthController` controlador responsável por `Login` e `Logout` do usuário

## Usage

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

### Models

- Se deseja criar mais `Models` basta criar uma nova classe que extenda `app\manager\Model` e definir as propriedades dentro do corpo da classe junto com seus respectivos `Get's` and `Set's`.
- Para atribuir valores em todas as propriedades de uma vez utilize `$yourModel->load(array $content)`, recomendável fazer isso nos controladores para ficar mais práticos.
  - Exemplo:
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
- Sobrescreva a função `validate()` para criar a validação do model que é executada em `save()`. Para cada erro encontrado use `setError('key', 'value')` para registra-lo. O erro aparecerá na tela do usuário na saída do widget `app\widgets\Alert::run()`.

### Controllers

- Se deseja criar mais `Controllers` basta criar uma nova classe que extenda `app\manager\Controller` e criar suas actions dentro do corpo da classe. É **importante** que todas as rotas iniciem por `action` e sejam `static`! Exemplo: `public static funtion actionIndex()`

- Para renderizar uma página use dentro do controller: `self::render('page');` sem `.php`
  - Os arquivos são renderizados a partir do diretório `src/views` e a pasta onde se localiza `page.php` possui o **mesmo** nome do controller utilizando um traço (`-`) entre as palavras.
    - Exemplo: se o nome do controlador é `HomePageController` o nome da pasta será `home-page`
- Para passar parâmetros para a página renderizada passe como segundo parâmetro.
  - Exemplo: 
    ```php
      public static function actionIndex() {
          return self::render('home', [
              'title' => 'Home Page'
          ]);
      }
    ```
- Para renderizar outra página já dentro de uma página utilize a classe `app\manager\View` para isso.
  - Exemplo:
    ```php
    /** filename without .php */
    <?= View::render('folder', 'file') ?>
                    or
    <?php echo View::render('folder', 'file') ?>
    ```
  - Importante lembrar que todas as páginas são renderizadas a partir de `src/views`, então se `'folder'` e `'file'` foram passados como parâmetros, entende-se que o arquivo a ser renderizado está localizado em: `src/views/folder/file.php`.
- Para redirecionar o usuário para uma nova página utilize no controlador: `self::redirect('/new/page')`.
- Para exibir uma mensagem de feedback para o usuário utilize no controlador: `self::setFlash('type', 'message')`. 
  - Tipos disponíveis: `danger`, `success`, `info` e `warning`.
  - Veja acima como utilizar.
  - Utilize `app\widgets\Alert::run()` para exibir o alerta na página.
  - Para registrar sua rota para que todos os usuários possam acessa-las vá até `/index.php`:
    - instancie `$router = new app\http\Router;`
    - use `$router->get()`, `$router->post()`, `$router->put()` ou `$router->delete()` para definir o tipo do método.
    - 
    - ```php
      $router = new Router();

      // DebtController

      /**
       * 
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
1. Clone este repositório e coloque-o na sua pasta "htdocs" ( ou aonde você renderiza seus projetos ).
2. Crie um banco de dados ( preferencialmente no MySQL ).
3. Execute o script localizado em `script/database.sql`.
4. Copie o conteúdo dentro de `script/httpd-vhost.conf` e coloque-o no seu `httpd-vhost.conf` ou em seu arquivo de configuração de VirtualHost.
5. Reinicie o Apache.
6. Coloque as informações do seu banco de dados em `config/main.php`.
7. Execute em seu terminal `php composer update`.
8. Acesse `http://mvc.localhost`.
9. Feito!
```

## Test

```bash
composer run test
```
## Contributing
Pull requests são bem-vindos. Para mudanças importantes, abra uma issue primeiro para discutir o que você gostaria de mudar.

Certifique-se de atualizar os testes conforme apropriado.

## License
[MIT](https://choosealicense.com/licenses/mit/)