<?php

use App\Models\SystemNumbering;

class CodeNumbering
{
    public static function custom_code($menu_id, $table = null)
    {
        $data_code = SystemNumbering::where('module_id', $menu_id)->first();
        $exp = explode(",", $data_code->prefix);
        $next_number = $data_code->next_number;
        $length_number = $data_code->length_number;
        $count_length_number = $length_number;
        $cycle = $data_code->cycle;

        // CEK PREFIX
        if (in_array("[YYYY]", $exp)) {
            $exp[array_search("[YYYY]", $exp)] = date('Y');
        }

        if (in_array("[YY]", $exp)) {
            $exp[array_search("[YY]", $exp)] = date('y');
        }

        if (in_array("[MM]", $exp)) {
            $exp[array_search("[MM]", $exp)] =  date('m');
        }

        if (in_array("[MMMM]", $exp)) {
            $exp[array_search("[MMMM]", $exp)] =  date('F');
        }


        $imp_format = implode("", $exp);
        $name_table = $table;

        // $count_charge_table = $name_table::select('code')->where('code', 'like', "%$imp_format%")->count();
        // if ($count_charge_table == 0) {
        //     $data_format = $next_number;
        // } else {
        $data_format = $next_number;
        // }
        $count_format = strlen($next_number);


        // CEK MENGGUNAKAN CYCLE Y OR M
        if ($cycle == "Y") {
            $imp_format = implode("", $exp) . ($exp[array_search("[MM]", $exp)] ? date('m') : ($exp[array_search("[MMMM]", $exp)] ? date('F') : ''));
        }

        if ($count_length_number == 0) {
            $imp_format .= (string)$data_format;
        } else if ($count_length_number == 1) {
            if ($count_format <= 1) {
                $imp_format .= "0{$data_format}";
            } else {
                $imp_format .= (string)$data_format;
            }
        } else if ($count_length_number == 2) {
            if ($count_format <= 1) {
                $imp_format .= "00{$data_format}";
            } else if ($count_format <= 2) {
                $imp_format .= "0{$data_format}";
            } else {
                $imp_format .= (string)$data_format;
            }
        } else if ($count_length_number == 3) {
            if ($count_format <= 1) {
                $imp_format .= "000{$data_format}";
            } else if ($count_format <= 2) {
                $imp_format .= "00{$data_format}";
            } else if ($count_format <= 3) {
                $imp_format .= "0{$data_format}";
            } else {
                $imp_format .= "cuk";
            }
        } else if ($count_length_number == 4) {
            if ($count_format <= 1) {
                $imp_format .= "0000{$data_format}";
            } else if ($count_format <= 2) {
                $imp_format .= "000{$data_format}";
            } else if ($count_format <= 3) {
                $imp_format .= "00{$data_format}";
            } else if ($count_format <= 4) {
                $imp_format .= "0{$data_format}";
            } else {
                $imp_format .= (string)$data_format;
            }
        } else if ($count_length_number == 5) {
            if ($count_format <= 1) {
                $imp_format .= "00000{$data_format}";
            } else if ($count_format <= 2) {
                $imp_format .= "0000{$data_format}";
            } else if ($count_format <= 3) {
                $imp_format .= "000{$data_format}";
            } else if ($count_format <= 4) {
                $imp_format .= "00{$data_format}";
            } else if ($count_format <= 5) {
                $imp_format .= "0{$data_format}";
            } else {
                $imp_format .= (string)$data_format;
            }
        } else if ($count_length_number == 6) {
            if ($count_format <= 1) {
                $imp_format .= "000000{$data_format}";
            } else if ($count_format <= 2) {
                $imp_format .= "00000{$data_format}";
            } else if ($count_format <= 3) {
                $imp_format .= "0000{$data_format}";
            } else if ($count_format <= 4) {
                $imp_format .= "000{$data_format}";
            } else if ($count_format <= 5) {
                $imp_format .= "00{$data_format}";
            } else if ($count_format <= 6) {
                $imp_format .= "0{$data_format}";
            } else {
                $imp_format .= (string)$data_format;
            }
        } else if ($count_length_number == 7) {
            if ($count_format <= 1) {
                $imp_format .= "0000000{$data_format}";
            } else if ($count_format <= 2) {
                $imp_format .= "000000{$data_format}";
            } else if ($count_format <= 3) {
                $imp_format .= "00000{$data_format}";
            } else if ($count_format <= 4) {
                $imp_format .= "0000{$data_format}";
            } else if ($count_format <= 5) {
                $imp_format .= "000{$data_format}";
            } else if ($count_format <= 6) {
                $imp_format .= "00{$data_format}";
            } else if ($count_format <= 7) {
                $imp_format .= "0{$data_format}";
            } else {
                $imp_format .= (string)$data_format;
            }
        } else if ($count_length_number == 8) {
            if ($count_format <= 1) {
                $imp_format .= "00000000{$data_format}";
            } else if ($count_format <= 2) {
                $imp_format .= "0000000{$data_format}";
            } else if ($count_format <= 3) {
                $imp_format .= "000000{$data_format}";
            } else if ($count_format <= 4) {
                $imp_format .= "00000{$data_format}";
            } else if ($count_format <= 5) {
                $imp_format .= "0000{$data_format}";
            } else if ($count_format <= 6) {
                $imp_format .= "000{$data_format}";
            } else if ($count_format <= 7) {
                $imp_format .= "00{$data_format}";
            } else if ($count_format <= 8) {
                $imp_format .= "0{$data_format}";
            } else {
                $imp_format .= (string)$data_format;
            }
        } else if ($count_length_number == 9) {
            if ($count_format <= 1) {
                $imp_format .= "000000000{$data_format}";
            } else if ($count_format <= 2) {
                $imp_format .= "00000000{$data_format}";
            } else if ($count_format <= 3) {
                $imp_format .= "0000000{$data_format}";
            } else if ($count_format <= 4) {
                $imp_format .= "000000{$data_format}";
            } else if ($count_format <= 5) {
                $imp_format .= "00000{$data_format}";
            } else if ($count_format <= 6) {
                $imp_format .= "0000{$data_format}";
            } else if ($count_format <= 7) {
                $imp_format .= "000{$data_format}";
            } else if ($count_format <= 8) {
                $imp_format .= "00{$data_format}";
            } else if ($count_format <= 9) {
                $imp_format .= "0{$data_format}";
            } else {
                $imp_format .= (string)$data_format;
            }
        } else if ($count_length_number == 10) {
            if ($count_format <= 1) {
                $imp_format .= "0000000000{$data_format}";
            } else if ($count_format <= 2) {
                $imp_format .= "000000000{$data_format}";
            } else if ($count_format <= 3) {
                $imp_format .= "00000000{$data_format}";
            } else if ($count_format <= 4) {
                $imp_format .= "0000000{$data_format}";
            } else if ($count_format <= 5) {
                $imp_format .= "000000{$data_format}";
            } else if ($count_format <= 6) {
                $imp_format .= "00000{$data_format}";
            } else if ($count_format <= 7) {
                $imp_format .= "0000{$data_format}";
            } else if ($count_format <= 8) {
                $imp_format .= "000{$data_format}";
            } else if ($count_format <= 9) {
                $imp_format .= "00{$data_format}";
            } else if ($count_format <= 10) {
                $imp_format .= "0{$data_format}";
            } else {
                $imp_format .= (string)$data_format;
            }
        } else if ($count_length_number == 11) {
            if ($count_format <= 1) {
                $imp_format .= "00000000000{$data_format}";
            } else if ($count_format <= 2) {
                $imp_format .= "0000000000{$data_format}";
            } else if ($count_format <= 3) {
                $imp_format .= "000000000{$data_format}";
            } else if ($count_format <= 4) {
                $imp_format .= "00000000{$data_format}";
            } else if ($count_format <= 5) {
                $imp_format .= "0000000{$data_format}";
            } else if ($count_format <= 6) {
                $imp_format .= "000000{$data_format}";
            } else if ($count_format <= 7) {
                $imp_format .= "00000{$data_format}";
            } else if ($count_format <= 8) {
                $imp_format .= "0000{$data_format}";
            } else if ($count_format <= 9) {
                $imp_format .= "000{$data_format}";
            } else if ($count_format <= 10) {
                $imp_format .= "00{$data_format}";
            } else if ($count_format <= 11) {
                $imp_format .= "0{$data_format}";
            } else {
                $imp_format .= (string)$data_format;
            }
        } else if ($count_length_number == 12) {
            if ($count_format <= 1) {
                $imp_format .= "000000000000{$data_format}";
            } else if ($count_format <= 2) {
                $imp_format .= "00000000000{$data_format}";
            } else if ($count_format <= 3) {
                $imp_format .= "0000000000{$data_format}";
            } else if ($count_format <= 4) {
                $imp_format .= "000000000{$data_format}";
            } else if ($count_format <= 5) {
                $imp_format .= "00000000{$data_format}";
            } else if ($count_format <= 6) {
                $imp_format .= "0000000{$data_format}";
            } else if ($count_format <= 7) {
                $imp_format .= "000000{$data_format}";
            } else if ($count_format <= 8) {
                $imp_format .= "00000{$data_format}";
            } else if ($count_format <= 9) {
                $imp_format .= "0000{$data_format}";
            } else if ($count_format <= 10) {
                $imp_format .= "000{$data_format}";
            } else if ($count_format <= 11) {
                $imp_format .= "00{$data_format}";
            } else if ($count_format <= 12) {
                $imp_format .= "0{$data_format}";
            } else {
                $imp_format .= (string)$data_format;
            }
        } else {
            $imp_format .= (string)$data_format;
        }

        $data_code->update([
            'next_number'   => $data_format + 1
        ]);

        return $imp_format;
    }
}
