# 处理CSV类库 thinkcsv
csv导入,导出,读取

## 官网 
http://www.waytomilky.com/

## 安装
> composer require wenhainan/thinkcsv

# 交流qq群
 `606645328`

### 使用
```
    //引入 
    use think\wenhainan\Thinkcsv;
    
    //浏览器渲染导出csv
    $header = ['姓名', '性别', '手机号'];
    $data = [
        ['小明', '男', 17699019191],
        ['小红', '男', 17699019191],
        ['小黑', '女', 17699019191],
        ['小白', '女', 17699019191],
    ];
    //浏览器访问渲染下载
    $csv = new Thinkcsv('demo.csv',$header,$data);
    $csv->export();
    
    //后端执行,无需浏览器访问,本例文件生成在   /网站根目录/upload/demo.csv
    $csv = new Thinkcsv('upload/demo.csv',$header,$data);
    $csv->csvtoFile();
    
    //读取文件 $filepath文件路径
    $filepath = 'public/demo.csv';
    $data = Thinkcsv::readCsvData($filepath);
```


