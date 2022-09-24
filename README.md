# Invoice
create .env file by copy contents from env

  uncomment follwing
  
  CI_ENVIRONMENT = development
  
  set app.baseURL (eg: app.baseURL = 'http://localhost/invoice/')
  
  set database details
  
    database.default.hostname = localhost
    database.default.database = invoice
    database.default.username = root
    database.default.password = 
    database.default.DBDriver = MySQLi
    database.default.DBPrefix =
    
Use contents in the file database for db creation 

Take url http://localhost/invoice/ in browser
