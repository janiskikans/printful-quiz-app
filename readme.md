## Quiz aplikācijas sagatavošana

1. Lejupielādēt printful-quiz-app repositoriju uz servera izmantojot kodu:
    ```cmd
    git pull https://github.com/janiskikans/printful-quiz-app.git
    ```
2. Sagatavot MySQL datu bāzi importējot mapē **sql_dump** atrodamo failu **quizzes.sql**.

3. Pēc datu bāzes importēšanas, jāizveido mapē **src** konfigurācijas fails ar nosaukumu **config.php**, kas satur zemāk redzamo informāciju, jeb PHP koda fragmentu. Ja datu bāzes tabulas tiks izveidotas izmantojot pievienoto **quizzes.sql** failu, tad jāmaina tikai **DB_USERNAME** un **DB_PASSWORD** parametri atbilstoši Jūsu MySQL uzstādījumiem. Ja datu bāzes tabulas tiek veidotas savādāk, tad atbilstoši jāizmaina arī **config.php**  failā atrodamie datu bāzes pārējie parametri.
   
   ```
   <?php
       
       // DB Config
       define('DB_DRIVER', 'mysql');
       define('DB_HOST', 'localhost');
       define('DB_DATABASE', 'quizzes');
       define('DB_USERNAME', 'homestead');
       define('DB_PASSWORD', 'secret');
       define('DB_CHARSET', 'utf8');
       define('DB_COLLATION', 'utf8_unicode_ci');
       define('DB_PREFIX', '');
   ```
   
  4. Tālāk ir nepieciešams veikt nepieciešamo **Composer** dependency instalēšanu palaižot projekta root mapē komandu
    
        ```
        composer install
        ```

  5. Kā arī jāveic nepieciešamo **npm** moduļu iegušana palaižot projekta root mapē komandu
  
      ```
      npm install
      ```
   
  6. Atliek palaist tikai serveri un done!
  
  ## Zināmās problēmas :bug:
 
  1. **Quiz History saraksta atjaunināšanās**
        * **Problēma:** _quiz-history.vue_ komponentē uzreiz pēc kārtējā quiz izpildes **neatjaunojas** izpildīto quiz vēsture. 
        * **Šī brīža risinājums:** Lai saraksts atjaunotos ir **nepieciešams atjaunināt lapu**.
        
  ## Izmantotie risinājumi
  
  * [Vue.js](https://vuejs.org/)
  * [Laravel Eloquent](https://laravel.com/docs/5.8/eloquent)
  * [Bootswatch Simplex](https://bootswatch.com/simplex/)
  * u.c.
