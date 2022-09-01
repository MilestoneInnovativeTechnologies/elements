

Step by step procedure to setup development environment..<br>

cmd with Admin Privilege<br>
Goto `cd D:\htdocs\InventoryProject`<br>
laravel New &lt;ProjName>
Ex: `laravel New Firose`<br><br>

Open file C:\Windows\System32\drivers\etc\hosts<br>
Add a line<br>
127.0.0.1       ele&lt;name><br>
Ex:<br>
127.0.0.1       elefirose<br>
Save file<br><br>

Open file C:\Program Files\Apache24\conf\extra\httpd-vhosts.conf<br>
Add following lines<br>
&lt;VirtualHost *:80><br>
ServerName ele&lt;name><br>
DocumentRoot "D:/htdocs/InventoryProject/&lt;ProjName>/public"<br>
&lt;/VirtualHost><br>
Ex:<br>
<VirtualHost *:80><br>
ServerName elefirose<br>
DocumentRoot "D:/htdocs/InventoryProject/Firose/public"<br>
&lt;/VirtualHost><br><br>

restart apache server<br>
httpd -k restart<br>

visit http://ele&lt;name&gt; using browser,<br>
Ex: http://elefirose<br>
If laravel page views properly, Laravel setup is completed..<br><br>

=====================================================<br><br>

Using cmd<br>
Get into the laravel project folder<br>
Ex: `cd D:\htdocs\InventoryProject\Firose`<br>
create folder milestone, and get into it, then clone project files from repository<br>
`mkdir milestone`<br>
`cd milestone`<br>
`git clone https://github.com/MilestoneInnovativeTechnologies/elements.git`<br><br>

Add to laravel root composer.json<br>
autoload<br>
`"files": ["milestone/elements/helpers.php"]`<br>
autoload > psr-4<br>
`"Milestone\\Elements\\": "milestone/elements/src/"`<br>

Add to config > app > providers<br>
`\Milestone\Elements\ElementsServiceProvider::class,`<br><br>

Correct config > app > timezone Ex: `Asia/Kolkata`<br>
Create Database and set details in env file<br>
Run from root laravel project folder<br>
`composer dump-autoload`<br>
`php artisan migrate:fresh`<br><br>

=====================================================<br><br>
