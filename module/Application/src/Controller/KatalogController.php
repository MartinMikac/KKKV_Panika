<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class KatalogController extends AbstractActionController {

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
     */
    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    public function indexAction() {
        $view = new ViewModel();

        return $view;
    }

    /**
     * The "settings" action displays the info about currently logged in user.
     */
    public function import020Action() {
        $lines = file('./data/import020/import_020');

        $transformed = array();
        $for_repair = array();
        $transformed_count = 0;
        $for_rapair_count = 0;

        $handle = fopen('./data/import020/import_020_export', "w");


        // Pouze jedna smyčka



        foreach ($lines as $line => $row) {

            $row = trim($row);
            //print_r($row);
            //print_r("<br/>");



            if ($this->checkIsContain($row, '$$a') != true) {
                continue;
            }

            if ($this->checkIsContain($row, '$$q') != false) {
                //print_r($row."QQQQQQQQQQQQQQQQQQ<br/>");
                continue;
            }

            if ($this->checkIsContain($row, '(') != true) {
                continue;
            }

            if ($this->checkIsContain($row, ')') != true) {
                continue;
            }

            $final_row = $this->transformFields($row);
            $transformed[$transformed_count] = $final_row;

            $final_row = mb_convert_encoding($final_row, 'UTF-8', 'UTF-8');

            fwrite($handle, $final_row . "\n");


            $transformed_count++;
        }

        fclose($handle);



        // Pouze jedna smyčka
        foreach ($lines as $line => $row) {

            if ($this->checkIsContain($row, ' L $$c') == true) {
                if ($this->checkIsContain($row, '$$a') == true) {
                    $for_repair[$for_rapair_count] = $row;
                    $for_rapair_count++;
                }
            }
        }

        $view = new ViewModel();

        return new ViewModel([
            'transformed_lines' => $transformed,
            'for_repair' => $for_repair
        ]);
    }

    private function checkIsContain(string $row, string $search) {
        if (strpos($row, $search) > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function transformFields(string $row) {
        $field_a = '$$a';
        $field_c = '$$c';
        $field_dollars = '$$';

        $line_begin = "";
        $line_field_A = "";
        $line_rest = "";
        $isNextPrice = false;

        if (strpos($row, $field_a)) {
            $line_begin = substr($row, 0, strpos($row, $field_a));
            $line_field_A = substr($row, strpos($row, $field_a) + 3);

            if (strpos($line_field_A, $field_dollars)) {
                $line_rest = substr($line_field_A, strpos($line_field_A, $field_dollars));
                $line_field_A = substr($line_field_A, 0, strpos($line_field_A, $field_dollars));
            }

            if (substr($line_rest, 0, 3) == $field_c) {
                $isNextPrice = true;
            }

            $line_field_A = $this->splitFieldA($line_field_A, $isNextPrice);

            return $line_begin . $line_field_A . $line_rest;
        } else {
            return false;
        }
    }

    private function splitFieldA(string $field_a, bool $isNextPrice) {
        $bracket_left = '(';
        $bracket_right = ')';
        $separator = ':';
        $bra_begin = null;
        $bra_end = null;
        $field_a_begin = null;
        $field_q = '$$q';
        $field_a_sign = '$$a';


        $bra_begin = strpos($field_a, $bracket_left);
        $bra_end = strpos($field_a, $bracket_right);

        $core = substr($field_a, $bra_begin, ($bra_end - $bra_begin + 1));

        $field_a_begin = substr($field_a, 0, strlen($field_a) - strlen($core) - 2);

        /*
          print_r("field_a:".$field_a);
          print_r("<br/>");
          print_r("FB.:".$field_a_begin);
          print_r("<br/>");
          print_r("Core:".$core);
          print_r("<br/>");

         */


        if (trim($field_a_begin) == trim($core) || trim($field_a) == trim($core . " :")) {
            $field_a_begin = "";
        } else {
            $field_a_begin = $field_a_sign . $field_a_begin;
        }

        if (strpos($core, $separator) > 0) {
            $sep_a = substr($core, 0, strpos($core, $separator) + 1);
            $sep_b = substr($core, strpos($core, $separator) + 1);
            $field_q = '$$q' . $sep_a . '$$q' . $sep_b;
        } else {
            $field_q = '$$q' . $core;
        }

        if ($isNextPrice == true) {
            $field_q = $field_q . " :";
        }

        return $field_a_begin . $field_q;
    }

}
