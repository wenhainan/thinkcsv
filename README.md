# think-addons
The ThinkPHP6 Auth Package

## 官网 
http://www.waytomilky.com/

## 安装
> composer require wenhainan/csv

## 配置
### 公共配置
```
// auth配置  自定义数据表位置在 ./config/auth.php里面
[
    'auth_on'           => 1, // 权限开关
    'auth_type'         => 1, // 认证方式，1为实时认证；2为登录认证。
    'auth_group'        => 'think_auth_group', // 用户组数据不带前缀表名
    'auth_group_access' => 'think_auth_group_access', // 用户-用户组关系不带前缀表名
    'auth_rule'         => 'think_auth_rule', // 权限规则不带前缀表名
    'auth_user'         => 'user', // 用户信息表不带前缀表名,主键自增字段为id
],
```

# 交流qq群
606645328

### 使用
```
    $header = ['姓名', '性别', '手机号'];
        $data = [
            ['小明', '男', 17699019191],
            ['小红', '男', 17699019191],
            ['小黑', '女', 17699019191],
            ['小白', '女', 17699019191],
        ];
        $csv = new Csv('1.csv',$header,$data);
        $csv->export();
```


