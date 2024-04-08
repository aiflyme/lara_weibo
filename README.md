
# 3. Create pages
## 3.4 generate the static pages
```
php artisan make:controller StaticPagesController
```

```
Route::get('/', [StaticPagesController::class, 'home']);
Route::get('/help', [StaticPagesController::class, 'help']);
Route::get('/about', [StaticPagesController::class, 'about']);
```

## 3.6 Php artisan
|命令	|说明|
| ----------- | ----------- |
|php artisan make:controller| 	生成控制器|
|php artisan make:model	| 生成模型|
|php artisan key:generate| 	生成 App Key|
|php artisan make:policy| 	生成授权策略|
|php artisan make:seeder| 	生成 Seeder 文件|
|php artisan migrate	| 执行迁移|
|php artisan migrate:rollback	| 回滚迁移|
|php artisan migrate:refresh	| 重置数据库|
|php artisan db:seed	| 填充数据库|
|php artisan tinker	| 进入 tinker 环境|
php artisan route:list	| 查看路由列表|