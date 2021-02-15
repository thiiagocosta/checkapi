
<h1 align="center">CheckApi</h1>

### Description ###
Check API endpoint permissions.
Postman Archives compatibility(json).

### Install ###
1) Use PHP CLI ˆ7.4
2) Execute install.sh
3) Change variables in src/config.php

4) Create Folder in /projects:
   ./projects/MyAPI/

5) Past your Postman.json.

### Execute ###
Open your Terminal, access '/src' folder and run:
```bash
php console.php
```

### Export Result CSV ###
The file is created in your project folder 'DATETIME_result.csv'.
To export run:
```bash
php console.php export=true
```