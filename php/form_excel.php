<?php
$directory_lvl = 1;

include '../module/directory.php';

include $extra_dir . 'module/class.php';

$account = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']);
$accountId = $account['id'];

require_once('../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$summaKm = 0;
$summaLt = 0;

$from_excel = $_POST['create-excel-from'];
$to_excel = $_POST['create-excel-to'];

if (!$from_excel || !$to_excel) {
    header("Location: /journal/index");
}

$dateBe = mysqli_fetch_assoc(mysqli_query($db->connection, "SELECT * FROM trip WHERE dateHappen between '$from_excel' and '$to_excel'"));
if (!$dateBe) {
    header("Location: /journal/index");
}

$excelAction = $_POST['action'];

if ($excelAction == 'card') {
    $query = mysqli_query($db->connection, "SELECT * FROM trip WHERE dateHappen between '$from_excel' and '$to_excel'");

// $queryRouteList = mysqli_query($db->connection, "SELECT * FROM trip WHERE dateHappen between '$from_excel' and '$to_excel'")
// while ( $fetchRouteList = mysqli_fetch_assoc($queryRouteList) ) {
//
// }

    $reader = IOFactory::createReader('Xlsx');
    $spreadsheet = $reader->load('../files/excel/oil_card.xlsx');
    $currentRow = 7;

    $spreadsheet->getActiveSheet()
        ->setCellValue('A4', $account['fio'])
        ->setCellValue('B4', $account['marka_car'])
        ->setCellValue('C4', $account['rasxod_km'])
        ->setCellValue('D4', $account['number_card']);
    while ($fetch = mysqli_fetch_assoc($query)) {
        $spreadsheet->getActiveSheet()
            ->insertNewRowBefore($currentRow)
            ->setCellValue('A' . $currentRow, $account['type_oil'])
            ->setCellValue('B' . $currentRow, date("d.m.Y", strtotime($fetch['dateHappen'])))
            ->setCellValue('C' . $currentRow, $fetch['how_litr_check'])
            ->setCellValue('D' . $currentRow, $fetch['summa_check']);
        $spreadsheet->getActiveSheet()
            ->getRowDimension("7")
            ->setRowHeight(15, 5);
        $spreadsheet->getActiveSheet()
            ->getRowDimension("4")
            ->setRowHeight(-1);
        $spreadsheet->getActiveSheet()
            ->getStyle('A7')
            ->getAlignment()
            ->setHorizontal('left');
        $spreadsheet->getActiveSheet()
            ->getStyle('C7')
            ->getAlignment()
            ->setHorizontal('right');
        $spreadsheet->getActiveSheet()
            ->getStyle('D7')
            ->getAlignment()
            ->setHorizontal('right');
        $currentRow++;
        $summaMoney += $fetch['summa_check'];
        $summaLt += $fetch['how_litr_check'];
    }
    $spreadsheet->getActiveSheet()
        ->setCellValue('A' . $currentRow, 'Итого по ' . $account['type_oil'])
        ->setCellValue('C' . $currentRow, $summaLt)
        ->setCellValue('D' . $currentRow, $summaMoney)
        ->setCellValue('A' . $currentRow += 2, $account['fio']);

    $fileNameCard = 'Карта держателя.xlsx';

    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Карта держателя.xlsx"');
    $writer->save('php://output');
}
if ($excelAction == 'list') {
    $queryList = mysqli_query($db->connection, "SELECT * FROM trip WHERE dateHappen between '$from_excel' and '$to_excel' AND haveId = '$accountId'");

    $readerList = IOFactory::createReader('Xlsx');
    $spreadsheetList = $readerList->load('../files/excel/route_list.xlsx');

    $mouth;
    $date;

    $spreadsheetList->getSheetByName('ПЛ-ТК')
        ->setCellValue('D5', $account['fio'])
        ->setCellValue('C14', $account['fio'])
        ->setCellValue('D6', $account['adress'] . ', тел. ' . $account['phone'])
        ->setCellValue('AB5', $account['number_license'])
        ->setCellValue('AB6', $account['number_card'])
        ->setCellValue('AD7', $account['gov_number'])
        ->setCellValue('I7', $account['marka_car']);

    $howSummaCheck = 35;
    $howTrip = 1;

    $howRow = 11;

    $totalKm = 0;

    while ( $fetchList = mysqli_fetch_assoc($queryList) ) {
        $spreadsheetList->getSheetByName('ПЛ-ТК')
                        ->insertNewRowBefore($howRow)
                        ->mergeCells('D' . $howRow . ':H' . $howRow)
                        ->mergeCells('I' . $howRow . ':M' . $howRow)
                        ->mergeCells('N' . $howRow . ':P' . $howRow)
                        ->mergeCells('Q' . $howRow . ':AC' . $howRow)
                        ->mergeCells('AD' . $howRow . ':AH' . $howRow);
        $spreadsheetList->getSheetByName('ПЛ-ТК')
                        ->getRowDimension($howRow)
                        ->setRowHeight(40);

        $spreadsheetList->getSheetByName('ПЛ-ТК')
                        ->getStyle('Q' . $howRow)
                        ->getAlignment()
                        ->setWrapText(true);
        $spreadsheetList->getSheetByName('ПЛ-ТК')
                        ->setCellValue('B' . $howRow, $howTrip)
                        ->setCellValue('C' . $howRow, date("d.m.Y", strtotime($fetchList['dateHappen'])))
                        ->setCellValue('D' . $howRow, $fetchList['from_km'])
                        ->setCellValue('I' . $howRow, $fetchList['to_km'])
                        ->setCellValue('N' . $howRow, $fetchList['total_km'])
                        ->setCellValue('Q' . $howRow, $fetchList['route'])
                        ->setCellValue('AD' . $howRow, $fetchList['number_request']);
        $howTrip++;
        $howRow++;

        $totalKm += $fetchList['total_km'];

        $spreadsheetList->getSheetByName('Памятка')
            ->setCellValue('J' . $howSummaCheck, $fetchList['summa_check']);
        $howSummaCheck++;
        $mouth = date("m", strtotime($fetchList['dateHappen']));
        $date = date("d.m.Y", strtotime($fetchList['dateHappen']));
    }

    $spreadsheetList->getSheetByName('ПЛ-ТК')
        ->setCellValue('V2', $mouth);

    switch ($mouth) {
        case '01':
            $spreadsheetList->getSheetByName('ПЛ-ТК')
                ->setCellValue('L3', 'январь');
            $spreadsheetList->getSheetByName('СЗ-ТК')
                ->setCellValue('T31', 'январь');
            break;
        case '02':
            $spreadsheetList->getSheetByName('ПЛ-ТК')
                ->setCellValue('L3', 'февраль');
            $spreadsheetList->getSheetByName('СЗ-ТК')
                ->setCellValue('T31', 'февраль');
            break;
        case '03':
            $spreadsheetList->getSheetByName('ПЛ-ТК')
                ->setCellValue('L3', 'март');
            $spreadsheetList->getSheetByName('СЗ-ТК')
                ->setCellValue('T31', 'март');
            break;
        case '04':
            $spreadsheetList->getSheetByName('ПЛ-ТК')
                ->setCellValue('L3', 'апрель');
            $spreadsheetList->getSheetByName('СЗ-ТК')
                ->setCellValue('T31', 'апрель');
            break;
        case '05':
            $spreadsheetList->getSheetByName('ПЛ-ТК')
                ->setCellValue('L3', 'май');
            $spreadsheetList->getSheetByName('СЗ-ТК')
                ->setCellValue('T31', 'май');
            break;
        case '06':
            $spreadsheetList->getSheetByName('ПЛ-ТК')
                ->setCellValue('L3', 'июнь');
            $spreadsheetList->getSheetByName('СЗ-ТК')
                ->setCellValue('T31', 'июнь');
            break;
        case '07':
            $spreadsheetList->getSheetByName('ПЛ-ТК')
                ->setCellValue('L3', 'июль');
            $spreadsheetList->getSheetByName('СЗ-ТК')
                ->setCellValue('T31', 'июль');
            break;
        case '08':
            $spreadsheetList->getSheetByName('ПЛ-ТК')
                ->setCellValue('L3', 'август');
            $spreadsheetList->getSheetByName('СЗ-ТК')
                ->setCellValue('T31', 'август');
            break;
        case '09':
            $spreadsheetList->getSheetByName('ПЛ-ТК')
                ->setCellValue('L3', 'сентябрь');
            $spreadsheetList->getSheetByName('СЗ-ТК')
                ->setCellValue('T31', 'сентябрь');
            break;
        case '10':
            $spreadsheetList->getSheetByName('ПЛ-ТК')
                ->setCellValue('L3', 'октябрь');
            $spreadsheetList->getSheetByName('СЗ-ТК')
                ->setCellValue('T31', 'октябрь');
            break;
        case '11':
            $spreadsheetList->getSheetByName('ПЛ-ТК')
                ->setCellValue('L3', 'ноябрь');
            $spreadsheetList->getSheetByName('СЗ-ТК')
                ->setCellValue('T31', 'ноябрь');
            break;
        case '12':
            $spreadsheetList->getSheetByName('ПЛ-ТК')
                ->setCellValue('L3', 'декабрь');
            $spreadsheetList->getSheetByName('СЗ-ТК')
                ->setCellValue('T31', 'декабрь');
            break;
    }

    $howRow--;
    $howTrip--;

    $cellHowTrip = 12 + $howTrip;

    $spreadsheetList->getSheetByName('ПЛ-ТК')
        ->setCellValue('AF' . $cellHowTrip, $howTrip)
        ->setCellValue('N' . $cellHowTrip, $totalKm)
        ->setCellValue('M8', '=D11')
        ->setCellValue('AD8', '=I' . $howRow);

    $fio = explode(" " ,$account['fio']);
    $fio1 = mb_str_split($fio[1]);
    $fio2 = mb_str_split($fio[2]);
    $fioReduction = $fio[0] . ' ' . $fio1[0] . '. ' . $fio2[0] . '.';

    $spreadsheetList->getSheetByName('СЗ-ТК')
        ->setCellValue('Y4', $account['position'])
        ->setCellValue('X5', $account['fio'])
        ->setCellValue('P16', $howTrip)
        ->setCellValue('F18', $totalKm)
        ->setCellValue('O21', $totalKm)
        ->setCellValue('J36', $totalKm)
        ->setCellValue('X31', $fioReduction)
        /*->setCellValue('T32', $mouth)*/
        ->setCellValue('Q31', date('t', strtotime($date)));



    $fileNameList = 'Путевой лист.xlsx';

    $writerList = new Xlsx($spreadsheetList);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Путевой лист.xlsx"');
    $writerList->save('php://output');
}
?>