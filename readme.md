# Entryshop admin

主要功能

- 基础后端模板
- Model 增删改查
- 丰富的页面组件
- 自动配置路由

### 安装

将仓库添加到 composer.json

```
"repositories": [
    {
      "type": "vcs",
      "url": "git@github.com:entryshop/admin.git"
    }
]
```

添加依赖

```
composer require entryshop/admin
```

发布资源

```
php artisan vendor:publish --tag=admin-assets
```

### 配置

在 AppServiceProvider 中添加

```php
public function boot()
{
    admin()
        ->registerAuthRoutes() // 注册后台路由
        ->brandName('EntryShop') // 设置品牌名称
        ->logo(asset('/images/logo-dark.png')) // 设置logo
        ->miniLogo(asset('/images/logo-dark-sm.png')) // 设置miniLogo
        ->csp(csp_nonce()); // 设置csp nonce
}
```

### 基本使用(示例: 文章增删改查)

这个示例会演示文章的增删改查功能

- 数据库表

```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title')->nullable();
    $table->string('image')->nullable();
    $table->string('status')->nullable();
    $table->text('content')->nullable();
    $table->foreignId('user_id')->nullable();
    $table->boolean('published')->nullable();
    $table->text('attachments')->nullable();
    $table->timestamps();
});
```

- 模型 `App\Models\Post`
- 设置路由 `routes/web.php`

```php
admin()->routeGroup(function () {
    Route::crud('posts', PostController::class);
});
```

- 语言文件 `resources/lang/zh-CN/post.php`
```php
return [
    'label'       => '文章',
    'labelPlural' => '文章',
    'title'       => '文章标题',
    'content'     => '文章内容',
    'image'       => '封面',
    'tags'        => '标签',
    'user_id'     => '作者',
];
```

- 控制器 `App\Http\Controllers\Admin\PostController`

```php
use App\Models\Post;use Entryshop\Admin\Http\Controllers\CrudController;use Entryshop\Admin\Http\Controllers\Traits\CanCrud;

class PostController extends CrudController
{
    use CanCrud;

    // 模型
    public $model = Post::class;
    // 路由前缀
    public $route = 'posts';
    // 语言文件
    public $lang = 'post';

    // 获取列表前执行, 可以设置表格信息
    public function beforeIndex()
    {
        // 上方增加创建按钮
        $this->crud()->button('create')->top('top_create');
        // 上方自定义按钮
        $this->crud()->button('create')->top()
            ->color('danger')
            ->href('#')
            ->label('自定义');
            
        /**  添加表格字段 */
        // 标题
        $this->crud()->column('title'); 
        
        //状态
        $this->crud()->column('status')->select([
            'draft'     => 'Draft',
            'published' => 'Published',
            'archived'  => '归档',
            'unknown'   => '未知',
        ])->colors([
            'draft'     => 'warning',
            'published' => 'success',
            'archived'  => 'dark',
            '_default'  => 'primary-subtle',
        ]);
        
        // 图片
        $this->crud()->column('image')->type('image')->height(20);

        /**  行操作按钮 */
        // 编辑
        $this->crud()->button()->inline('inline_edit');
        // 自定义(功能和上面的编辑一致)
        $this->crud()->button()->inline('inline_action')
            ->label(__('admin::crud.edit'))
            ->icon('ri-edit-line')
            ->href($this->crud()->path("{row.id}/edit"));
            
        // 删除
        $this->crud()->button()->inline('inline_delete');
        // 自定义(功能和上面的删除一致)
        $this->crud()->button()->inline('inline_action')
            ->label(__('admin::crud.delete'))
            ->color('ghost-danger')
            ->icon('ri-delete-bin-line')
            ->confirm(__('admin::crud.delete_confirm')) // 删除确认
            ->method('delete')                          // 删除动作 HTTP 方法
            ->action($this->crud()->path("{row.id}"));  // 删除动作 url
    }
    
    
    // 设置表单信息，适用于 create 和 edit
    public function beforeForm()
    {
        $this->crud()->field('name')
            ->label(__('admin::post.title')) // 设置 label
            ->type('text')                   // 设置类型
            ->rules('required|min:3');       // 设置验证规则
    }
}
```
