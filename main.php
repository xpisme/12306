<?php

$train = new train();
$url = 'https://kyfw.12306.cn/otn/leftTicket/queryT?leftTicketDTO.train_date=2016-10-17&leftTicketDTO.from_station=HDP&leftTicketDTO.to_station=BXP&purpose_codes=ADULT';

$res = json_decode($train->httpRequest($url), true);
$train->getAvailable($res['data']);

class train
{
    private $highRails;   

    public function getAvailable($list)
    {
        $availableList = [];
        foreach ($list as $info) {
            if ($info['queryLeftNewDTO']['canWebBuy'] == 'Y') {
                $ze_num = $info['queryLeftNewDTO']['ze_num'];
                $yw_num = $info['queryLeftNewDTO']['yw_num'];
                $rz_num = $info['queryLeftNewDTO']['rz_num'];
                $yz_num = $info['queryLeftNewDTO']['yz_num'];
                if ($this->isEmpty($ze_num) && $this->isEmpty($yw_num) && $this->isEmpty($rz_num) && $this->isEmpty($yz_num)) {
                    continue;
                }
                echo str_pad($info['queryLeftNewDTO']['station_train_code'], 10, ' ');
                echo "      二等座";
                echo str_pad($ze_num, 10, ' ');
                echo "      硬卧 ";
                echo str_pad($yw_num, 10, ' ');
                echo "      软座 ";
                echo str_pad($rz_num, 10, ' ');
                echo "      硬座 ";
                echo str_pad($yz_num, 10, ' ');
                echo "      ";
                print_r($info['queryLeftNewDTO']['start_time']);
                echo "      ";
                print_r($info['queryLeftNewDTO']['arrive_time']);
                echo "      ";
                print_r($info['queryLeftNewDTO']['lishi']);
                echo PHP_EOL;
            }
        }
    }


    public function httpRequest ($url, $postData = false)
    {
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        if ($postData) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }
        $header = [
            'CLIENT-IP:'. $this->getIp(),
            'X-FORWARDED-FOR:'.$this->getIp(),
        ];
        curl_setopt($ch, CURLOPT_HEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '200') {
            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $headerSize);
            $response = substr($response, $headerSize);
        }
        curl_close($ch);
        return $response;
    }

    private function getIp()
    {
        return mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255);
    }

    private function isEmpty($num)
    {
        return in_array($num, ['--', '无']);
    }

    private function getSeatName($key)
    {
        $data = [
            'swz_num' => '商务座',
            'tz_num' => '特等座',
            'zy_num' => '一等座',
            'ze_num' => '二等座',
            'gr_num' => '高级软卧',
            'rw_num' => '软卧',
            'yw_num' => '硬卧',
            'rz_num' => '软座',
            'yz_num' => '硬座',
        ];
        return $data[$key];
    }
}
