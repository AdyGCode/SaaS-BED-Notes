---
created: 2025-03-11T10:41
updated: 2025-03-11T10:49
---

```shell

cd storage/

mkdir -p framework/{cache/data,sessions,testing,views}

chmod -R 755 framework

touch framework/{cache/data,sessions,testing,views}/.gitignore

echo "compiled.php
config.php
down
events.scanned.php
maintenance.php
routes.php
routes.scanned.php
schedule-*
services.json" > framework/.gitignore

echo "*  
!data/  
!.gitignore" > framework/cache/.gitignore

echo "*  
!.gitignore" > framework/cache/data/.gitignore

echo "*  
!.gitignore" > framework/sessions/.gitignore

echo "*  
!.gitignore" > framework/views/.gitignore

```
 