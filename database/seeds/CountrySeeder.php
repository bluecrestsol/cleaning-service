<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('countries')->truncate();

        \DB::table('countries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'AF',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'AX',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'AL',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            3 => 
            array (
                'id' => 4,
                'code' => 'DZ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            4 => 
            array (
                'id' => 5,
                'code' => 'AS',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            5 => 
            array (
                'id' => 6,
                'code' => 'AD',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            6 => 
            array (
                'id' => 7,
                'code' => 'AO',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            7 => 
            array (
                'id' => 8,
                'code' => 'AI',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            8 => 
            array (
                'id' => 9,
                'code' => 'AQ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            9 => 
            array (
                'id' => 10,
                'code' => 'AG',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            10 => 
            array (
                'id' => 11,
                'code' => 'AR',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            11 => 
            array (
                'id' => 12,
                'code' => 'AM',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            12 => 
            array (
                'id' => 13,
                'code' => 'AW',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            13 => 
            array (
                'id' => 14,
                'code' => 'AC',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            14 => 
            array (
                'id' => 15,
                'code' => 'AU',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            15 => 
            array (
                'id' => 16,
                'code' => 'AT',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            16 => 
            array (
                'id' => 17,
                'code' => 'AZ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            17 => 
            array (
                'id' => 18,
                'code' => 'BS',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            18 => 
            array (
                'id' => 19,
                'code' => 'BH',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            19 => 
            array (
                'id' => 20,
                'code' => 'BD',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            20 => 
            array (
                'id' => 21,
                'code' => 'BB',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            21 => 
            array (
                'id' => 22,
                'code' => 'BY',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            22 => 
            array (
                'id' => 23,
                'code' => 'BE',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            23 => 
            array (
                'id' => 24,
                'code' => 'BZ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            24 => 
            array (
                'id' => 25,
                'code' => 'BJ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            25 => 
            array (
                'id' => 26,
                'code' => 'BM',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            26 => 
            array (
                'id' => 27,
                'code' => 'BT',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            27 => 
            array (
                'id' => 28,
                'code' => 'BO',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            28 => 
            array (
                'id' => 29,
                'code' => 'BA',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            29 => 
            array (
                'id' => 30,
                'code' => 'BW',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            30 => 
            array (
                'id' => 31,
                'code' => 'BR',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            31 => 
            array (
                'id' => 32,
                'code' => 'IO',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            32 => 
            array (
                'id' => 33,
                'code' => 'VG',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            33 => 
            array (
                'id' => 34,
                'code' => 'BN',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            34 => 
            array (
                'id' => 35,
                'code' => 'BG',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            35 => 
            array (
                'id' => 36,
                'code' => 'BF',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            36 => 
            array (
                'id' => 37,
                'code' => 'BI',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            37 => 
            array (
                'id' => 38,
                'code' => 'KH',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            38 => 
            array (
                'id' => 39,
                'code' => 'CM',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            39 => 
            array (
                'id' => 40,
                'code' => 'CA',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            40 => 
            array (
                'id' => 41,
                'code' => 'IC',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            41 => 
            array (
                'id' => 42,
                'code' => 'CV',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            42 => 
            array (
                'id' => 43,
                'code' => 'BQ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            43 => 
            array (
                'id' => 44,
                'code' => 'KY',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            44 => 
            array (
                'id' => 45,
                'code' => 'CF',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            45 => 
            array (
                'id' => 46,
                'code' => 'EA',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            46 => 
            array (
                'id' => 47,
                'code' => 'TD',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            47 => 
            array (
                'id' => 48,
                'code' => 'CL',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            48 => 
            array (
                'id' => 49,
                'code' => 'CN',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            49 => 
            array (
                'id' => 50,
                'code' => 'CX',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            50 => 
            array (
                'id' => 51,
                'code' => 'CC',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            51 => 
            array (
                'id' => 52,
                'code' => 'CO',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            52 => 
            array (
                'id' => 53,
                'code' => 'KM',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            53 => 
            array (
                'id' => 54,
                'code' => 'CG',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            54 => 
            array (
                'id' => 55,
                'code' => 'CD',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            55 => 
            array (
                'id' => 56,
                'code' => 'CK',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            56 => 
            array (
                'id' => 57,
                'code' => 'CR',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            57 => 
            array (
                'id' => 58,
                'code' => 'CI',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            58 => 
            array (
                'id' => 59,
                'code' => 'HR',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            59 => 
            array (
                'id' => 60,
                'code' => 'CU',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            60 => 
            array (
                'id' => 61,
                'code' => 'CW',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            61 => 
            array (
                'id' => 62,
                'code' => 'CY',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            62 => 
            array (
                'id' => 63,
                'code' => 'CZ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            63 => 
            array (
                'id' => 64,
                'code' => 'DK',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            64 => 
            array (
                'id' => 65,
                'code' => 'DG',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            65 => 
            array (
                'id' => 66,
                'code' => 'DJ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            66 => 
            array (
                'id' => 67,
                'code' => 'DM',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            67 => 
            array (
                'id' => 68,
                'code' => 'DO',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            68 => 
            array (
                'id' => 69,
                'code' => 'EC',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            69 => 
            array (
                'id' => 70,
                'code' => 'EG',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            70 => 
            array (
                'id' => 71,
                'code' => 'SV',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            71 => 
            array (
                'id' => 72,
                'code' => 'GQ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            72 => 
            array (
                'id' => 73,
                'code' => 'ER',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            73 => 
            array (
                'id' => 74,
                'code' => 'EE',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            74 => 
            array (
                'id' => 75,
                'code' => 'SZ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            75 => 
            array (
                'id' => 76,
                'code' => 'ET',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            76 => 
            array (
                'id' => 77,
                'code' => 'FK',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            77 => 
            array (
                'id' => 78,
                'code' => 'FO',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            78 => 
            array (
                'id' => 79,
                'code' => 'FJ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            79 => 
            array (
                'id' => 80,
                'code' => 'FI',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            80 => 
            array (
                'id' => 81,
                'code' => 'FR',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            81 => 
            array (
                'id' => 82,
                'code' => 'GF',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            82 => 
            array (
                'id' => 83,
                'code' => 'PF',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            83 => 
            array (
                'id' => 84,
                'code' => 'TF',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            84 => 
            array (
                'id' => 85,
                'code' => 'GA',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            85 => 
            array (
                'id' => 86,
                'code' => 'GM',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            86 => 
            array (
                'id' => 87,
                'code' => 'GE',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            87 => 
            array (
                'id' => 88,
                'code' => 'DE',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            88 => 
            array (
                'id' => 89,
                'code' => 'GH',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            89 => 
            array (
                'id' => 90,
                'code' => 'GI',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            90 => 
            array (
                'id' => 91,
                'code' => 'GR',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            91 => 
            array (
                'id' => 92,
                'code' => 'GL',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            92 => 
            array (
                'id' => 93,
                'code' => 'GD',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            93 => 
            array (
                'id' => 94,
                'code' => 'GP',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            94 => 
            array (
                'id' => 95,
                'code' => 'GU',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            95 => 
            array (
                'id' => 96,
                'code' => 'GT',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            96 => 
            array (
                'id' => 97,
                'code' => 'GG',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            97 => 
            array (
                'id' => 98,
                'code' => 'GN',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            98 => 
            array (
                'id' => 99,
                'code' => 'GW',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            99 => 
            array (
                'id' => 100,
                'code' => 'GY',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            100 => 
            array (
                'id' => 101,
                'code' => 'HT',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            101 => 
            array (
                'id' => 102,
                'code' => 'HN',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            102 => 
            array (
                'id' => 103,
                'code' => 'HK',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            103 => 
            array (
                'id' => 104,
                'code' => 'HU',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            104 => 
            array (
                'id' => 105,
                'code' => 'IS',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            105 => 
            array (
                'id' => 106,
                'code' => 'IN',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            106 => 
            array (
                'id' => 107,
                'code' => 'ID',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            107 => 
            array (
                'id' => 108,
                'code' => 'IR',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            108 => 
            array (
                'id' => 109,
                'code' => 'IQ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            109 => 
            array (
                'id' => 110,
                'code' => 'IE',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            110 => 
            array (
                'id' => 111,
                'code' => 'IM',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            111 => 
            array (
                'id' => 112,
                'code' => 'IL',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            112 => 
            array (
                'id' => 113,
                'code' => 'IT',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'enabled'
            ),
            113 => 
            array (
                'id' => 114,
                'code' => 'JM',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            114 => 
            array (
                'id' => 115,
                'code' => 'JP',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            115 => 
            array (
                'id' => 116,
                'code' => 'JE',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            116 => 
            array (
                'id' => 117,
                'code' => 'JO',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            117 => 
            array (
                'id' => 118,
                'code' => 'KZ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            118 => 
            array (
                'id' => 119,
                'code' => 'KE',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            119 => 
            array (
                'id' => 120,
                'code' => 'KI',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            120 => 
            array (
                'id' => 121,
                'code' => 'XK',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            121 => 
            array (
                'id' => 122,
                'code' => 'KW',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            122 => 
            array (
                'id' => 123,
                'code' => 'KG',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            123 => 
            array (
                'id' => 124,
                'code' => 'LA',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            124 => 
            array (
                'id' => 125,
                'code' => 'LV',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            125 => 
            array (
                'id' => 126,
                'code' => 'LB',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            126 => 
            array (
                'id' => 127,
                'code' => 'LS',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            127 => 
            array (
                'id' => 128,
                'code' => 'LR',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            128 => 
            array (
                'id' => 129,
                'code' => 'LY',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            129 => 
            array (
                'id' => 130,
                'code' => 'LI',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            130 => 
            array (
                'id' => 131,
                'code' => 'LT',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            131 => 
            array (
                'id' => 132,
                'code' => 'LU',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            132 => 
            array (
                'id' => 133,
                'code' => 'MO',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            133 => 
            array (
                'id' => 134,
                'code' => 'MG',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            134 => 
            array (
                'id' => 135,
                'code' => 'MW',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            135 => 
            array (
                'id' => 136,
                'code' => 'MY',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            136 => 
            array (
                'id' => 137,
                'code' => 'MV',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            137 => 
            array (
                'id' => 138,
                'code' => 'ML',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            138 => 
            array (
                'id' => 139,
                'code' => 'MT',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            139 => 
            array (
                'id' => 140,
                'code' => 'MH',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            140 => 
            array (
                'id' => 141,
                'code' => 'MQ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            141 => 
            array (
                'id' => 142,
                'code' => 'MR',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            142 => 
            array (
                'id' => 143,
                'code' => 'MU',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            143 => 
            array (
                'id' => 144,
                'code' => 'YT',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            144 => 
            array (
                'id' => 145,
                'code' => 'MX',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            145 => 
            array (
                'id' => 146,
                'code' => 'FM',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            146 => 
            array (
                'id' => 147,
                'code' => 'MD',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            147 => 
            array (
                'id' => 148,
                'code' => 'MC',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            148 => 
            array (
                'id' => 149,
                'code' => 'MN',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            149 => 
            array (
                'id' => 150,
                'code' => 'ME',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            150 => 
            array (
                'id' => 151,
                'code' => 'MS',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            151 => 
            array (
                'id' => 152,
                'code' => 'MA',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            152 => 
            array (
                'id' => 153,
                'code' => 'MZ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            153 => 
            array (
                'id' => 154,
                'code' => 'MM',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            154 => 
            array (
                'id' => 155,
                'code' => 'NA',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            155 => 
            array (
                'id' => 156,
                'code' => 'NR',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            156 => 
            array (
                'id' => 157,
                'code' => 'NP',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            157 => 
            array (
                'id' => 158,
                'code' => 'NL',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            158 => 
            array (
                'id' => 159,
                'code' => 'NC',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            159 => 
            array (
                'id' => 160,
                'code' => 'NZ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            160 => 
            array (
                'id' => 161,
                'code' => 'NI',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            161 => 
            array (
                'id' => 162,
                'code' => 'NE',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            162 => 
            array (
                'id' => 163,
                'code' => 'NG',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            163 => 
            array (
                'id' => 164,
                'code' => 'NU',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            164 => 
            array (
                'id' => 165,
                'code' => 'NF',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            165 => 
            array (
                'id' => 166,
                'code' => 'KP',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            166 => 
            array (
                'id' => 167,
                'code' => 'MK',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            167 => 
            array (
                'id' => 168,
                'code' => 'MP',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            168 => 
            array (
                'id' => 169,
                'code' => 'NO',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            169 => 
            array (
                'id' => 170,
                'code' => 'OM',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            170 => 
            array (
                'id' => 171,
                'code' => 'PK',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            171 => 
            array (
                'id' => 172,
                'code' => 'PW',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            172 => 
            array (
                'id' => 173,
                'code' => 'PS',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            173 => 
            array (
                'id' => 174,
                'code' => 'PA',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            174 => 
            array (
                'id' => 175,
                'code' => 'PG',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            175 => 
            array (
                'id' => 176,
                'code' => 'PY',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            176 => 
            array (
                'id' => 177,
                'code' => 'PE',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            177 => 
            array (
                'id' => 178,
                'code' => 'PH',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'enabled'
            ),
            178 => 
            array (
                'id' => 179,
                'code' => 'PN',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            179 => 
            array (
                'id' => 180,
                'code' => 'PL',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            180 => 
            array (
                'id' => 181,
                'code' => 'PT',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            181 => 
            array (
                'id' => 182,
                'code' => 'XA',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            182 => 
            array (
                'id' => 183,
                'code' => 'XB',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            183 => 
            array (
                'id' => 184,
                'code' => 'PR',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            184 => 
            array (
                'id' => 185,
                'code' => 'QA',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            185 => 
            array (
                'id' => 186,
                'code' => 'RE',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            186 => 
            array (
                'id' => 187,
                'code' => 'RO',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            187 => 
            array (
                'id' => 188,
                'code' => 'RU',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            188 => 
            array (
                'id' => 189,
                'code' => 'RW',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            189 => 
            array (
                'id' => 190,
                'code' => 'WS',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            190 => 
            array (
                'id' => 191,
                'code' => 'SM',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            191 => 
            array (
                'id' => 192,
                'code' => 'ST',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            192 => 
            array (
                'id' => 193,
                'code' => 'SA',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            193 => 
            array (
                'id' => 194,
                'code' => 'SN',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            194 => 
            array (
                'id' => 195,
                'code' => 'RS',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            195 => 
            array (
                'id' => 196,
                'code' => 'SC',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            196 => 
            array (
                'id' => 197,
                'code' => 'SL',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            197 => 
            array (
                'id' => 198,
                'code' => 'SG',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            198 => 
            array (
                'id' => 199,
                'code' => 'SX',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            199 => 
            array (
                'id' => 200,
                'code' => 'SK',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            200 => 
            array (
                'id' => 201,
                'code' => 'SI',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            201 => 
            array (
                'id' => 202,
                'code' => 'SB',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            202 => 
            array (
                'id' => 203,
                'code' => 'SO',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            203 => 
            array (
                'id' => 204,
                'code' => 'ZA',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            204 => 
            array (
                'id' => 205,
                'code' => 'GS',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            205 => 
            array (
                'id' => 206,
                'code' => 'KR',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            206 => 
            array (
                'id' => 207,
                'code' => 'SS',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            207 => 
            array (
                'id' => 208,
                'code' => 'ES',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            208 => 
            array (
                'id' => 209,
                'code' => 'LK',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            209 => 
            array (
                'id' => 210,
                'code' => 'BL',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            210 => 
            array (
                'id' => 211,
                'code' => 'SH',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            211 => 
            array (
                'id' => 212,
                'code' => 'KN',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            212 => 
            array (
                'id' => 213,
                'code' => 'LC',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            213 => 
            array (
                'id' => 214,
                'code' => 'MF',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            214 => 
            array (
                'id' => 215,
                'code' => 'PM',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            215 => 
            array (
                'id' => 216,
                'code' => 'VC',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            216 => 
            array (
                'id' => 217,
                'code' => 'SD',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            217 => 
            array (
                'id' => 218,
                'code' => 'SR',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            218 => 
            array (
                'id' => 219,
                'code' => 'SJ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            219 => 
            array (
                'id' => 220,
                'code' => 'SE',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            220 => 
            array (
                'id' => 221,
                'code' => 'CH',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            221 => 
            array (
                'id' => 222,
                'code' => 'SY',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            222 => 
            array (
                'id' => 223,
                'code' => 'TW',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            223 => 
            array (
                'id' => 224,
                'code' => 'TJ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            224 => 
            array (
                'id' => 225,
                'code' => 'TZ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            225 => 
            array (
                'id' => 226,
                'code' => 'TH',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'enabled'
            ),
            226 => 
            array (
                'id' => 227,
                'code' => 'TL',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            227 => 
            array (
                'id' => 228,
                'code' => 'TG',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            228 => 
            array (
                'id' => 229,
                'code' => 'TK',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            229 => 
            array (
                'id' => 230,
                'code' => 'TO',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            230 => 
            array (
                'id' => 231,
                'code' => 'TT',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            231 => 
            array (
                'id' => 232,
                'code' => 'TA',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            232 => 
            array (
                'id' => 233,
                'code' => 'TN',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            233 => 
            array (
                'id' => 234,
                'code' => 'TR',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            234 => 
            array (
                'id' => 235,
                'code' => 'TM',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            235 => 
            array (
                'id' => 236,
                'code' => 'TC',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            236 => 
            array (
                'id' => 237,
                'code' => 'TV',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            237 => 
            array (
                'id' => 238,
                'code' => 'UM',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            238 => 
            array (
                'id' => 239,
                'code' => 'VI',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            239 => 
            array (
                'id' => 240,
                'code' => 'UG',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            240 => 
            array (
                'id' => 241,
                'code' => 'UA',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            241 => 
            array (
                'id' => 242,
                'code' => 'AE',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            242 => 
            array (
                'id' => 243,
                'code' => 'GB',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            243 => 
            array (
                'id' => 244,
                'code' => 'US',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            244 => 
            array (
                'id' => 245,
                'code' => 'UY',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            245 => 
            array (
                'id' => 246,
                'code' => 'UZ',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            246 => 
            array (
                'id' => 247,
                'code' => 'VU',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            247 => 
            array (
                'id' => 248,
                'code' => 'VA',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            248 => 
            array (
                'id' => 249,
                'code' => 'VE',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            249 => 
            array (
                'id' => 250,
                'code' => 'VN',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            250 => 
            array (
                'id' => 251,
                'code' => 'WF',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            251 => 
            array (
                'id' => 252,
                'code' => 'EH',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            252 => 
            array (
                'id' => 253,
                'code' => 'YE',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            253 => 
            array (
                'id' => 254,
                'code' => 'ZM',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            ),
            254 => 
            array (
                'id' => 255,
                'code' => 'ZW',
                'created_at' => '2019-10-02 13:26:13',
                'status' => 'disabled'
            )
        ));
    }
}
