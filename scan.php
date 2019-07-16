<?php
/**
 * Created by PhpStorm.
 * User: yuexin
 * Date: 2019/7/16
 * Time: 15:36
 */
// 使用composer自动加载器
require 'vendor/autoload.php';
// 实例化http客户端
$client = new GuzzleHttp\Client();
// 打开并迭代处理CSV
$csv = League\Csv\Reader::createFromPath($argv[1]);

foreach ($csv as $csvRow) {
    try{
        // 发送HTTP 请求
        $httpResponse = $client->get($csvRow[0]);

        if ($httpResponse->getStatusCode() > 400) {
            throw new Exception();
        }
    } catch (Exception $e) {
        echo $csvRow[0] . PHP_EOL;
    }
}