
# 3. Create pages
## 3.4 generate the static pages
```
php artisan make:controller StaticPagesController
```

some error:
```
Target class [StaticPagesController] does not exist.
```
报错是 StaticPagesController 类未找到。我们还需要前往路由的服务提供者类中设置命名空间：
```
app/Providers/RouteServiceProvider.php

add:
protected  $namespace =  'App\\Http\\Controllers'; 
```