<?php
/**
 * @var $job  backend\models\Job
 * @var $task backend\models\Task
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=utf-8">
    <TITLE></TITLE>
    <STYLE TYPE="text/css">
        body { background: #ffffff; margin: 0; font-family: Arial; font-size: 8pt; font-style: normal; }
        tr.R0{ height: 15px; }
        tr.R0 td.R11C1{ font-family: Arial; font-size: 9pt; font-style: normal; font-weight: bold; background-color: #eeeeee; text-align: center; vertical-align: medium; border-left: #000000 2px solid; border-top: #000000 2px solid; }
        tr.R0 td.R11C3{ font-family: Arial; font-size: 9pt; font-style: normal; font-weight: bold; background-color: #eeeeee; text-align: center; vertical-align: medium; border-left: #000000 1px solid; border-top: #000000 2px solid; }
        tr.R0 td.R11C31{ font-family: Arial; font-size: 9pt; font-style: normal; font-weight: bold; background-color: #eeeeee; text-align: center; vertical-align: medium; border-left: #000000 1px solid; border-top: #000000 2px solid; }
        tr.R0 td.R11C34{ font-family: Arial; font-size: 9pt; font-style: normal; font-weight: bold; background-color: #eeeeee; text-align: center; vertical-align: medium; border-left: #000000 1px solid; border-top: #000000 2px solid; border-right: #000000 2px solid; }
        tr.R0 td.R13C1{ text-align: center; vertical-align: top; border-left: #000000 2px solid; border-top: #000000 1px solid; }
        tr.R0 td.R13C26{ text-align: right; vertical-align: top; border-left: #000000 1px solid; border-top: #000000 1px solid; }
        tr.R0 td.R13C29{ vertical-align: top; border-left: #000000 1px solid; border-top: #000000 1px solid; }
        tr.R0 td.R13C3{ font-family: Arial; font-size: 7pt; font-style: normal; vertical-align: bottom; border-left: #000000 1px solid; border-top: #000000 1px solid; text-align: center;}
        tr.R0 td.R13C34{ text-align: right; vertical-align: top; border-left: #000000 1px solid; border-top: #000000 1px solid; border-right: #000000 2px solid; }
        tr.R0 td.R13C6{ vertical-align: top; border-left: #000000 1px solid; border-top: #000000 1px solid; }
        tr.R1{ height: 28px; }
        tr.R1 td.R1C1{ font-family: Arial; font-size: 14pt; font-style: normal; font-weight: bold; vertical-align: medium; border-bottom: #000000 2px solid; }
        tr.R10{ font-family: Arial; font-size: 10pt; font-style: normal; height: 5px; }
        tr.R14{ height: 9px; }
        tr.R14 td.R14C1{ border-top: #000000 2px solid; }
        tr.R14 td.R19C1{ border-bottom: #000000 2px solid; }
        tr.R22{ height: 23px; }
        tr.R22 td.R22C1{ text-align: right; border-bottom: #000000 1px solid; }
        tr.R22 td.R22C16{ border-bottom: #000000 1px solid; }
        tr.R23{ height: 29px; }
        tr.R23 td.R23C1{ font-family: Arial; font-size: 8pt; font-style: normal; font-weight: bold; text-align: justify; vertical-align: top; }
        tr.R23 td.R24C1{ vertical-align: top; }
        tr.R23 td.R24C19{ vertical-align: top; }
        tr.R23 td.R24C24{ font-family: Arial; font-size: 8pt; font-style: normal; text-align: center; vertical-align: top; overflow: visible;}
        tr.R23 td.R24C26{ font-family: Arial; font-size: 9pt; font-style: normal; text-align: center; vertical-align: top; }
        tr.R23 td.R24C27{ text-align: center; vertical-align: top; }
        tr.R3{ height: 17px; }
        tr.R3 td.R15C23{ font-family: Arial; font-size: 9pt; font-style: normal; font-weight: bold; text-align: right; vertical-align: top; }
        tr.R3 td.R15C26{ font-family: Arial; font-size: 10pt; font-style: normal; font-weight: bold; }
        tr.R3 td.R15C34{ font-family: Arial; font-size: 10pt; font-style: normal; font-weight: bold; text-align: right; vertical-align: top; }
        tr.R3 td.R21C1{ font-family: Arial; font-size: 9pt; font-style: normal; font-weight: bold; }
        tr.R3 td.R3C1{ font-family: Arial; font-size: 9pt; font-style: normal; text-decoration: underline ; vertical-align: medium; }
        tr.R3 td.R3C6{ font-family: Arial; font-size: 9pt; font-style: normal; font-weight: bold; vertical-align: top; }
        tr.R4{ height: 31px; }
        tr.R4 td.R4C7{ font-family: Arial; font-size: 9pt; font-style: normal; vertical-align: top; }
        tr.R5{ height: 5px; }
        tr.R7{ height: 16px; }
        tr.R7 td.R7C7{ font-family: Arial; font-size: 9pt; font-style: normal; vertical-align: top; }
        tr.R9{ font-family: Arial; font-size: 10pt; font-style: normal; height: 17px; }
        tr.R9 td.R9C1{ vertical-align: bottom; }
        table {table-layout: fixed; padding: 0px; padding-left: 2px; vertical-align:bottom; border-collapse:collapse;width: 100%; font-family: Arial; font-size: 8pt; font-style: normal; }
        td { padding: 0px; padding-left: 2px; overflow:hidden; }
        @media print {
            a[href]:after { content: none !important; }
        }
    </STYLE>
</HEAD>
<BODY STYLE="background: #ffffff; margin: 0; font-family: Arial; font-size: 8pt; font-style: normal; ">
<TABLE style="width:0px; height:0px; " CELLSPACING=0>
    <COL WIDTH=12>
    <COL WIDTH=21>
    <COL WIDTH=21>
    <COL WIDTH=25>
    <COL WIDTH=24>
    <COL WIDTH=23>
    <COL WIDTH=17>
    <COL WIDTH=18>
    <COL WIDTH=16>
    <COL WIDTH=17>
    <COL WIDTH=18>
    <COL WIDTH=18>
    <COL WIDTH=16>
    <COL WIDTH=14>
    <COL WIDTH=14>
    <COL WIDTH=14>
    <COL WIDTH=21>
    <COL WIDTH=21>
    <COL WIDTH=15>
    <COL WIDTH=15>
    <COL WIDTH=18>
    <COL WIDTH=19>
    <COL WIDTH=21>
    <COL WIDTH=18>
    <COL WIDTH=21>
    <COL WIDTH=21>
    <COL WIDTH=17>
    <COL WIDTH=19>
    <COL WIDTH=19>
    <COL WIDTH=19>
    <COL WIDTH=19>
    <COL WIDTH=19>
    <COL WIDTH=17>
    <COL WIDTH=21>
    <COL WIDTH=21>
    <COL WIDTH=21>
    <COL WIDTH=21>
    <COL WIDTH=21>
    <TR CLASS=R0>
        <TD STYLE=" border-left-style: none; border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD COLSPAN=4 STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD COLSPAN=4 STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD STYLE=" border-top-style: none;"><SPAN></SPAN></TD>
        <TD>&nbsp;</TD>
    </TR>
    <TR CLASS=R1>
        <TD STYLE=" border-left-style: none;">
            <DIV STYLE="width:100%;height:28px;overflow:hidden;"><SPAN></SPAN></DIV>
        </TD>
        <TD CLASS="R1C1" COLSPAN=37>
            <DIV STYLE="width:100%;height:28px;overflow:hidden;">
                <SPAN STYLE="white-space:nowrap;">Видаткова&nbsp;накладна&nbsp;№&nbsp;<?= $job->id ?>&nbsp;від&nbsp;<?= \Yii::t('app', '{0, date, long}', strtotime($job->created_at)); ?></SPAN>
        </TD>
        <TD>
            <DIV STYLE="width:100%;height:28px;overflow:hidden;"></DIV>
        </TD>
    </TR>
    <TR CLASS=R0>
        <TD STYLE=" border-left-style: none;"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD COLSPAN=4><SPAN></SPAN></TD>
        <TD COLSPAN=4><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD>&nbsp;</TD>
    </TR>
    <TR CLASS=R3>
        <TD STYLE=" border-left-style: none;"><SPAN></SPAN></TD>
        <TD CLASS="R3C1" COLSPAN=5><SPAN STYLE="white-space:nowrap;">Постачальник:</SPAN></TD>
        <TD CLASS="R3C6" COLSPAN=32>Moto-moto.kiev.ua</TD>
        <TD></TD>
    </TR>
    <TR CLASS=R4>
        <TD STYLE=" border-left-style: none;"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R4C7" COLSPAN=31>Р/р 5168755621927926, у банку ПАТ "ПРИВАТБАНК", м. Київ, МФО 300711,<BR>ІПН 3229109096</TD>
        <TD></TD>
    </TR>
    <TR CLASS=R5>
        <TD STYLE=" border-left-style: none;"><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD COLSPAN=4><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD COLSPAN=4><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;">&nbsp;</DIV></TD>
    </TR>
    <TR CLASS=R3>
        <TD STYLE=" border-left-style: none;"><SPAN></SPAN></TD>
        <TD CLASS="R3C1" COLSPAN=5><SPAN STYLE="white-space:nowrap;">Покупець:</SPAN></TD>
        <TD CLASS="R3C6" COLSPAN=32><?= $job->client->full_name ?></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R7>
        <TD STYLE=" border-left-style: none;"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R7C7" COLSPAN=31>Тел.: <?= preg_replace("/([+]{1})([0-9]{3})([0-9]{2})([0-9]{3})([0-9]{2})([0-9]{2})/", "$1$2 ($3) $4-$5-$6", $job->client->phone_number); ?></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R5>
        <TD STYLE=" border-left-style: none;"><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD COLSPAN=4><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD COLSPAN=4><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;">&nbsp;</DIV></TD>
    </TR>
    <TR CLASS=R9>
        <TD STYLE=" border-left-style: none;"><SPAN></SPAN></TD>
        <TD CLASS="R9C1" COLSPAN=4>Договір:</TD>
        <TD CLASS="R9C1" COLSPAN=33><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R10>
        <TD STYLE=" border-left-style: none;"><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD COLSPAN=4><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD COLSPAN=4><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:5px;overflow:hidden;">&nbsp;</DIV></TD>
    </TR>
    <TR CLASS=R0>
        <TD STYLE=" border-left-style: none;"><SPAN></SPAN></TD>
        <TD CLASS="R11C1" COLSPAN=2 ROWSPAN=2><DIV STYLE="width:100%;height:29px;overflow:hidden;"><SPAN STYLE="white-space:nowrap;">№</SPAN></DIV></TD>
        <TD CLASS="R11C3" COLSPAN=3 ROWSPAN=2><DIV STYLE="width:100%;height:29px;overflow:hidden;"><SPAN STYLE="white-space:nowrap;">Код</SPAN></DIV></TD>
        <TD CLASS="R11C3" COLSPAN=20 ROWSPAN=2><DIV STYLE="width:100%;height:29px;overflow:hidden;"><SPAN STYLE="white-space:nowrap;">Товар</SPAN></DIV></TD>
        <TD CLASS="R11C3" COLSPAN=5 ROWSPAN=2><DIV STYLE="width:100%;height:29px;overflow:hidden;"><SPAN STYLE="white-space:nowrap;">Кількість</SPAN></DIV></TD>
        <TD CLASS="R11C31" COLSPAN=3 ROWSPAN=2><DIV STYLE="width:100%;height:29px;overflow:hidden;">Ціна</DIV></TD>
        <TD CLASS="R11C34" COLSPAN=4 ROWSPAN=2><DIV STYLE="width:100%;height:29px;overflow:hidden;">Сума</DIV></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R0>
        <TD STYLE=" border-left-style: none;"><SPAN></SPAN></TD>
        <TD>&nbsp;</TD>
    </TR>
    <?php foreach ($job->tasks as $number => $task): ?>
    <TR CLASS=R0>
        <TD STYLE=" border-left-style: none;"><SPAN></SPAN></TD>
        <TD CLASS="R13C1" COLSPAN=2><SPAN STYLE="white-space:nowrap;"><?= ++$number ?></SPAN></TD>
        <TD CLASS="R13C3" COLSPAN=3><?= $task->id ?></TD>
        <TD CLASS="R13C6" COLSPAN=20><?= $task->name ?></TD>
        <TD CLASS="R13C26" COLSPAN=5><SPAN STYLE="white-space:nowrap;">1</SPAN></TD>
        <TD CLASS="R13C26" COLSPAN=3><SPAN STYLE="white-space:nowrap;"><?= $task->price ?></SPAN></TD>
        <TD CLASS="R13C34" COLSPAN=4><SPAN STYLE="white-space:nowrap;"><?= $task->price ?></SPAN></TD>
        <TD></TD>
    </TR>
    <?php endforeach; ?>
    <TR CLASS=R14>
        <TD STYLE=" border-left-style: none;"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1" COLSPAN=4><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1" COLSPAN=4><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R14C1" COLSPAN=4><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;">&nbsp;</DIV></TD>
    </TR>
    <TR CLASS=R3>
        <TD STYLE=" border-left-style: none;"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R15C23" COLSPAN=3><SPAN STYLE="white-space:nowrap;">Разом:</SPAN></TD>
        <TD CLASS="R15C26" COLSPAN=4><SPAN></SPAN></TD>
        <TD CLASS="R15C26" COLSPAN=4><SPAN></SPAN></TD>
        <TD CLASS="R15C34" COLSPAN=4><SPAN STYLE="white-space:nowrap;"><?= number_format($job->getTotalPrice(), 2, ',', '') ?></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R14>
        <TD STYLE=" border-left-style: none;"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD COLSPAN=4><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD COLSPAN=4><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;">&nbsp;</DIV></TD>
    </TR>
    <TR CLASS=R0>
        <TD STYLE=" border-left-style: none;"><SPAN></SPAN></TD>
        <TD COLSPAN=37><SPAN STYLE="white-space:nowrap;">Всього&nbsp;найменувань&nbsp;<?= count($job->tasks) ?>,&nbsp;на&nbsp;суму&nbsp;<?= number_format($job->getTotalPrice(), 2, ',', '') ?>&nbsp;грн.</SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R3>
        <TD STYLE=" border-left-style: none;"><SPAN></SPAN></TD>
        <TD CLASS="R3C6" COLSPAN=37><?= $job->getTotalPriceByString() ?></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R14>
        <TD STYLE=" border-left-style: none;"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1" COLSPAN=4><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1" COLSPAN=4><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R19C1"><DIV STYLE="width:100%;height:9px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:9px;overflow:hidden;">&nbsp;</DIV></TD>
    </TR>
    <TR CLASS=R0>
        <TD STYLE=" border-left-style: none;"><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD COLSPAN=4><SPAN></SPAN></TD>
        <TD COLSPAN=4><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD>&nbsp;</TD>
    </TR>
    <TR CLASS=R3>
        <TD STYLE=" border-left-style: none;"><SPAN></SPAN></TD>
        <TD CLASS="R21C1" COLSPAN=15><SPAN STYLE="white-space:nowrap;">Від&nbsp;постачальника*</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R21C1" COLSPAN=16><SPAN STYLE="white-space:nowrap;">Отримав(ла)</SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R22>
        <TD STYLE=" border-left-style: none;"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C16"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1" COLSPAN=4><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C1" COLSPAN=4><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD CLASS="R22C16"><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:23px;overflow:hidden;"><SPAN></SPAN></DIV></TD>
        <TD><DIV STYLE="width:100%;height:23px;overflow:hidden;">&nbsp;</DIV></TD>
    </TR>
    <TR CLASS=R23>
        <TD STYLE=" border-left-style: none;"><SPAN></SPAN></TD>
        <TD CLASS="R23C1" COLSPAN=15><SPAN STYLE="white-space:nowrap;"><?= $job->getCreatorName() ?></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R23C1" COLSPAN=16><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
    <TR CLASS=R23>
        <TD STYLE=" border-left-style: none;"><SPAN></SPAN></TD>
        <TD CLASS="R24C1" COLSPAN=15>* Відповідальний за здійснення господарської операції і правильність її оформлення</TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD CLASS="R24C19" COLSPAN=5><SPAN STYLE="white-space:nowrap;">За&nbsp;довіреністю</SPAN></TD>
        <TD CLASS="R24C24" COLSPAN=2><SPAN></SPAN></TD>
        <TD CLASS="R24C26"><SPAN STYLE="white-space:nowrap;">№</SPAN></TD>
        <TD CLASS="R24C27" COLSPAN=4><SPAN></SPAN></TD>
        <TD CLASS="R24C26"><SPAN STYLE="white-space:nowrap;">від</SPAN></TD>
        <TD CLASS="R24C27" COLSPAN=3><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD><SPAN></SPAN></TD>
        <TD></TD>
    </TR>
</TABLE>
</BODY>
</HTML>