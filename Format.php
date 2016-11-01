<?php
class Format
{
    public function getOrdinaryRails($list, $hide = false)
    {
        $resString = '';
        foreach ($list as $info) {
            if ($this->isEmpty($info['yw_num']) && $this->isEmpty($info['rz_num']) && $this->isEmpty($info['yz_num'])) {
                continue;
            }
            $resString .= str_pad($info['station_train_code'], 8, ' ');
            $resString .= "    硬卧 ";
            $resString .= str_pad($info['yw_num'], 10 - mb_strlen($info['yw_num']), ' ');
            $resString .= "    软座 ";
            $resString .= str_pad($info['rz_num'], 10 - mb_strlen($info['rz_num']), ' ');
            $resString .= "    硬座 ";
            $resString .= str_pad($info['yz_num'], 10 - mb_strlen($info['yz_num']), ' ');
            $resString .= "    ";
            $resString .= $info['start_time'];
            $resString .= "发 ";
            $resString .= $info['arrive_time'];
            $resString .=  "到  历经";
            $resString .= $info['lishi'];
            $resString .=  PHP_EOL;
        }
        if ($hide) {
            return $resString;
        }
        echo $resString;
    }
    public function gethighRails($list, $hide = false)
    {
        $resString = '';
        foreach ($list as $info) {
            if ($this->isEmpty($info['ze_num'])) {
                continue;
            }
            $resString .= str_pad($info['station_train_code'], 8, ' ');
            $resString .=  "    二等座 ";
            $resString .=  str_pad($info['ze_num'], 10 - mb_strlen($info['ze_num']), ' ');
            $resString .=  "    ";
            $resString .= $info['start_time'];
            $resString .= "发 ";
            $resString .= $info['arrive_time'];
            $resString .=  "到  历经";
            $resString .= $info['lishi'];
            $resString .=  "    ";
            $resString .=  PHP_EOL;
        }
        if ($hide) {
            return $resString;
        }
        echo $resString;
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

    private function isEmpty($num)
    {
        return in_array($num, ['--', '无']);
    }
}
