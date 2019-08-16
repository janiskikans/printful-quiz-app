## Quiz Aplikācijas sagatavošana

1. Lejupielādēt printful-quiz-app repositoriju uz servera izmantojot kodu:
    ```cmd
    git pull https://github.com/janiskikans/printful-quiz-app.git
    ```
2. Sagatavot MySQL datu bāzi importējot mapē **sql_dump** atrodamo failu **quizzes.sql**.

3. Pēc datu bāzes importēšanas, jāizveido mapē **src** konfigurācijas fails ar **config.php**, kas satur sekojošu informāciju. Konfigurācijas failā norādītie dati nemainīsies, ja tiks importēts pievienotais **quizzes.sql** fails. Ja datu bāzes credentials tiek mainīti, tad jāizmaina arī **config.php**  failā atrodamā datu bāzes konfigurācija.
    ```$php
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
   
  4. Done!