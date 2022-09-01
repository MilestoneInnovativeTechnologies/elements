

Step by step procedure to setup development environment..

cmd with Admin Privilege
Goto D:\htdocs\InventoryProject
laravel New <ProjName>
Ex: `laravel New Firose`

Open file C:\Windows\System32\drivers\etc\hosts
Add a line
127.0.0.1       ele<name>
Ex:
127.0.0.1       elefirose
Save file

Open file C:\Program Files\Apache24\conf\extra\httpd-vhosts.conf
Add following lines
<VirtualHost *:80>
ServerName ele<name>
DocumentRoot "D:/htdocs/InventoryProject/<ProjName>/public"
</VirtualHost>
Ex:
<VirtualHost *:80>
ServerName elefirose
DocumentRoot "D:/htdocs/InventoryProject/Firose/public"
</VirtualHost>

restart apache server
httpd -k restart

visit http://ele<name> using browser, Ex: http://elefirose
If laravel page views properly, Laravel setup is completed..

=====================================================

Using cmd
Get into the laravel project folder
Ex: `cd D:\htdocs\InventoryProject\Firose`
create folder milestone, and get into it, then clone project files from repository
`mkdir milestone`
`cd milestone`
`git clone https://github.com/MilestoneInnovativeTechnologies/elements.git`

Add to laravel root composer.json
autoload
"files": ["milestone/elements/helpers.php"]
autoload > psr-4
"Milestone\\Elements\\": "milestone/elements/src/"

Add to config > app > providers
\Milestone\Elements\ElementsServiceProvider::class,

Correct config > app > timezone Ex: Asia/Kolkata
Create Database and set details in env file
Run from root laravel project folder
composer dump-autoload
php artisan migrate:fresh

=====================================================
