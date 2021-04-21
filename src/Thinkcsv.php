<?php
namespace think\wenhainan;
/**
 * Class Doc
 * Notes: 文档处理服务类
 * Auther: wenhainan
 * Email: whndeweilai@gmail.com
 * DateTime: 2020/3/15
 */
class Thinkcsv {
    public $filename;
    public $header;
    public $docdata;

    /**
     * Doc constructor.
     * @param $filename 文件名称
     * @param $header   表头数组
     * @param $docdata  数据数组
     */
    public function __construct($filename = '',array $header = [],array $docdata = [])
    {
        set_time_limit(0);
        ini_set('memory_limit', '256M');
        $this->filename = $filename;
        $this->header   = $header;
        $this->docdata  = $docdata;
    }

    /**
     * Notes:  导出csv
     * Auther: wenhainan
     * DateTime: 2021/3/15
     * Email: whndeweilai@gmail.com
     */
    function export()
    {
        //下载csv的文件名
        $fileName = $this->filename;
        //设置header头
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        //打开php数据输入缓冲区
        $fp = fopen('php://output', 'a');
//        $header = ['姓名', '性别', '手机号'];
        $header = $this->header;
        //将数据编码转换成GBK格式
        mb_convert_variables('GBK', 'UTF-8', $header);
        //将数据格式化为CSV格式并写入到output流中
        fputcsv($fp, $header);
//        $data = [
//            ['小明', '男', 17699019191],
//            ['小红', '男', 17699019191],
//            ['小黑', '女', 17699019191],
//            ['小白', '女', 17699019191],
//        ];
        $data = $this->docdata;
        //如果在csv中输出一个空行，向句柄中写入一个空数组即可实现
        foreach ($data as $row) {
            //将数据编码转换成GBK格式
            mb_convert_variables('GBK', 'UTF-8', $row);
            fputcsv($fp, $row);
            //将已经存储到csv中的变量数据销毁，释放内存
            unset($row);
        }
        //关闭句柄
        fclose($fp);
        die;
    }
    /**
     * 服务器存储csv,生成文件链接给到前端
     */
    public function csvtoFile(){
        $filename = ROOT_PATH."/public/".$this->filename;
        ini_set('memory_limit','512M');
        ini_set('max_execution_time',0);
        ob_end_clean();
        ob_start();
        header("Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        //header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=".$filename);
        @file_put_contents($filename,'');
        @chmod(0777,$filename);
        $fp=fopen($filename,'w');
        fwrite($fp, chr(0xEF).chr(0xBB).chr(0xBF));//转码 防止乱码(比如微信昵称(乱七八糟的))
        fputcsv($fp,$this->header);
        $index = 0;
        foreach ($this->docdata as $item) {
            if($index==1000){
                $index=0;
                ob_flush();
                flush();
            }
            $index++;
            fputcsv($fp,$item);
        }
        ob_flush();
        flush();
        ob_end_clean();
    }
    /**
     * Notes:  读取csv数据
     * Author: wenhainan
     * DateTime: 2021/4/12
     * Email: whndeweilai@gmail.com
     * @param $filePath
     * @return mixed
     */
    function getCsvData($filePath){
        $handle = fopen( $filePath, "rb" );
        $data = [];
        while (!feof($handle)) {
            $data[] = fgetcsv($handle);
        }
        fclose($handle);

        $data = eval('return ' . iconv('gb2312', 'utf-8', var_export($data, true)) . ';');	//字符转码操作

        return $data;
    }
    /**
     * Notes:  静态方法导入csv
     * Author: wenhainan
     * DateTime: 2021/4/12
     * Email: whndeweilai@gmail.com
     * @param $filePath
     * @return mixed
     */
    static function readCsvData($filePath){
        $handle = fopen( $filePath, "rb" );
        $data = [];
        while (!feof($handle)) {
            $data[] = fgetcsv($handle);
        }
        fclose($handle);

        $data = eval('return ' . iconv('gb2312', 'utf-8', var_export($data, true)) . ';');	//字符转码操作

        return $data;
    }
}