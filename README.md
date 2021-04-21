# 处理CSV
导入,导出,读取

## 官网 
http://www.waytomilky.com/

## 安装
> composer require wenhainan/thinkcsv

# 交流qq群
 `606645328`

### 使用
```
    $header = ['姓名', '性别', '手机号'];
        $data = [
            ['小明', '男', 17699019191],
            ['小红', '男', 17699019191],
            ['小黑', '女', 17699019191],
            ['小白', '女', 17699019191],
        ];
        $csv = new thinkcsv('1.csv',$header,$data);
        $csv->export();
```


