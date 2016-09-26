<?php
class Arguments
{
    private static $cityList = [];

    public static function analyze($argv)
    {
        $start = ['BXP' => '北京西'];
        $end   = ['HDP' => '邯郸'];
        $date  = date('Y-m-d', strtotime('+1 days'));
        foreach ($argv as $v) {
            $tmpName = substr($v, 2);
            switch (strtolower($v{0})) {
                case 's':
                $start = [ self::getCity($tmpName) => $tmpName ];
                break;
                case 'e':
                $end = [ self::getCity($tmpName) => $tmpName ];
                break;
                case 'd':
                $date = self::getUseDate(substr($v, 2));
                break;
            }
        }
        return [$start, $end, $date];
    }

    private static function getCity($name)
    {
        if (!self::$cityList) {
            self::$cityList = include 'city.php';     
        }
        if (isset(self::$cityList[$name])) {
            return self::$cityList[$name];
        }
        return 'BXP';
    }

    private static function getUseDate($name)
    {
        $len = strlen($name);
        $today = getdate();
        if ($len > 0 && $len <= 2) {
            return $today['year']. '-'.sprintf('%02d', $today['mon']).'-'.sprintf('%02d', $name);
        } elseif ($len <= 4) {
            return $today['year']. '-'.sprintf('%02d', substr($name, 0, -2)).'-'.substr($name, -2);
        } elseif ($len == 6) {
            return '20'. substr($name, 0, -4) . '-'.substr($name, 2, -2).'-'.substr($name, -2);
        } else {
            return date('Y-m-d', strtotime('+1 days'));
        }
    }
}
