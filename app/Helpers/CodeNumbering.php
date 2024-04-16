<?php

use App\Models\ChargeTable;
use App\Models\SystemNumbering;

class CodeNumbering
{
    public static function custom_code($menu_id, $table = null, $field)
    {
        $data_code = SystemNumbering::where('module_id', $menu_id)->first();
        $exp_old = explode(",", $data_code->prefix);
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
            $exp[array_search("[MM]", $exp)] = ($cycle == "Y") ? '' :  date('m');
        }

        if (in_array("[MMMM]", $exp)) {
            $exp[array_search("[MMMM]", $exp)] = ($cycle == "Y") ? '' :  date('F');
        }

        $imp_format = implode("", $exp);

        // CEK MENGGUNAKAN CYCLE Y OR M
        if ($cycle == "Y") {
            if ((in_array("[MM]", $exp_old) || in_array("[MMMM]", $exp_old))) {
                if ($data_code->module_id == 36 || $data_code->module_id == 37) {
                    // $imp_format = str_replace("F", "", $imp_format);
                    $imp_format = substr($imp_format, 0, 10);
                } else {
                    $imp_format = preg_replace("/[^a-zA-Z0-9]/", "", implode("", $exp));
                }
            } else {
                $imp_format = $imp_format;
            }
        }

        $name_table = $table;
        // CEK CODE DARI DATABASE
        $count_charge_table = $name_table::select("{$field}")->where("{$field}", 'like', "%{$imp_format}%")->withTrashed()->count();

        if ($cycle == "Y") {
            if (in_array("[MM]", $exp_old) || in_array("[MMMM]", $exp_old)) {
                if (in_array("", $exp) == true) {
                    $exp[array_search("", $exp)] = date("m");
                }
                $imp_format = implode("", $exp);
            } else {
                $imp_format = $imp_format;
            }
        }

        // if ($data_code->module_id == 36) {
        //     $imp_format = str_replace("F", "", $imp_format);
        // } else {
        //     $imp_format = $imp_format;
        // }
        // dd($imp_format);

        if ($count_charge_table == 0) {
            $data_format = 1;
        } else {
            $data_format = $next_number;
        }
        $count_format = strlen($next_number);


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
                $imp_format .= (string)$data_format;
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
